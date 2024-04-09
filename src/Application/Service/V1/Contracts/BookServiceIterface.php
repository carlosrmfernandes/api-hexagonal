<?php
namespace Application\Service\V1\Contracts;
use Application\Dtos\BookDto;
use Application\Dtos\UserDto;
use Domain\Entity\BookEntity;

interface BookServiceIterface
{
    public function store(BookDto $bookDto): BookEntity;
    public function updateBook(int $id, BookDto $bookDto): bool;
    public function getAll(): array;
    public function delete(int $id): bool;
}

