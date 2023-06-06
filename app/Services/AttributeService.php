<?php

namespace App\Services;

use App\Repositories\AttributeRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AttributeService
{
    protected $attributeRepo;

    public function __construct(AttributeRepository $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function get()
    {
        return $this->attributeRepo
            ->getAll();
    }

    public function getBySlug($slug)
    {
        return $this->attributeRepo
            ->bySlug($slug);
    }

    public function setSlug($name)
    {
        do {
            $tmp = Str::slug($name);
        } while (!$this->attributeRepo->slugExist($tmp));

        return $tmp;
    }

    public function store($data, $slug = null)
    {
        $validator = Validator::make($data, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if ($slug == null) {
            return $this->attributeRepo
            ->add($data);
        }else{
            return $this->attributeRepo->edit($slug, $data);
        }
    }

    public function delete($slug){
        if (isset($slug)) {
            return $this->attributeRepo->delete($slug);
        }
    }
}
