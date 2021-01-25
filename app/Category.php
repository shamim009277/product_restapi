<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";

    protected $fillable=[
    	'name'
    ];

    public function subcategories(){
       return $this->hasMany('App\Subcategory');
    }

    public function brands(){
       return $this->hasMany('App\Brand');
    }

    public function products(){
       return $this->hasMany('App\Product');
    }
}
