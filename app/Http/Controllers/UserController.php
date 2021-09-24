<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    
 public function me(){
         return response()->json(Auth::guard('api')->user());
        
    }
   
       public function store(Request $request)
    
    {
   
        $this->validate($request,[
            'name' => 'required|min:3|max:80',
            'phone' => 'required|unique:users,phone|numeric|digits:11',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:30',
       
        ]);
       
//return response($request->all());
    $list = new User();
    // $list->admin_id =1;
    $list->phone = $request->phone;
   $list->name = $request->name;
    $list->email = $request->email;
    $list->otp=mt_rand(1000, 9999);
    $list->password = Hash::make($request->password);
   $list->image ='not-found.jpg';
   
    $list->save();

    if ($list->save()) {
      return response()->json([
          'success' => true,
          
      ],201);
    } else {
        return response()->json([
            'success' => false,
             
        ],404);
    }
}




}