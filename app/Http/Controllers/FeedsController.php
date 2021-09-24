<?php

namespace App\Http\Controllers;
use Feeds;
use Illuminate\Http\Request;

class FeedsController extends Controller
{

    public function demo() {
        $feed = Feeds::make('http://blog.case.edu/news/feed.atom');
        $data = array(
          'title'     => $feed->get_title(),
          'permalink' => $feed->get_permalink(),
          'items'     => $feed->get_items(),
        );
      
        //dd($data);
        return response()->json([
      
          
      
          'medicine'=>$data,
      
         
      
          ],200);
      
}
}
