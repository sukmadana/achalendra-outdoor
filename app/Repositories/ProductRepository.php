<?php

namespace App\Repositories;

use App\Models\Product;

use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'slug',
        'product_name',
        'price',
        'description',
        'qty',
        'status',
        'category_id'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Product::class;
    }

    public function getProduct(){
        $product = Product::with(['productCategory', 'productGallery'])->get();

        return $product;
    }

    public function add($input){
        $query = $this->model->newQuery();
        $prod = $query->create([
                'slug' => $this->setSlug($input['name']),
                'product_name' => $input['name'],
                'price' => $input['price'],
                'description' => $input['description'],
                'qty' => $input['qty'],
                'status' => $input['status'],
                'category_id' => $input['category_id'],
                'attributes' => $input['attributes'],
                'tags' => $input['tags']
            ]);

        return $prod->fresh();
    }

    public function edit($input, $slug)
    {
        $query = $this->model->newQuery();
        $prod = $query->where('slug', $slug)
            ->update([
                'product_name' => $input['name'],
                'price' => $input['price'],
                'description' => $input['description'],
                'qty' => $input['qty'],
                'status' => $input['status'],
                'category_id' => $input['category_id'],
                'attributes' => $input['attributes'],
                'tags' => $input['tags']
            ]);

            if ($prod) {
                return $this->find($slug);
            }
    }
}
