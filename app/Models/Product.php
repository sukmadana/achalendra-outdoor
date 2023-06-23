<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'product_name', 'price', 'description', 'qty', 'status', 'category_id', 'attributes', 'tags'
    ];

    protected $guarded = [];

    protected $casts = [
        'attributes' => 'array'
    ];

    public function productAttributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function productCategory(){
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productGallery()
    {
        return $this->hasMany(ProductGallery::class, 'id', 'product_id');
    }
}
