<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['tax_rate', 'tax_inclusion', 'global_discount'];
}
