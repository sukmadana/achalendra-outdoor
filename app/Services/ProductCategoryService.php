<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Transformers\ProductCategoryTransformer;
use Illuminate\Support\Facades\Validator;

class ProductCategoryService
{
    protected $productCategory;

    public function __construct(ProductCategoryRepository $repo)
    {
        $this->productCategory = $repo;
    }

    public function getAll($input){
        $data = $this->productCategory->all($input);

        return fractal($data, new ProductCategoryTransformer())->toArray();
    }

    public function bySlug($slug){
        $data = $this->productCategory->find($slug);

        return fractal($data, new ProductCategoryTransformer())->respond();
    }

    public function addOrUpdate($input, $slug = null){
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if ($slug == null) {
            $data = $this->productCategory->add($input);
            return fractal($data, new ProductCategoryTransformer())->respond();
        }else{
            $data = $this->productCategory->edit($input, $slug);
            return fractal($data, new ProductCategoryTransformer())->respond();
        }
    }

    public function delete($id){
        return $this->productCategory->delete($id);
    }
}
