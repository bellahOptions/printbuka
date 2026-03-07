<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_size',
        'print_type',
        'product_description',
        'short_product_description',
        'product_category_id',
        'available_product_color',
        'moq',
        'visibility',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}