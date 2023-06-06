<?php

namespace App\Repositories;

use App\Models\Attribute;
use Illuminate\Support\Str;

class AttributeRepository
{
    protected $attribute;

    private function setSlug($value){
        $slug = Str::Slug($value);
            if($this->attribute->whereSlug($slug)->exists()){
                return $slug = Str::slug( $value . '-' . Str::random(3));
            }

        return $slug;

    }

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
    public function getAll()
    {
        return $this->attribute->orderBy('created_at', 'DESC')->get();
    }

    public function bySlug($slug)
    {
        return $this->attribute
            ->where('slug', $slug)
            ->first();
    }

    public function slugExist($slug)
    {
        return $this->attribute
            ->where('slug', $slug)
            ->exists();
    }

    public function add($data)
    {
        $attr = $this->attribute
            ->create([
                'slug' => $this->setSlug($data['name']),
                'attribute_name' => $data['name']
            ]);

        return $attr->fresh();
    }

    public function edit($slug, $data)
    {
        $attr = $this->attribute
            ->where('slug', $slug)
            ->update([
                'attribute_name' => $data['name']
            ]);

            if ($attr) {
                return $this->bySlug($slug);
            }
    }

    public function delete($slug)
    {
        return $this->attribute
            ->where('slug', $slug)
            ->delete();
    }
}
