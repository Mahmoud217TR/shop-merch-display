<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    public function store(Request $request, Product $product){
        $validator = $this->getImageValidator($request->all());
        if($validator->passes()){
            $path = $this->saveImageToProduct($request->image, $product);
            return response()->json([
                'code' => 200,
                'path' => $path,
            ]);
        }
        return response()->json([
            'code' => 422,
            'errors' => $validator->errors()->toArray(),
        ]);
    }

    private function getImageValidator($data){
        return Validator::make($data,[
            'image' => 'required|image',
        ]);
    }

    private function saveImageToProduct($image, $product){
        $path = 'storage/'.$image->storeAs('uploads',$product->name.'.'.$image->clientExtension(),'public');
        $product->image = asset($path);
        $product->save();
        return $path;
    }
}
