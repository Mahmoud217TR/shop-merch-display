<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        auth()->user()->update($data);
        return redirect()->route('settings');
    }
}
