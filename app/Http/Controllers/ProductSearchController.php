<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function index(){
        $keyword = request()->keyword;
        $order = request()->order;
        $type = request()->type;

        $categories = Category::where('name','like','%'.$keyword.'%')->get()->pluck('id');

        $produts = Product::with('category')
        ->where('name','like','%'.$keyword.'%')
        ->orWhere(function($query) use($categories){
            $query->whereIn('category_id',$categories);
        })
        ->orderBy($order,$type)->get();

        return response()->json([
            'products' => $this->formatProducts($produts),
        ]);
    }
}
