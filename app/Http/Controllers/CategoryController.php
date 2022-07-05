<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'categories' => $this->formatCategories(Category::with('products')->get()),
        ]);
    }


    public function store()
    {
        $validator = $this->getValidator();

        if($validator->passes()){
            Category::create($validator->validated());
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
            Category::find($idValidator->validated()['id'])->update($validator->validated());
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
            Category::find($idValidator->validated()['id'])->delete();
            return response()->json([
                'code' => 200,
                'id' => $idValidator->validated()['id'],
            ]);
        }
    }

    private function getIdValidator(){
        return Validator::make(request()->all(),[
            'id' => 'required|numeric|exists:categories,id',
        ]);
    }

    private function getValidator(){
        return Validator::make(request()->all(),[
            'name' => 'required|string|max:255|unique:categories,name,'.request()->id,
        ]);
    }
}
