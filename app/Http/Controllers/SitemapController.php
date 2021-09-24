<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Medicineinformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Medicine;

class SitemapController extends Controller
{
      public function index()
    {
      
      return response()->view('sitemap.index', [
     
      ])->header('Content-Type', 'text/xml');
    }
    
  
    
     public function blog()
    {
        $articles = Blog::wherestatus(1)->select('id','slug','status')->latest()->get();
        return response()->view('sitemap.blog', [
            'posts' => $articles,
        ])->header('Content-Type', 'text/xml');
    }
    
     public function homeoinfo()
    {
        $articles =Medicineinformation::wherestatus(1)->select('id','slug','status')->latest()->get();
        return response()->view('sitemap.homeoinfo', [
            'posts' => $articles,
        ])->header('Content-Type', 'text/xml');
    }

    public function disease()
    {
        $articles =Disease::wherestatus(1)->select('id','slug','status')->latest()->get();
        return response()->view('sitemap.disease', [
            'posts' => $articles,
        ])->header('Content-Type', 'text/xml');
    }

    public function medicicne()
    {
        $articles =Medicine::wherestatus(1)->select('id','slug','status')->latest()->get();
        return response()->view('sitemap.medicine', [
            'posts' => $articles,
        ])->header('Content-Type', 'text/xml');
    }

}
