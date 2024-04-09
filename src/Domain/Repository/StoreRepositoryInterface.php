<?php

namespace Domain\Repository;

use Application\Dtos\StoreDto;
use Domain\Entity\StoreEntity;

interface StoreRepositoryInterface
{
    public function store(StoreDto $storeDto): StoreEntity;
    public function updateStore(int $id, StoreDto $storeDto): bool;
    public function getAll(): array;
    public function delete(int $id):bool;
}
