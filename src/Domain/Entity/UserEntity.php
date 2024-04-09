<?php

namespace Domain\Entity;

class UserEntity
{
    public string $name;
    public string $email;
    public string $isActive;
    public function __construct(
        string $name,
        string $email,
        string $isActive
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getIsActive(): string
    {
        return $this->isActive;
    }


}
