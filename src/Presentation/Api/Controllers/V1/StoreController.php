<?php

namespace Presentation\Api\Controllers\V1;

use App\Http\Controllers\Controller;
use Application\Dtos\StoreDto;
use Application\Requests\StoreRequest;
use Application\Service\V1\Contracts\StoreServiceIterface;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public StoreServiceIterface $storeServiceIterface;

    public function __construct(
        StoreServiceIterface $storeServiceIterface
    )
    {
        $this->storeServiceIterface = $storeServiceIterface;
    }

    public function getAll(): JsonResponse
    {
        return response()->json(
            $this->storeServiceIterface->getAll()
        );
    }
    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->storeServiceIterface->store(new StoreDto(
                $request->name,
                $request->address,
                $request->active
            ))
        );
    }

    public function update(int $id, StoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->storeServiceIterface->updateStore($id,
                new StoreDto(
                    $request->name,
                    $request->address,
                    $request->active
                ))
        );
    }

    public function delete(int $id): JsonResponse
    {
        return response()->json(
            $this->storeServiceIterface->delete($id)
        );
    }
}
