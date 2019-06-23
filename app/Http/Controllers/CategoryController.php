<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    public static function getCategories () {
        return Category::all();
    }

}
