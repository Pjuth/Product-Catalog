<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'status', 'basePrice', 'specialPrice', 'image', 'description'];

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Base price including taxes if enabled.
     *
     * @return float|int|mixed
     */

    public function basePrice()
    {
        $configuration = Configuration::findOrFail(1);
        if ($configuration->tax_inclusion && $configuration->tax_rate > 0) {
            $tax = 1 + $configuration->tax_rate / 100;
        } else {
            $tax = 1;
        }

        return round($this->basePrice * $tax, 2);
    }

    /**
     * Special price calculation including individual discount, global discount and taxes if enabled.
     *
     * @return bool|float|int|mixed
     */

    public function specialPrice()
    {
        $configuration = Configuration::findOrFail(1);
        if ($this->specialPrice || $configuration->global_discount) {

            $configuration->tax_inclusion && $configuration->tax_rate ? $tax = 1 + $configuration->tax_rate / 100 : $tax = 1;
            $this->specialPrice ? $individualDiscount = 1 - $this->specialPrice / 100 : $individualDiscount = 1;
            $configuration->global_discount ? $globalDiscount = 1 - $configuration->global_discount / 100 : $globalDiscount = 1;

            $price = $this->basePrice;

            return round($price * $individualDiscount * $globalDiscount * $tax, 2);
        } else {
            return false;
        }
    }
}
