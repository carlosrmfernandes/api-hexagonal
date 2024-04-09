<?php

namespace Infrastructure\Repository\V1\User\Store;

use Application\Dtos\StoreDto;
use Domain\Entity\StoreEntity;
use Domain\Exception\StoreException;
use Domain\Repository\StoreRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Infrastructure\Models\Store;
use Infrastructure\Repository\V1\BaseRepository;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    public function __construct(Store $store)
    {
        parent::__construct($store);
    }

    public function store(StoreDto $storeDto): StoreEntity
    {
        DB::beginTransaction();
        try {
            $store = $this->obj->create([
                'name' => $storeDto->name,
                'address' => $storeDto->address,
                'active' => $storeDto->active,
            ]);
            DB::commit();
            return new StoreEntity(
                $store->name,
                $store->address,
                $store->active,
                $store->id
            );
        } catch (\Exception $ex) {
            throw new StoreException($ex->getMessage());
        }
    }

    public function getAll(): array
    {
        return Store::query()->get()
            ->map(function (Store $store) {
                return new StoreEntity(
                    $store->name,
                    $store->address,
                    $store->active,
                    $store->id
                );
            })->toArray();
    }

    public function updateStore(int $id, StoreDto $storeDto): bool
    {
        $book = Store::find($id);
        if ($book) {
            return $book->update([
                'name' => $storeDto->name,
                'address' => $storeDto->address,
                'active' => $storeDto->active,
            ]);
        }
        return false;
    }
    public function delete(int $id): bool
    {
        return $this->obj->destroy($id);
    }
}
