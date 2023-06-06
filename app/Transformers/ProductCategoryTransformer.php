<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\ProductCategory;

class ProductCategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
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
    public function transform(ProductCategory $category)
    {
        return [
            'id' => $category->id,
            'slug' => $category->slug,
            'name' => $category->category_name
        ];
    }
}
