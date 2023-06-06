<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Transformers\ProductTransformer;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    protected $product;

    public function __construct(ProductRepository $repo)
    {
        $this->product = $repo;
    }

    public function getAll($input){
        // $data = $this->product->all($input);

        $data = $this->product->getProduct();

        return fractal($data, new ProductTransformer())->toArray();
        // return $data;
    }

    public function bySlug($slug){
        $data = $this->product->find($slug);

        return fractal($data, new ProductTransformer())->respond();
    }

    public function addOrUpdate($input, $slug = null){
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if ($slug == null) {
            $data = $this->product->add($input);
            return fractal($data, new ProductTransformer())->respond();
        }else{
            $data = $this->product->edit($input, $slug);
            return fractal($data, new ProductTransformer())->respond();
        }
    }

    public function delete($id){
        return $this->product->delete($id);
    }
}
