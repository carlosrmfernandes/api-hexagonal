<?php

namespace Application\Service\V1\User;

use Application\Service\V1\Contracts\UserServiceIterface;
use Domain\Entity\UserEntity;
use Domain\Repository\UserRepositoryInterface;
use Application\Dtos\UserDto;
use function bcrypt;

class UserService implements UserServiceIterface
{
    public UserRepositoryInterface $userRepositoryInterface;
    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function store(UserDto $userDto): UserEntity
    {
        $userDto->password = bcrypt($userDto->password);
        return $this->userRepositoryInterface->store($userDto);
    }

    public function show(int $id): object
    {
        return $this->userRepositoryInterface->show($id);
    }
    public function login(array $credentials)
    {
        return $this->userRepositoryInterface->login("email",$credentials['email']);
    }

}
