<?php

namespace App\Repository\V1\Establishment;

use App\Models\User;
use App\Repository\V1\BaseRepository;

class EstablishmentRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all($searchQuery = null, $categoryId = null): object
    {
        if ($searchQuery) {
            return $this->obj
                            ->where('name', 'like', '%' . $searchQuery . '%')
                            ->where('user_type_id',2)
                            ->where('category_id',$categoryId)
                            ->paginate(10);
        }
        return $this->obj
                        ->where('user_type_id',2)
                        ->where('category_id',$categoryId)
                        ->paginate(10);
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->with('product.subCategory')
                        ->where('id', $id)
                        ->first();
    }

}
