<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
