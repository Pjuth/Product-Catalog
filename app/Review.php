<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id', 'name', 'rating', 'message'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
