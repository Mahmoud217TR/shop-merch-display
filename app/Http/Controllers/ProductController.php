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


    public function store()
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

    public function update()
    {
        $validator = $this->getValidator();
        $idValidator = $this->getIdValidator();

        if($idValidator->passes() && $validator->passes()){
            Product::find($idValidator->validated()['id'])->update($validator->validated());
            return response()->json([
                'code' => 200,
            ]);
        }
        
        return response()->json([
            'code' => 422,
            'errors' => $validator->errors()->toArray(),
        ]);
    }

    public function destroy()
    {
        $idValidator = $this->getIdValidator();

        if($idValidator->passes()){
            Product::find($idValidator->validated()['id'])->delete();
            return response()->json([
                'code' => 200,
                'id' => $idValidator->validated()['id'],
            ]);
        }
    }

    private function getIdValidator(){
        return Validator::make(request()->all(),[
            'id' => 'required|numeric|exists:products,id',
        ]);
    }

    private function getValidator(){
        return Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|numeric|exists:categories,id',
        ],[
            'category_id.exists' => 'Please choose a valid Category'
        ]);
    }
}
