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
                'category_id' => $product->category->id,
                'category_name' => $product->category->name,
            ];
        });
    }

    protected function formatCategories($categoriesCollection){
        return $categoriesCollection->map(function($category){
            return [
                'id' => $category->id,
                'name' => $category->name,
                'count' => $category->products->count(),
            ];
        });
    }

    protected function generateRandomColor(){
        return "#".substr(md5(rand()), 0, 6);
    }

    protected function generateRandomColors($numberOfColors){
        $colors = [];
        for($counter = 0; $counter < $numberOfColors ; $counter++){
            array_push($colors, $this->generateRandomColor());
        }

        return $colors;
    }

    protected function trimStringsInCollection($collection, $limit){
        return $collection->map(function($item) use ($limit){
            $len = strlen($item);
            if($len > $limit){
                return substr($item, 0, $limit)."...";
            }
        });
    }
}
