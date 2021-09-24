<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use App\Models\Medicineinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function index()
    {
        return Medicine::latest()->get();
    }

    public function allmedicine()
    {
        return Medicine::select('id','medicinename')->get();
    }

   
    public function show($id)
    {
        $disease =Medicineinfo::wheredisease_id($id)->first();
        return response()->json(['diseaseinfo'=>$disease],200);
    } 
    
    public function medicineinformation($id)
    {
        $disease =Medicineinfo::whereslug($id)->first();
        return response()->json(['medicineinfo'=>$disease],200);
    }


}
