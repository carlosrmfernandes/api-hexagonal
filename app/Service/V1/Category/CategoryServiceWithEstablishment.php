<?php

namespace App\Service\V1\Category;

use App\Repository\V1\Category\CategoryRepository;

class CategoryServiceWithEstablishment
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function categoryWithEstablishment(string $searchQuery = null ,int $id)
    {
        return $this->categoryRepository->categoryWithEstablishment($searchQuery, $id);
    }

}
