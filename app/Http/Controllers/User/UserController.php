<?php
namespace App\Http\Controllers\user;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Foregatepasword;
use App\Models\Userlogininfo;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function me(Request $request){
       $info= Userlogininfo::firstOrCreate(
            ['user_id' => Auth::guard('api')->user()->id,'ip_address' =>$request->ip()],
            ['token' => $request->bearerToken(),'user_agent' => $request->header('User-Agent')]
          

        );
       
       $user=Auth::guard('api')->user();

          if($user){
           return response()->json([
                    'success' => true,
                    'user'=>$user,
                    'info'=>$info,
                     ], 201);
              }
              
       else {
                  return response()->json([
                      'success' => false,

                  ],404);
              }
       
        
    }

    public function logout(Request $request){
    $info=  DB::table('userlogininfos')->where([['user_id',Auth::guard('api')->user()->id],['token',$request->bearerToken()]])->delete();
        if($info){
           Auth::guard('api')->logout(true);
           
        } 
              return response()->json([
             'success' => true,
              'message'=>'logout success'
         ],201);
       
      
   }



   
    }
