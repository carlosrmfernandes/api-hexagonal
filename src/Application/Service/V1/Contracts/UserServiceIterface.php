<?php
namespace Application\Service\V1\Contracts;
use Application\Dtos\UserDto;
interface UserServiceIterface
{
    public function login(array $credentials);
    public function store(UserDto $userDto);
    public function show(int $id);
}

