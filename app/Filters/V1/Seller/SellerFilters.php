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

namespace App\Filters\V1\Seller;

use App\Service\V1\Seller\SellerServiceAll;

class SellerFilters
{

    private $searchQuery;
    private $sellerServiceAll;

    public function __construct(
        SellerServiceAll $sellerServiceAll
    )
    {
        $this->sellerServiceAll = $sellerServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->sellerServiceAll->all($this->searchQuery);
    }

}
