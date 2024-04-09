<?php

namespace Infrastructure\Repository\V1\User\Book;

use Application\Dtos\BookDto;
use Domain\Entity\BookEntity;
use Domain\Exception\BookException;
use Domain\Repository\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Infrastructure\Models\Book;
use Infrastructure\Repository\V1\BaseRepository;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    public function store(BookDto $bookDto): BookEntity
    {
        DB::beginTransaction();
        try {
            $book = $this->obj->create([
                'name' => $bookDto->name,
                'isbn' => $bookDto->isbn,
                'value' => $bookDto->value,
            ]);
            $book->stores()->attach($bookDto->stores);
            DB::commit();
            return new BookEntity(
                $book->name,
                $book->isbn,
                $book->value,
                $book->id
            );
        } catch (\Exception $ex) {
            throw new BookException($ex->getMessage());
        }
    }

    public function getAll(): array
    {
        return Book::query()->get()
            ->map(function (Book $book) {
                return new BookEntity(
                    $book->name,
                    $book->isbn,
                    $book->value,
                    $book->id
                );
            })->toArray();
    }
    public function updateBook(int $id, BookDto $bookDto): bool
    {
        $book = Book::find($id);
        if($book){
            $book->stores()->sync($bookDto->stores);
            return $book->update([
                'name' => $bookDto->name,
                'isbn' => $bookDto->isbn,
                'value' => $bookDto->value
            ]);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        return $this->obj->destroy($id);
    }
}
