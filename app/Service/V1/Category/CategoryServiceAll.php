<?php

namespace App\Service\V1\Category;

use App\Repository\V1\Category\CategoryRepository;

class CategoryServiceAll
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

}
