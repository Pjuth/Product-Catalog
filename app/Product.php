<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'status', 'basePrice', 'specialPrice', 'description'];

    public function review(){
        return $this->hasMany(Review::class);
    }
}
