<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function formatProducts($productsCollection){
        return $productsCollection->map(function($product){
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'category' => $product->category->name,
            ];
        });
    }
}
