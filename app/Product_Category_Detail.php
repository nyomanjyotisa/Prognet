<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Category_Detail extends Model
{
    protected $table='product_category_details';

    protected $fillable = [
        'category_id', 'product_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }
}
