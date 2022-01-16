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
    public function all($user_type = null, $searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->with(['product.subCategory','consumer',
                    'product'=>function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                }])
                ->where("$user_type", auth('api')->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(1000);
        }

        return $this->obj
            ->with(['product.subCategory','consumer'])
            ->where("$user_type", auth('api')->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(1000);
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
                $deliveryOrder = $deliveryOrder->update([
                    'status' => $attributes['status'],
                ]);
            }       
            DB::commit();            
            return  $this->obj->find($id)
                    ->with(['product', 'product.user','product.user.address'])
                    ->where('id', $id)
                    ->where('seller_id', auth('api')->user()->id)
                    ->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(string $user_type, int $id): object
    {
        return (object) $this->obj
            ->with(['product.subCategory','consumer'])
            ->where('id', $id)
            ->where("$user_type", auth('api')->user()->id)
            ->first();
    }

    public function verifyOrderSeller(int $id = null, $productId= null): object
    {
           return (object) $this->obj
                ->with(['product.subCategory', 'product.user.category'])
                ->where('id', $id)
                ->where('product_id', $productId)
                ->where('seller_id', auth('api')->user()->id)
                ->first();

    }
}
