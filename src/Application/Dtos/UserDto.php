<?php

namespace Application\Dtos;
class UserDto
{
    public string $name;
    public string $email;
    public string $password;
    public string $isActive;
    public function __construct(
        string $name,
        string $email,
        string $password,
        string $isActive
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->isActive = $isActive;
    }

}
