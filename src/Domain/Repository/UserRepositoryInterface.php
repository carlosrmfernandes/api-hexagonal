<?php

namespace Domain\Repository;

use Application\Dtos\UserDto;
use Domain\Entity\UserEntity;

interface UserRepositoryInterface
{
    public function login(string $column, string $value);
    public function store(UserDto $userDto): UserEntity;
    public function show(int $id): UserEntity;
}
