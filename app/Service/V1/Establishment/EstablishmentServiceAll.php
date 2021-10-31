<?php

namespace App\Service\V1\Establishment;

use App\Repository\V1\Establishment\EstablishmentRepository;

class establishmentServiceAll
{

    protected $categoryRepository;

    public function __construct(EstablishmentRepository $establishmentRepository
    )
    {
        $this->establishmentRepository = $establishmentRepository;
    }

    public function all($searchQuery = null, $categoryId= null)
    {
        return $this->establishmentRepository->all($searchQuery, $categoryId);
    }

}
