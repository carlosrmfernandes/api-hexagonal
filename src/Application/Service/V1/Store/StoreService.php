<?php

namespace Application\Service\V1\Store;

use Application\Dtos\StoreDto;
use Application\Service\V1\Contracts\StoreServiceIterface;
use Domain\Entity\StoreEntity;
use Domain\Repository\StoreRepositoryInterface;

class StoreService implements StoreServiceIterface
{

    public StoreRepositoryInterface $storeRepositoryInterface;
    public function __construct(StoreRepositoryInterface $storeRepositoryInterface)
    {
        $this->storeRepositoryInterface = $storeRepositoryInterface;
    }

    public function store(StoreDto $storeDto): StoreEntity
    {
        return $this->storeRepositoryInterface->store($storeDto);
    }

    public function updateStore(int $id, StoreDto $storeDto): bool
    {
        return $this->storeRepositoryInterface->updateStore($id, $storeDto);
    }

    public function getAll(): array
    {
        return $this->storeRepositoryInterface->getAll();
    }

    public function delete(int $id): bool
    {
        return $this->storeRepositoryInterface->delete($id);
    }
}
