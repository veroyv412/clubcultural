<?php

namespace App\Repositories;

class Deal {

    public function search($category_slug, $search = null){
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
}