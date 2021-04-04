<?php

namespace App\Repository\V1\Product;

use App\Models\Product;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
    public function all(): object
    {
        return (object) null ;
    }
    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $product = $this->obj->create($attributes);
            DB::commit();
            return $product;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $product = $this->obj->find($id);
            if ($product) {
                $product = $product->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return (object) $product;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->with(['subCategory.category','user'])
                        ->where('id', $id)
                        ->first();
    }

}
