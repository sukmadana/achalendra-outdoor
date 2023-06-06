<?php 

namespace App\Repositories;

use App\Models\ProductCategory;

use App\Repositories\BaseRepository;

class ProductCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'slug',
        'category_name',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return ProductCategory::class;
    }

    public function add($input){
        $query = $this->model->newQuery();
        $cat = $query->create([
                'slug' => $this->setSlug($input['name']),
                'category_name' => $input['name']
            ]);

        return $cat->fresh();
    }

    public function edit($data, $slug)
    {
        $query = $this->model->newQuery();
        $cat = $query->where('slug', $slug)
            ->update([
                'category_name' => $data['name']
            ]);

            if ($cat) {
                return $this->find($slug);
            }
    }
}