<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwigBridge\Facade\Twig;
use \Models\Business;
use Storage;

class BusinessController extends Controller
{
    public function index(Request $request){
        $businesses = \Models\Business::all();

        return Twig::render('admin/business/list', [
            'businesses' => $businesses,
        ]);
    }

    public function edit(Request $request, Business $business){
        return Twig::render('admin/business/form', [
            'business' => $business,
        ]);
    }

    public function store(Request $request){
        //validate
        $this->validate($request,
            [
                'company_name'      => 'required|max:255',
                'image'             => 'image',
                'company_location'  => 'required|max:255',
            ]
        );

        $id = $request->input('id');
        $business = Business::find($id);
        if ( empty($business) ){
            $business = new Business();
        }
        $business->fill($request->all());
        $path = $request->file('image')->store('logos', ['S3'] );
        $business->company_logo = Storage::disk('s3')->url($path);

        $business->save();

        return $business;
    }
}
