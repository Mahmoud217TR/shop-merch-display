<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function products(){
        return response()->json([
            'products' => $this->formatProducts(Product::with('category')->get()),
        ]);
    }

    public function search(){
        $keyword = request()->keyword;

        $categories = Category::where('name','like','%'.$keyword.'%')->get()->pluck('id');

        $produts = Product::with('category')
        ->where('name','like','%'.$keyword.'%')
        ->orWhere(function($query) use($categories){
            $query->whereIn('category_id',$categories);
        })->get();

        return response()->json([
            'products' => $this->formatProducts($produts),
        ]);
    }
}
