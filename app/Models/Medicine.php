<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use Sluggable;
protected $fillable=[
    'medicinename',
    'slug',
    'medicinbn',
    'color',
    'minides',
    'status'

];

public function sluggable()
{
    return [
        'slug' => [
            'source' => 'medicinename'
        ]
    ];
}

}
