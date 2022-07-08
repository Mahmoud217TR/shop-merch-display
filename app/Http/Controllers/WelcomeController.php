<?php

namespace App\Http\Controllers;

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
}
