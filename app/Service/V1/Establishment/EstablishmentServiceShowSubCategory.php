<?php

namespace App\Service\V1\Establishment;

use App\Repository\V1\SubCategory\SubCategoryRepository;

class EstablishmentServiceShowSubCategory
{

    protected $subCategoryRepository;

    public function __construct(
        SubCategoryRepository $subCategoryRepository
    ) {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function show(int $id)
    {
        return $this->subCategoryRepository->show($id);
    }
    public function showSubCategoryProduct(int $id)
    {

        return $this->subCategoryRepository->showSubCategoryProduct($id);
    }
}
