<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovieFilters
 *
 * @author carlosfernandes
 */

namespace App\Filters\V1\CategorySeller;

use App\Service\V1\Category\CategoryServiceWithSeller;

class CategorySellerFilters
{

    private $searchQuery;
    private $categoryServiceWithSeller;

    public function __construct(
        CategoryServiceWithSeller $categoryServiceWithSeller
    )
    {
        $this->categoryServiceWithSeller = $categoryServiceWithSeller;
    }

    public function apply($request, $id)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->categoryServiceWithSeller->categoryWithSeller($this->searchQuery, $id);
    }

}
