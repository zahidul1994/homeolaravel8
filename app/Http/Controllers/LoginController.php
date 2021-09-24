<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Mail\Foregatepasword;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'success' =>true,
            'token' => $token,
            'token_type' => 'bearer',
           
        ], 200);
        //redirect('https://www.example.com', 302);
    }


    public function login(Request $request)
    {
     
          
        if (! $token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>'2']))   {
            return response()->json([
                'success' => false,
             
            ], 401);
        }
   return $this->respondWithToken($token);
    }

    public function logout(Request $request){
         Auth::guard('admin')->logout();
   
       return response()->json([
             'success' => true,
              'message'=>'logout success'
         ],201);
       
      
   }
    public function store(Request $request)
    
    {
   
        $this->validate($request,[
            'name' => 'required|min:3|max:80',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:30',
       
        ]);
       

    $list = new User();
    $list->admin_id =1;
    $list->phone = $request->phone;
    $list->username = $request->username;
   $list->name = $request->name;
    $list->email = $request->email;
    $list->password = Hash::make($request->password);
   $list->image ='not-found.jpg';
   
    $list->save();

    if ($list->id) {
      return response()->json([
          'success' => true,
          
      ],201);
    } else {
        return response()->json([
            'success' => false,
             
        ],404);
    }
}




public function genderlist()
{
    
    $gen = Gender::latest()->get();
    if($gen){
    return response()->json([
        'success'=>true,
        'message'=>'Gender List',
        'gender'=>$gen],200);
}
else{
    return response()->json([
        'success'=>true,
        'message'=>' Record Not Found'
    ],404);
  
}
    //dd($purchase);
   // 
}

public function division()
    {
        
        $location = Location::latest()->get();
        if($location){
        return response()->json([
            'success'=>true,
            'message'=>'Division List',
            'division'=>$location],200);
    }
    else{
        return response()->json([
            'success'=>true,
            'message'=>' Record Not Found'
        ],404);
      
    }
        //dd($purchase);
       // 
    }
    public function subdivisionlist()
    {
        
        $location = Sublocation::with('location')->latest()->get();
        if($location){
        return response()->json([
            'success'=>true,
            'message'=>'Sub-division List',
            'subdivision'=>$location],200);
    }
    else{
        return response()->json([
            'success'=>true,
            'message'=>' Record Not Found'
        ],404);
      
    }
        //dd($purchase);
       // 
    }
    public function subdivision($id)
    {
        
        $location = Sublocation::where('division_id', $id)->get();
        if($location){
        return response()->json([
            'success'=>true,
            'message'=>'Sub-division List Found',
            'subdivision'=>$location],200);
    }
    else{
        return response()->json([
            'success'=>false,
            'message'=>' Record Not Found'
        ],404);
      
    }
        //dd($purchase);
       // 
    }

   
    }
