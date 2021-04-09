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


    public function show(int $id): object
    {
        return (object) $this->obj
                        ->where('id', $id)
                        ->first();
    }

}
