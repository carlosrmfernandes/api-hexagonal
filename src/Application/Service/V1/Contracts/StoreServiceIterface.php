<?php
namespace Application\Service\V1\Contracts;
use Application\Dtos\StoreDto;
use Application\Dtos\UserDto;
use Domain\Entity\StoreEntity;

interface StoreServiceIterface
{
    public function store(StoreDto $storeDto): StoreEntity;
    public function updateStore(int $id, StoreDto $storeDto): bool;
    public function getAll(): array;
    public function delete(int $id):bool;
}

