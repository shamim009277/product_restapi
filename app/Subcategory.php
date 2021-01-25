<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table="subcategories";

    protected $fillable=[
    	'category_id','subcategory_name'
    ];

    public function category(){
    	return $this->belongsTo('App\Category','category_id');
    }

    public function products(){
       return $this->hasMany('App\Product');
    }
}
