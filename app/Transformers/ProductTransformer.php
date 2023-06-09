<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
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
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->product_name,
            'description' => $product->description,
            'price' => $product->price,
            'qty' => $product->qty,
            'attributes' => $product->attributes,
            'tags' => $product->tags,
            'category' => $product->productCategory,
            'gallery' => $this->getGalleryImage($product),
            'status' => $product->status
        ];
    }

    public function getGalleryImage($product){
        $galleries = ProductGallery::where('product_id', $product->id)->get();
        return $galleries;
    }

    // public function includeProductCategory(Product $product){
    //     $productCat = $product->id_category;

    //     return $this->item($productCat, new ProductCategoryTransformer);
    // }
}
