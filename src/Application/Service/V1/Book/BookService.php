<?php

namespace Application\Service\V1\Book;

use Application\Dtos\BookDto;
use Application\Service\V1\Contracts\BookServiceIterface;
use Domain\Entity\BookEntity;
use Domain\Repository\BookRepositoryInterface;

class BookService implements BookServiceIterface
{

    public BookRepositoryInterface $bookRepositoryInterface;
    public function __construct(BookRepositoryInterface $bookRepositoryInterface)
    {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
    }
    public function store(BookDto $bookDto): BookEntity
    {
        return $this->bookRepositoryInterface->store($bookDto);
    }

    public function updateBook(int $id, BookDto $bookDto): bool
    {
        return $this->bookRepositoryInterface->updateBook($id, $bookDto);
    }

    public function getAll(): array
    {
        return $this->bookRepositoryInterface->getAll();
    }

    public function delete(int $id): bool
    {
        return $this->bookRepositoryInterface->delete($id);
    }
}
