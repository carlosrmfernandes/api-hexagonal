<?php

namespace Application\Dtos;
class StoreDto
{
    public string $name;
    public string $address;
    public bool $active;
    public function __construct(
        string $name,
        string $address,
        bool $active
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->active = $active;
    }
}
