<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Blog extends Model
{
    use Notifiable, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=[
        
        'title','slug','keyword','photo','metadescription','tag','status','admin_id','category_id','description','created_at','updated_at','schemainfo'      
        ];
        public function category()
        {
            return $this->belongsTo('App\Models\Category','category_id','id');
        }
        
          public function admin()
    {
        return $this->belongsTo('App\Models\Admin')->select('id','name','image','username','profession','aboutyou');
    }
}
