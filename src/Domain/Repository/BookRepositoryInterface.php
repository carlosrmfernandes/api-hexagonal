<?php

namespace Domain\Repository;

use Application\Dtos\BookDto;
use Domain\Entity\BookEntity;
interface BookRepositoryInterface
{
    public function store(BookDto $bookDto): BookEntity;
    public function updateBook(int $id, BookDto $bookDto): bool;
    public function getAll(): array;
    public function delete(int $id): bool;
}
