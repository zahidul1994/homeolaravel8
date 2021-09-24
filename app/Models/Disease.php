<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{    use Sluggable;
   protected $fillable=[
       'diseasename',
       'menwomen',
	   'slug',
       'diseaseimage',
       'description',
       'use',
       'dmuse',
       'admin_id',
       'status',
       ];

   public function sluggable()
        {
            return [
                'slug' => [
                    'source' => 'diseasename'
                ]
            ];
        }
 
       public function medicineinformation() {
           
                return $this->hasOne('App\Models\Medicineinformation');
            }
            
            public function disemedicine() {
           
                return $this->hasOne('App\Models\Disemedicine');
            }
}
