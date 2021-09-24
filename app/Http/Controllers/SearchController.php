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

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
       
    }

    public function search(Request $request)
    {
           $id =$request->s;
   $search= Blog::wherestatus(1)->where('title','LIKE','%%%'.urldecode($id).'%%%')->select('slug','title','photo','metadescription')->latest()->limit(20)->get();
    
      return response()->json([
              'success'=>true,
               'searchresult'=>$search,
              
                ],200);
    }

    

}
