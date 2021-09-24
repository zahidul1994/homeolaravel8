<?php

namespace App\Http\Controllers;
use App\Models\Medisine;
use App\Models\Medisineinfo;
use App\Models\Viewcountmediinfo;
use App\Models\Medicineinformation;
use App\Helpers\CommonFx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class MedicineinformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medicineinformation::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
             
//return response(dd($request));exit;

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $medicineinfo =Medicineinformation::with('admin','disease.disemedicine')->whereslug(urldecode($id))->first();
         $totalview=Viewcountmediinfo::where('medicineinformation_id',$medicineinfo->id)->sum('click');
   //$medicineinfo->views +=1;
  // $medicineinfo->update();
  $ip= $request->ip();
            $blogid= $medicineinfo->id;
        if(Auth::guard('api')->guest()){
                $auth=null;
            }
            else{
                $auth=Auth::guard('api')->user()->id;
            }
        //   $auth=Auth::guard('api')->user()->id?:null;
        //   $auth=1;
              CommonFx::createMedicineinformation($blogid,$ip,$auth);
        return response()->json([
            'medicineinformation'=>$medicineinfo,
         'totalview'=>$totalview,
        
        ],200);
    }

   
  
 
  
}
