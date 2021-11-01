<?php

namespace App\Service\V1\Establishment;

use App\Repository\V1\SubCategory\SubCategoryRepository;

class EstablishmentServiceShowSubCategoryWithProduct
{

    protected $subCategoryRepository;

    public function __construct(
        SubCategoryRepository $subCategoryRepository
    ) {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function showSubCategoryWithProduct(int $id)
    {
        return $this->subCategoryRepository->showSubCategoryWithProduct($id);
    }
}
