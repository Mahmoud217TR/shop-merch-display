<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $limit = 10; // Changed from settings
        $categoies = Category::withCount('products')->orderBy('products_count','DESC')->get();
        $products = Product::orderBy('price','DESC')->limit($limit)->get();

        $categoryChart = [
            'data' => $categoies->pluck('products_count'),
            'colors' => $this->generateRandomColors($limit),
            'labels' => $categoies->pluck('name'),
        ];

        $productChart = [
            'data' => $products->pluck('price'),
            'colors' => $this->generateRandomColors($limit),
            'labels' => $this->trimStringsInCollection($products->pluck('name'), 15),
        ];

        return view('home', compact('categoryChart', 'productChart'));
    }
}
