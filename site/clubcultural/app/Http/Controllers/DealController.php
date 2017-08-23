<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TwigBridge\Facade\Twig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DealController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    public function getFeaturedDeals(Request $request, $weight = 2){
        $slider_deals = \Models\Deal::with('business')->where('featured', '=', $weight)->where('deleted', '=', '0')->get();
        return $slider_deals;
    }
    
    public function getDeal(Request $request, $deal_id){
        $logged_user = Auth::user();
        $categories = \Models\Category::all();

        $deal = \Models\Deal::with('category')
            ->with('business')
            ->with('images')
            ->where('id', '=', $deal_id)
            ->first();

        return Twig::render('deal_detail', [
            'logged_user' => $logged_user,
            'categories' => $categories,
            'deal' => $deal,
        ]);
    }

    public function getDealBuy(Request $request, $deal_id){
        $loggedUser = Auth::user();
        $categories = \Models\Category::all();

        $deal = \Models\Deal::with('category')
            ->with('business')
            ->with('images')
            ->where('id', '=', $deal_id)
            ->first();

        if ( !empty($loggedUser) ){
            \Models\Order::create([
                'user_id'       => $loggedUser->id,
                'deal_id'       => $deal_id,
                'business_id'   => $deal->business->id,
                'price'         => $deal->price,
            ]);

            //@todo this can be done much better with QUEUE https://laravel.com/docs/5.3/mail
            Mail::send('emails.user_buy_deal', ['deal' => $deal, 'logged_user' => $loggedUser], function ($m) use ($loggedUser){
                $m->from('descuentospati@gmail.com', 'Descuentos pa ti');
                $m->to($loggedUser->email, $loggedUser->name)->subject('Tu Coupon de Descuento');
            });

            Mail::send('emails.user_buy_deal', ['deal' => $deal, 'logged_user' => $loggedUser], function ($m) use ($loggedUser){
                $m->from('descuentospati@gmail.com', 'Descuentos pa ti');
                $m->to($loggedUser->email, $loggedUser->name)->subject($loggedUser->name . ' Recientemente adquirio un descuento en tu espacio.');
            });
        }

        Session::flash('success', 'Felicitaciones! Ya tienes tu descuento. Te hemos enviado un mail con todos los datos necesarios para presentar en ' . ucwords($deal->business->company_name));
        return Twig::render('deal_detail', [
            'logged_user' => $loggedUser,
            'categories' => $categories,
            'deal' => $deal,
        ]);
    }
}
