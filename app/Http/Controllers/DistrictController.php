<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
class DistrictController extends Controller
{
 
   public function index(){
      return District::get();
    }
    
    
    
    public function store(){
        $response =Http::get('https://www.bikebd.com/den/api/subdivision');
    
     $districtvalue=json_decode($response->body());
      
       foreach($districtvalue as $district){
        $div = new District;
        $div->division_id =8;
        $div->district = $district->districtname;
        $div->save();
    }
    return "DONE";
    }
}
