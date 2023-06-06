<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'attribute_id', 'product_id', 'name' ];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
