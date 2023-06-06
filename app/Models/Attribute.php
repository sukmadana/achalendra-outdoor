<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'attribute_name'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function hasAttribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
