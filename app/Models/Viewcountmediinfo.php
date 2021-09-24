<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewcountmediinfo extends Model
{
    protected $fillable=['user_id','medicineinformation_id','click','ip'];
    
       public function medicineinformation()
    {
        return $this->belongsTo('App\Models\Medicineinformation','medicineinformation_id','id');
    }
}
