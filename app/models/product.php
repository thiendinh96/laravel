<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
   protected $table="product";


// liên kết 1 - 1 theo chiều nghịch
 public function category()
 {
     return $this->belongsTo('App\models\category', 'category_id', 'id');
 }


}
