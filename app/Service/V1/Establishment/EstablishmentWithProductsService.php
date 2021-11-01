<?php

namespace App\Service\V1\Establishment;

use App\Repository\V1\Establishment\EstablishmentRepository;

class EstablishmentWithProductsService
{

    protected $establishmentRepository;

    public function __construct(
        EstablishmentRepository $establishmentRepository
    ) {
        $this->establishmentRepository = $establishmentRepository;
    }

    public function establishmentWithProducts(int $id)
    {
        return $this->establishmentRepository->establishmentWithProducts($id);
    }
}
