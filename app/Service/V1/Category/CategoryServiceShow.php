<?php

namespace App\Service\V1\Category;

use App\Repository\V1\Category\CategoryRepository;

class CategoryServiceShow
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show(int $id)
    {
        return $this->categoryRepository->show($id);
    }

}
