<?php

namespace App\Repository\V1\DeliveryOrder;

use App\Models\DeliveryOrder;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class DeliveryOrderRepository extends BaseRepository
{

    public function __construct(DeliveryOrder $deliveryOrder)
    {
        parent::__construct($deliveryOrder);
    }
    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->with(['product.subCategory', 'product.user.category',
                    'product'=>function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                }])
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return $this->obj
            ->with(['product.subCategory', 'product.user.category'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public function save(array $deliveryOrder): object
    {
        DB::beginTransaction();
        try {
            $deliveryOrder = $this->obj->create($deliveryOrder);
            DB::commit();
            return $deliveryOrder;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $deliveryOrder = $this->obj->find($id);
            if ($deliveryOrder) {
                $deliveryOrder = $deliveryOrder->updateOrCreate([
                    'id' => $id,
                ], $attributes);
            }

            DB::commit();
            return (object) $deliveryOrder;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
            ->with(['product.subCategory', 'product.user.category'])
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
    }
}
