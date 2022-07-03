<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        return response()->json([
            'products' => $this->formatProducts(Product::with('category')->get()),
            'categories' => Category::select('id','name')->get(),
        ]);
    }


    public function store(Request $request)
    {
        $validator = $this->getValidator();

        if($validator->passes()){
            Product::create($validator->validated());
            return response()->json([
                'code' => 200,
            ]);
        }
        
        return response()->json([
            'code' => 422,
            'errors' => $validator->errors()->toArray(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    private function getValidator(){
        return Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
    }
}
