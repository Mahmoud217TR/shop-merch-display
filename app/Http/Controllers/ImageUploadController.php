<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Product $product){
        dd('hey');
        return response()->json([
            'product' => $product,
            'image' => request()->all(),
        ]);
    }
}
