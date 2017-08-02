<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';

    public function deal()
    {
        return $this->belongsTo('Models\Deal');
    }

    public static function getCategoriesCount(){
        return DB::table('categories')->join('deals', 'categories.id', '=', 'deals.category_id')
            ->selectRaw('categories.id, categories.category_name, categories.category_slug, count(1) as count')
            ->groupBy('categories.id')
            ->get();
    }
}
