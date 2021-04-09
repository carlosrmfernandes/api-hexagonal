<?php

namespace App\Service\V1\Establishment;

use App\Repository\V1\Establishment\EstablishmentRepository;

class EstablishmentServiceShow
{

    protected $categoryRepository;

    public function __construct(EstablishmentRepository $establishmentRepository
    )
    {
        $this->establishmentRepository = $establishmentRepository;
    }

    public function show(int $id)
    {
        return $this->establishmentRepository->show($id);
    }

}
