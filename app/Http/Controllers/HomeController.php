<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $limit = 5; // Changed from settings
        $categoies = Category::withCount('products')->orderBy('products_count','DESC')->limit($limit)->get();

        $categoryChart = [
            'data' => $categoies->pluck('products_count'),
            'colors' => $this->generateRandomColors($limit),
            'labels' => $categoies->pluck('name'),
        ];
        return view('home', compact('categoryChart'));
    }
}
