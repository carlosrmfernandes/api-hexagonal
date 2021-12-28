<?php

namespace App\Repository\V1\Seller;

use App\Models\User;
use App\Repository\V1\BaseRepository;

class SellerRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all($searchQuery = null, $categoryId = null): object
    {
            return $this->obj
                            ->with('address')
                            ->orWhere('name', 'like', '%' . $searchQuery . '%')
                            ->where('user_type_id',2)
                            ->paginate(10);

    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->with(['address','product.subCategory'])
                        ->where('id', $id)
                        ->first();
    }

    public function sellerWithProducts(int $id): object
    {
        return (object) $this->obj
                        ->with(['address','product.subCategory'])
                        ->where('id', $id)
                        ->first();
    }

}
