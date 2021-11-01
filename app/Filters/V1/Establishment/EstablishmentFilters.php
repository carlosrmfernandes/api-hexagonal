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

namespace App\Filters\V1\Establishment;

use App\Service\V1\Establishment\EstablishmentServiceAll;

class EstablishmentFilters
{

    private $searchQuery;
    private $establishmentServiceAll;

    public function __construct(
        EstablishmentServiceAll $establishmentServiceAll
    )
    {
        $this->establishmentServiceAll = $establishmentServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->establishmentServiceAll->all($this->searchQuery);
    }

}
