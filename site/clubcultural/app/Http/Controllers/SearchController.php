<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwigBridge\Facade\Twig;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Deal;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    public function getCategorySearch(Request $request, $category_slug){
        $loggedUser = Auth::user();
        $categories = \Models\Category::all();

        return Twig::render('search', [
            'logged_user' => $loggedUser,
            'categories' => $categories,
            'category_name' => $category_slug
        ]);
    }

    private function getDealsBySearch($search, $category_slug){
        

        

       // return ['category_name' => $categoryName, 'deals' => $deals];
    }

    public function getDealsSearch(Request $request){
        $logged_user = Auth::user();
        $categories = \Models\Category::all();

        $search = $request->input('s');
        $category_slug = $request->input('category');

        return Twig::render('search', [
            'logged_user'   => $logged_user,
            'categories'    => $categories,
            'category_name' => $category_slug,
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

    public function getDealsSearchJSON(Request $request, Deal $dealRepo, $category_slug, $search = null){
        try {
            $data = $dealRepo->search($category_slug, $search);
            return $this->responseSuccess($data);
        } catch (\Exception $e){
            return $this->responseError($e->getMessage(), $e->getCode());
        }
    }
}
