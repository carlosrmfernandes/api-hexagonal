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

namespace App\Filters\V1\CategoryEstablishment;

use App\Service\V1\Category\CategoryServiceWithEstablishment;

class CategoryEstablishmentFilters
{

    private $searchQuery;
    private $categoryServiceWithEstablishment;

    public function __construct(
        CategoryServiceWithEstablishment $categoryServiceWithEstablishment
    )
    {
        $this->categoryServiceWithEstablishment = $categoryServiceWithEstablishment;
    }

    public function apply($request, $id)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->categoryServiceWithEstablishment->categoryWithEstablishment($this->searchQuery, $id);
    }

}
