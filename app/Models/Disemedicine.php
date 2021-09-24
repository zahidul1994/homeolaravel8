<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disemedicine extends Model
{
    
    protected $fillable=[
        'medicine',
        'admin_id',
        'disease_id',
        
    
    ];
    // protected $casts = [        
    //     'medicine' => 'array'
    // ];
    public function disease()
     {
        return $this->belongsTo('App\Models\Disease','disease_id','id')->select('id','diseasename');
    }
 
}
