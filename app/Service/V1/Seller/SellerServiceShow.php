<?php

namespace App\Service\V1\Seller;

use App\Repository\V1\Seller\SellerRepository;

class SellerServiceShow
{

    protected $categoryRepository;

    public function __construct(SellerRepository $sellerRepository
    )
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function show(int $id)
    {
        return $this->sellerRepository->show($id);
    }

    public function showSellerWithCategory(int $id)
    {
        return $this->sellerRepository->show($id);
    }

}
