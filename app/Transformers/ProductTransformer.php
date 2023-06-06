<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Transformers\ProductCategoryTransformer;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        // 'product_category'
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'slug' => $product->slug,
            'name' => $product->product_name,
            'description' => $product->description,
            'price' => $product->price,
            'qty' => $product->qty,
            'category' => $product->productCategory,
            'status' => $product->status
        ];
    }

    // public function includeProductCategory(Product $product){
    //     $productCat = $product->id_category;

    //     return $this->item($productCat, new ProductCategoryTransformer);
    // }
}
