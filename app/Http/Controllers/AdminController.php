<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function category(){
        return view('admin.category');
    }

    public function product(){
        return view('admin.product');
    }
}
