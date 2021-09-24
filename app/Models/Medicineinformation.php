<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
class Medicineinformation extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable =[
            'title',
            'slug',
            'keyword',
            'photo',
            'metadescription',
             'schemainfo',
            'status',
            'description',
            'admin_id',
            'superadmin_id',
            'views',
            'disease_id',
        ];
       
        public function sluggable()
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }
        
   public function viewcountmidicineinfo() {
           
                return $this->hasMany('App\Models\Viewcountmediinfo')->select('click','medicineinformation_id');
            }
            
     
        public function disease()
    {
        return $this->belongsTo('App\Models\Disease','disease_id','id');
    }
    
        public function admin()
    {
        return $this->belongsTo('App\Models\Admin')->select('id','name');
    }
}
