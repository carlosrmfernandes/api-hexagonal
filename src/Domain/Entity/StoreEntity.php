<?php

namespace Domain\Entity;

class StoreEntity
{
    public string $name;
    public string $address;
    public bool $active;
    public int $id;
    public function __construct(
        string $name,
        string $address,
        string $active,
        int $id
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->active = $active;
        $this->id = $id;
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
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

}
