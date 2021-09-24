<?php
namespace App\Helpers;
use App\Models\Viewcountmediinfo;
use App\Models\Blogcount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request; 
// use \Cviebrock\EloquentSluggable\Services\SlugService;

class CommonFx{
        public static function make_slug($string) {
        return Str::slug($string, '-');
    }
        public static function bnslug($string, $delimiter = '-') {
      
        $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
            
               
                $string = preg_replace("/[\/_|+ -]+/", $delimiter, trim(strtolower($string)));
            
                return $string;
        
            }

public static function createMedicineinformation($blogid,$ip,$auth) {
    $blogcount=Viewcountmediinfo::where('medicineinformation_id',$blogid)->where('user_id',$auth)->get()->first();
    if($blogcount){
         $postViews=Viewcountmediinfo::find($blogcount->id);
        $postViews->click +=1; 
    $postViews->update();
    }
    elseif($blogcount=Viewcountmediinfo::where('medicineinformation_id',$blogid)->where('user_id',$auth)->where('ip',$ip)->get()->first()){
         $postViews=Viewcountmediinfo::find($blogcount->id);
        $postViews->click +=1; 
    $postViews->update();
    }
    else{
         $postViews= new Viewcountmediinfo();
    $postViews->medicineinformation_id = $blogid;
     $postViews->ip = $ip;
     $postViews->user_id =$auth;
     $postViews->click =1; 
    $postViews->save();
    }
      
}
   public static function createBlogview($blogid,$ip,$auth) {
    $blogcount=Blogcount::where('blog_id',$blogid)->where('user_id',$auth)->get()->first();
    if($blogcount){
         $postViews=Blogcount::find($blogcount->id);
        $postViews->click +=1; 
    $postViews->update();
    }
    elseif($blogcount=Blogcount::where('blog_id',$blogid)->where('user_id',$auth)->where('ip',$ip)->get()->first()){
         $postViews=Blogcount::find($blogcount->id);
        $postViews->click +=1; 
    $postViews->update();
    }
    else{
         $postViews= new Blogcount();
    $postViews->blog_id = $blogid;
     $postViews->ip = $ip;
     $postViews->user_id =$auth;
     $postViews->click =1; 
    $postViews->save();
    }
   
   
}

}
