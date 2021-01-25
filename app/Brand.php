<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brands";

    protected $fillable=[
    	'category_id','subcategory_id','brand_name'
    ];

    public function category(){
    	return $this->belongsTo('App\Category','category_id');
    }

    public function subcategory(){
    	return $this->belongsTo('App\Subcategory','subcategory_id');
    }

    public function products(){
       return $this->hasMany('App\Product');
    }
}
