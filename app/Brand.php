<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\BrandCreated;
use App\Events\BrandUpdated;
use App\Events\BrandDeleted;

class Brand extends Model
{
    protected $table="brands";

    protected $fillable=[
    	'category_id','subcategory_id','brand_name'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => BrandCreated::class,
        'updated' => BrandUpdated::class,
        'deleted' => BrandDeleted::class,
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
