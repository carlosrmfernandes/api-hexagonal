<?php

namespace Presentation\Api\Controllers\V1;

use App\Http\Controllers\Controller;
use Application\Dtos\BookDto;
use Application\Requests\BookRequest;
use Application\Service\V1\Contracts\BookServiceIterface;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public BookServiceIterface $bookServiceIterface;

    public function __construct(
        BookServiceIterface $bookServiceIterface
    )
    {
        $this->bookServiceIterface = $bookServiceIterface;
    }

    public function getAll(): JsonResponse
    {
        return response()->json(
            $this->bookServiceIterface->getAll()
        );
    }

    public function store(BookRequest $request): JsonResponse
    {
        return response()->json(
            $this->bookServiceIterface->store(new BookDto(
                $request->name,
                $request->isbn,
                $request->value,
                $request->stores
            ))
        );
    }

    public function update(int $id, BookRequest $request): JsonResponse
    {
        return response()->json(
            $this->bookServiceIterface->updateBook($id, new BookDto(
                $request->name,
                $request->isbn,
                $request->value,
                $request->stores
            ))
        );
    }

    public function delete(int $id): JsonResponse
    {
        return response()->json(
            $this->bookServiceIterface->delete($id)
        );
    }
}
