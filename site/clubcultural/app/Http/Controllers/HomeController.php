<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwigBridge\Facade\Twig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getHome(){
        $todayName = strtolower(date('l', strtotime('now')));

        $logged_user = Auth::user();
        $categories = \Models\Category::all();
        $categoriesCount = \Models\Category::getCategoriesCount();
        $slider_deals = \Models\Deal::with('business')->where('featured', '=', '1')->where('deleted', '=', '0')->get();
        $featured_deals = \Models\Deal::with('business')->where('featured', '=', '2')->where('deleted', '=', '0')->get();
        $todayDeals = \Models\Deal::with('business')->where($todayName, '=', '1')->where('deleted', '=', '0')->get();
        
        return Twig::render('home', [
            'logged_user'       => $logged_user,
            'categories'        => $categories,
            'slider_deals'      => $slider_deals,
            'featured_deals'    => $featured_deals,
            'categories_count'  => $categoriesCount,
            'today_deals'       => $todayDeals
        ]);
    }
    
    
    
    /* Email */
    public function getEmailUserByDeal(Request $request){
        $loggedUser = Auth::user();
        $deal = \Models\Deal::with('category')
            ->with('business')
            ->with('images')
            ->where('id', '=', 3)
            ->first();

        /*Mail::send('emails.user_buy_deal', [], function ($m) {
            $m->from('hello@app.com', 'Your Application');
            $m->to('veroyv412@gmail.com', 'Veronica Test')->subject('Tu Coupon de Descuento');
        });*/

        return Twig::render('emails.user_buy_deal', ['deal' => $deal, 'logged_user' => $loggedUser]);
    }
    
    public function getEmailBusinessByDeal(Request $request){
        $loggedUser = Auth::user();
        $deal = \Models\Deal::with('category')
            ->with('business')
            ->with('images')
            ->where('id', '=', 3)
            ->first();

        return Twig::render('emails.business_buy_deal', ['deal' => $deal, 'logged_user' => $loggedUser]);
    }
}
