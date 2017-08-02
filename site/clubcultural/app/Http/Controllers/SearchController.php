<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwigBridge\Facade\Twig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    public function getCategorySearch(Request $request, $category_slug){
        $logged_user = Auth::user();
        $categories = \Models\Category::all();
        $todayName = strtolower(date('l', strtotime('now')));
        $categoryName = '';

        if ( $category_slug == 'today' ){
            $categoryName = 'Hoy';
            $deals = \Models\Deal::with('category')->with('business')
                ->join('categories', 'categories.id', '=', 'deals.category_id')
                ->where($todayName, '=', 1)
                ->orderBy('deals.featured', 'ASC')
                ->get();
        } else {
            $category = \Models\Category::where('category_slug', '=', $category_slug)->first();
            $categoryName = $category->category_name;
            $deals = \Models\Deal::with('category')->with('business')
                ->join('categories', 'categories.id', '=', 'deals.category_id')
                ->where('category_slug', '=', $category_slug)
                ->orderBy('deals.featured ASC')
                ->get();
        }

        return Twig::render('search', [
            'logged_user' => $logged_user,
            'categories' => $categories,
            'deals' => $deals,
            'category_name' => $categoryName
        ]);
    }

    private function getDealsBySearch($search, $category_slug){
        $todayName = strtolower(date('l', strtotime('now')));

        if ( !empty($search) && empty($category_slug) ){
            if ( $category_slug == 'today' ){
                $categoryName = 'Hoy';
                $deals = \Models\Deal::with('category')->with('business')
                    ->where($todayName, '=', 1)
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->get();
            } else {
                $categoryName = 'Todas';
                $deals = \Models\Deal::with('category')->with('business')
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->get();
            }

        } else if ( empty($search) && !empty($category_slug) ){
            if ( $category_slug == 'today' ){
                $categoryName = 'Hoy';
                $deals = \Models\Deal::with('category')->with('business')->where($todayName, '=', 1)->get();
            } else {
                $category = \Models\Category::where('category_slug', '=', $category_slug)->first();
                $categoryName = $category->category_name;
                $deals = \Models\Deal::with('category')->with('business')->get();
            }
        } else if ( !empty($search) && !empty($category_slug) ){
            if ( $category_slug == 'today' ){
                $categoryName = 'Hoy';
                $deals = \Models\Deal::with('category')->with('business')
                    ->join('categories', 'categories.id', '=', 'deals.category_id')
                    ->where($todayName, '=', 1)
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%')
                            ->orWhere('description', 'like', '%'.$search.'%');
                    })->get();
            } else {
                $category = \Models\Category::where('category_slug', '=', $category_slug)->first();
                $categoryName = $category->category_name;
                $deals = \Models\Deal::with('category')->with('business')
                    ->join('categories', 'categories.id', '=', 'deals.category_id')
                    ->where('category_slug', '=', $category_slug)
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%')
                            ->orWhere('description', 'like', '%'.$search.'%');
                    })->get();
            }

        } else {
            if ( $category_slug == 'today' ){
                $categoryName = 'Hoy';
                $deals = \Models\Deal::with('category')->with('business')->where($todayName, '=', 1)->get();
            } else {
                $categoryName = 'Todas';
                $deals = \Models\Deal::with('category')->with('business')->get();
            }

        }

        return ['category_name' => $categoryName, 'deals' => $deals];
    }

    public function getDealsSearch(Request $request){
        $logged_user = Auth::user();
        $categories = \Models\Category::all();

        $search = $request->input('s');
        $category_slug = $request->input('category');

        $_deals = $this->getDealsBySearch($search, $category_slug);
        $deals = $_deals['deals'];
        $categoryName = $_deals['category_name'];

        return Twig::render('search', [
            'logged_user'   => $logged_user,
            'categories'    => $categories,
            'deals'         => $deals,
            'category_name' => $categoryName,
            'search'        => $search,
            'category_slug' => $category_slug,
        ]);
    }

    public function getTagSearch(Request $request, $tag){
        $logged_user = Auth::user();
        $categories = \Models\Category::all();

        $_deals = $this->getDealsBySearch($tag, null);
        $deals = $_deals['deals'];
        $categoryName = $_deals['category_name'];

        return Twig::render('search', [
            'logged_user'   => $logged_user,
            'categories'    => $categories,
            'deals'         => $deals,
            'category_name' => $categoryName,
            'search'        => $tag,
            'category_slug' => 'Todas',
        ]);
    }
}
