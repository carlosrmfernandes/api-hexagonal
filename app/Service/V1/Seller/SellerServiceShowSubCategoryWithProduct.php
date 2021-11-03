<?php

namespace App\Service\V1\Seller;

use App\Repository\V1\SubCategory\SubCategoryRepository;

class SellerServiceShowSubCategoryWithProduct
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
