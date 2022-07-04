<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategorySearchController extends Controller
{
    public function search(){
        $keyword = request()->keyword;
        $order = request()->order;
        $type = request()->type;

        $categories = Category::with('products')
        ->where('name','like','%'.$keyword.'%')
        ->orderBy($order,$type)->get();

        return response()->json([
            'categories' => $this->formatCategories($categories),
        ]);
    }
}
