<?php

namespace App\Http\Controllers;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DivisionController extends Controller
{
    public function index(){
  return Division::get();
}



public function store(){
    $response =Http::get('https://www.bikebd.com/den/api/showroomdivision');

 $divisionvalue=json_decode($response->body());
  
   foreach($divisionvalue as $division){
    $div = new Division;
    $div->division = $division->divisionname;
    $div->save();
}
return "DONE";
}



}
