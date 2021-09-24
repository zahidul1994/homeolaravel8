<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thana;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
class ThanaController extends Controller
{
    public function index(){
        return Thana::get();
      }
      
      
      
      public function store(){
          $response =Http::get('https://www.bikebd.com/den/api/thana');
      
       $districtvalue=json_decode($response->body());
        
         foreach($districtvalue as $district){
          $div = new Thana;
          $div->district_id =1;
          $div->thana = $district->thananame;
          $div->save();
      }
      return "DONE";
      }
}
