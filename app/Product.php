<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
       'category_id','subcategory_id','brand_id','name','image','base_price','details'
    ];

    public function category(){
    	return $this->belongsTo('App\Category','category_id');
    }

    public function subcategory(){
    	return $this->belongsTo('App\Subcategory','subcategory_id');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand','brand_id');
    }
}
