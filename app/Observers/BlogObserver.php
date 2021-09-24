<?php

namespace App\Observers;
use Illuminate\Support\Facades\Cache;
use App\Models\Blog;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Superadminnotification;


class BlogObserver  
{
   
    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        $data = [
            
              'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editblog/'.$blog->id) . '">'.Auth::user()->name .' create ' .$blog->title. '</a>',
    ];
        $superAdmins = Superadmin::first();
       
            $superAdmins->notify(new Superadminnotification($data));
  
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        
      
            
             Cache::forget('bloginfo');
                    $bloginfo=Blog::wherestatus(1)->latest()->take(9)->select('title','slug','photo','metadescription')->get();
                    Cache::forever('bloginfo',$bloginfo);
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
       
             Cache::forget('bloginfo');
                    $bloginfo=Blog::wherestatus(1)->latest()->take(9)->select('title','slug','photo','metadescription')->get();
                    Cache::forever('bloginfo',$bloginfo);
    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        //
    }
}
