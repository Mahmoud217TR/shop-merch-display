<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function index(){
        $keyword = request()->keyword;
        $order = request()->order;
        $type = request()->type;

        $produts = Product::with(['category'])->where('name','like','%'.$keyword.'%')
        ->orderBy($order,$type)->get();

        return response()->json([
            'products' => $this->formatProducts($produts),
        ]);
    }
}
