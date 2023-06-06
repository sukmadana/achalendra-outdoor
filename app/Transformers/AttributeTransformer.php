<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Attribute;

class AttributeTransformer extends TransformerAbstract
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
    public function transform(Attribute $attribute)
    {
        return [
            'slug' => $attribute->slug,
            'name' => $attribute->attribute_name
        ];
    }
}
