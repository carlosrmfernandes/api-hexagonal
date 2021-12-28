<?php

namespace App\Service\V1\Category;

use App\Repository\V1\Category\CategoryRepository;

class CategoryServiceWithSeller
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function categoryWithSeller(string $searchQuery = null ,int $id)
    {
        return $this->categoryRepository->categoryWithSeller($searchQuery, $id);
    }

}
