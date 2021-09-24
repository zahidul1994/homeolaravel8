<?php
namespace App\Http\Controllers\Superadmin;
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
use Illuminate\Contracts\Cache\Factory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       
        $pageConfigs = ['navbarLarge' => false];

        $admin= Cache::remember('admincache', 22*60, function () {
           return Admin::select('id','status')->get(); 
        });

        
        $user= Cache::remember('usercache', 22*60, function () {
            return User::select('id','status')->get(); 
        });
      
        $blog= Cache::remember('blogcache', 22*60, function () {
            return Blog::select('id','status')->get(); 
        });
        $medicine= Cache::remember('medicinecache', 22*60, function () {
            return Medicine::select('id','status')->get();   
        });
       $disemedicine= Cache::remember('disemedicinecache', 22*60, function () {
            return Disemedicine::select('id')->get(); 
        }); 
        $medicineinformation= Cache::remember('medicineinformationcache', 22*60, function () {
            return Medicineinformation::select('id')->get();  
        });

        $contact= Cache::remember('contactcache', 22*60, function () {
            return Contact::select('id','status')->get();
        });

        $disease=  Cache::remember('diseasecache', 22*60, function () {
            return Disease::select('id','status')->get();  
        });

        $category=  Cache::remember('categorycache', 22*60, function () {
            return Category::select('id','category')->get();  
        });

  

       return view('superadmin.dashboard',['pageConfigs' => $pageConfigs], compact('admin','user','blog','medicine','disease','disemedicine','medicineinformation','contact','category'));
    }

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
