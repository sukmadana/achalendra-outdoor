<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Transformers\AttributeTransformer;
use App\Services\AttributeService;

class AttributeController extends Controller
{

    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->attributeService->get();

        return fractal()
        ->collection($attributes)
        ->transformWith(new AttributeTransformer())
        ->toArray();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => $request->name
        );
        $attribute = $this->attributeService->store($data);
        return fractal($attribute, new AttributeTransformer())->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$attribute = $this->attributeService->getBySlug($slug);

		return fractal($attribute, new AttributeTransformer())->respond();
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
        $attribute = $this->attributeService->store($request->all(), $slug);

        return fractal($attribute, new AttributeTransformer())->respond();
        // return response()->json($attribute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        return $this->attributeService->delete($slug);
    }
}
