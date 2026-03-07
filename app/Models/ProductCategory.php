<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $fillable = [
        'product_category_name',
        'product_category_slug',
        'product_category_image',
    ];

    public function products(): HasMany
{
    return $this->hasMany(Product::class);
}
}
