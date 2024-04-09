<?php

namespace Application\Dtos;
class BookDto
{
    public string $name;
    public int $isbn;
    public float $value;
    public array $stores;
    public function __construct(
        string $name,
        string $isbn,
        string $value,
        array $stores
    )
    {
        $this->name = $name;
        $this->isbn = $isbn;
        $this->value = $value;
        $this->stores = $stores;
    }
}
