<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Transformers\ProductCategoryTransformer;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendProductController extends Controller
{

    public function getProduct(Request $request)
    {
        if ($request->search) {
            $product = Product::with(['productCategory', 'productGallery'])->where('product_name', 'LIKE', '%' . $request->search . '%')->orWhere('tags', 'LIKE', '%' . $request->search . '%')->where('status', 'publish')->inRandomOrder()->limit(4)->get();

            return fractal($product, new ProductTransformer())->toArray();
        }

        $product = Product::with(['productCategory', 'productGallery'])->where('status', 'publish')->inRandomOrder()->limit(4)->get();
        return fractal($product, new ProductTransformer())->toArray();
    }

    public function getProductCategory(){
        $data = ProductCategory::all();
        return fractal($data, new ProductCategoryTransformer())->toArray();
    }

    public function getProductBySlug($slug){
        $product = Product::where('slug', $slug)->where('status', 'publish')->first();

        return fractal($product, new ProductTransformer())->toArray();
    }

    public function getAllProduct(){
        $data = Product::inRandomOrder()->get();

        return fractal($data, new ProductTransformer())->toArray();
    }
}
