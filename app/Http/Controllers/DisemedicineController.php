<?php

namespace App\Http\Controllers;

use App\Models\Disemedicine;
use Illuminate\Http\Request;

class DisemedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $diseagemedicine=Disemedicine::wheredisease_id($id)-get();
    }
    public function diseasemedicine($id)
    {
        $diseagemedicine=Disemedicine::wheredisease_id($id)->first();
        
            return  response()->json([
                'diseasemedicine'=>$diseagemedicine
            ], 200);
       
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disemedicine  $disemedicine
     * @return \Illuminate\Http\Response
     */
    public function show(Disemedicine $disemedicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disemedicine  $disemedicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Disemedicine $disemedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disemedicine  $disemedicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disemedicine $disemedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disemedicine  $disemedicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disemedicine $disemedicine)
    {
        //
    }
}
