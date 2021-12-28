<?php

namespace App\Service\V1\Seller;

use App\Repository\V1\Seller\SellerRepository;

class SellerServiceAll
{

    protected $categoryRepository;

    public function __construct(SellerRepository $sellerRepository
    )
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->sellerRepository->all($searchQuery);
    }

}
