<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function diseaseinfo(Request $request)
     {
        $data = Disease::with('disemedicine')->wherestatus(1)->paginate(12);
        return response()->json($data);

        $all = Cache::remember('disease', 30, function() {
            return Disease::all();
        });
        
        $page = $request->has('page') ? $request->query('page') : 1;
        $perPage = 6;
        
        $data = new LengthAwarePaginator(
            $all->forPage($page, $perPage), $all->count(), $perPage, $page
        );
        return response()->json($data);
     }
 
    public function alldisease()
    {
      return response()->json(
        Disease::whereuse(1)->select('id','diseasename')->get()
      );
    }

    public function editalldisease()
    {
      return response()->json(
        Disease::wherestatus(1)->select('id','diseasename','use')->get()
      );
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function alldiseaseinfo()
    {
        return response()->json(
            Disease::wheredmuse(0)->select('id','diseasename')->get()
          );
    } 
   
    public function allupdiseaseinfo()
    {
        return response()->json(
            Disease::select('id','diseasename')->get()
          );
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
      $disease= Disease::with('disemedicine')->whereslug($id)->first();
      return response()->json([
            'disease'=>$disease
         
        
        ],200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        //
    }
}
