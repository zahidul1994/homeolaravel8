<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Helpers\CommonFx;
use App\Models\Blogcount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data =Blog::wherestatus(1)->whereIn('category_id',[1,6])->latest()->paginate(12);
        return response()->json($data);

        $all = Cache::remember('blogs', 30, function() {
            return Blog::all();
        });
        
        $page = $request->has('page') ? $request->query('page') : 1;
        $perPage = 12;
        
        $data = new LengthAwarePaginator(
            $all->forPage($page, $perPage), $all->count(), $perPage, $page
        );
        return response()->json($data);
       
    }

    public function show(Request $request,$id)
    {
    
        $blog= Blog::with('admin','category')->whereslug(urldecode($id))->first();
        $relatedblog=Blog::wherestatus(1)->where('slug', '!=' ,$id)->inRandomOrder()->limit(5)->select('title','slug','photo','metadescription')->take(6)->get();
         $totalview=Blogcount::where('blog_id',$blog->id)->sum('click');
      $ip= $request->ip();
            $blogid= $blog->id;
        if(Auth::guard('api')->guest()){
                $auth=null;
            }
            else{
                $auth=Auth::guard('api')->user()->id;
            }
        //   $auth=Auth::guard('api')->user()->id?:null;
        //   $auth=1;
              CommonFx::createBlogview($blogid,$ip,$auth);
        return response()->json([
            'blogs'=>$blog,
         'totalview'=>$totalview,
         'relatedblog'=>$relatedblog
        
        ],200);
    }

    

}
