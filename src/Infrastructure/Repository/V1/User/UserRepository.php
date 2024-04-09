<?php

namespace Infrastructure\Repository\V1\User;

use Application\Dtos\UserDto;
use Domain\Exception\UserException;
use Domain\Exception\UserNotFoundException;
use Domain\Repository\UserRepositoryInterface;
use Domain\Entity\UserEntity;
use Illuminate\Support\Facades\DB;
use Infrastructure\Models\User;
use Infrastructure\Repository\V1\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function store(UserDto $userDto): UserEntity
    {
        DB::beginTransaction();
        try {
            $user = $this->obj->create([
                'name' => $userDto->name,
                'email' => $userDto->email,
                'password' => $userDto->password,
                'is_active' => $userDto->isActive
            ]);
            DB::commit();
            return new UserEntity(
                $user->name,
                $user->email,
                $user->is_active
            );
        } catch (\Exception $ex) {
            throw new UserException($ex->getMessage());
        }
    }

    public function login(string $column, string $value)
    {
        return $this->findByColumn($column, $value)->first();
    }

    public function show(int $id): UserEntity
    {
        $user = $this->obj->where('id', $id)->first();
        if($user){
            return new UserEntity(
                $user->name,
                $user->email,
                $user->is_active
            );
        }
        throw new UserNotFoundException();
    }
}
