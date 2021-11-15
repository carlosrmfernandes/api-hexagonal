<?php

namespace App\Repository\V1\Category;

use App\Models\Category;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function all(): object
    {
        return (object) $this->obj
                            ->get();
    }
    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $category = $this->obj->create($attributes);
            DB::commit();
            return $category;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $category = $this->obj->find($id);
            if ($category) {
                $category = $category->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return (object) $category;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->with('subCategory')
                        ->where('id', $id)
                        ->first();
    }

    public function categoryWithSeller($searchQuery = null, int $id = null){

        return (object) $this->obj
                        ->with(['users.category','users'=>function($query) use ($searchQuery){
                            $query->where("name", "like", "%" . $searchQuery . "%");
                        }])
                        ->where('id', $id)
                        ->first();
    }

}
