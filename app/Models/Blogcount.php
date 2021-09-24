<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogcount extends Model
{
  protected $fillable=['user_id','blog_id','click','ip'];
}
