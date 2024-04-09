<?php

namespace Domain\Entity;

class BookEntity
{
    public int $id;
    public string $name;
    public int $isbn;
    public float $value;
    public function __construct(
        string $name,
        string $isbn,
        string $value,
        int $id
    )
    {
        $this->name = $name;
        $this->isbn = $isbn;
        $this->value = $value;
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
     * @return int
     */
    public function getIsbn(): int
    {
        return $this->isbn;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

}
