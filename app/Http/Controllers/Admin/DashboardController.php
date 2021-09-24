<?php

namespace App\Http\Controllers\Admin;
use notifications;
use App\Models\Blog;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Disease;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Disemedicine;
use Illuminate\Http\Request;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
 public function __construct()
    {
        $this->middleware('verified');
    }
    
    public function index()
    { 
       
        $pageConfigs = ['navbarLarge' => false];

            $admin= Admin::whereid(Auth::id())->select('id','status')->get(); 
      
            $user=User::whereadmin_id(Auth::id())->select('admin_id','id','status')->get(); 
       
        $blog= Blog::whereadmin_id(Auth::id())->select('admin_id','id','status')->get(); 
       
        $medicine= Medicine::select('id','status')->get();   
       
       $disemedicine= Disemedicine::whereadmin_id(Auth::id())->select('admin_id','id')->get(); 
      
        $medicineinformation=Medicineinformation::whereadmin_id(Auth::id())->select('admin_id','id')->get();  
       
        $contact= Contact::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();
     

        $disease=  Disease::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();  
       
        $category=  Category::select('id','category')->get();  
       
        $bloginfo= Cache::get('bloginfo', function () {
            return Blog::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
          
            });
  
   

       return view('admin.dashboard',['pageConfigs' => $pageConfigs], compact('admin','user','blog','medicine','disease','disemedicine','medicineinformation','contact','category','bloginfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletenotification()
    {
        $notification=auth()->user()->notifications()->delete();
        if($notification){
          //  $notification->destroy();
            return response()->json(['success'=>true],201);
        }
        else{
            return response()->json(['success'=>false],404);
        }
    }

    public function seennotification(){
        auth()->user()->unreadNotifications->markAsRead();
      return response()->json(['success'=>true],201);
        
        
    }
}
