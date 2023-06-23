<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Services\ProductService;
use App\Models\ProductGallery;
use App\Models\Product;

use Storage;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->product->getAll($request->all());
    }

    public function setSlug($value){
        $slug = Str::Slug($value);
            if(Product::whereSlug($slug)->exists()){
                return $slug = Str::slug( $value . '-' . Str::random(3));
            }

        return $slug;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->slug = $this->setSlug($request->name);
        $product->product_name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->attributes = $request->attributes;
        $product->tags = $request->tags;
        $product->save();


        $images = $request->images;

        foreach($images as $image) {
            $imagePath = Storage::disk('uploads')->put('products/' . $image->getClientOriginalName(), $image);
            ProductGallery::create([
                'file_url' => env('APP_URL') . '/uploads/' . $imagePath ,
                'file_path' => '/uploads/' . $imagePath,
                'file_name' => $image->getClientOriginalName(),
                'product_id' => $product->id
            ]);
        }

        $data = Product::with('productCategory', 'productGallery')->where('slug', $product->slug)->first();

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return $this->product->bySlug($slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->product_name = $request->input('name');
        $product->price = $request->price;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->attributes = $request->attributes;
        $product->tags = $request->tags;
        $product->update();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach($images as $image) {
                $imagePath = Storage::disk('uploads')->put('products/' . $image->getClientOriginalName(), $image);
                ProductGallery::create([
                    'file_url' => env('APP_URL') . '/uploads/' . $imagePath ,
                    'file_path' => '/uploads/' . $imagePath,
                    'file_name' => $image->getClientOriginalName(),
                    'product_id' => $product->id
                ]);

            }

        }

        return $this->product->bySlug($slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);

        $images = ProductGallery::where('product_id', $id)->get();

        if ($images) {
            foreach ($images as $image) {
                $deleteImage = Storage::disk('uploads')->delete($image->file_path);

                if ($deleteImage) {
                    $image->delete();
                }
            }
        }

        $deleteData = $data->delete();

        if ($deleteData) {
            return response()->json([
                'status' => 'Success'
            ], 200);
        }
    }
}
