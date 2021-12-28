<?php

namespace App\Service\V1\Seller;

use App\Repository\V1\Seller\SellerRepository;
use App\Repository\V1\User\UserRepository;
class SellerWithProductsService
{

    protected $sellerRepository;
    protected $userRepository;

    public function __construct(
        SellerRepository $sellerRepository,
        UserRepository $userRepository
    ) {
        $this->sellerRepository = $sellerRepository;
        $this->userRepository = $userRepository;
    }

    public function sellerWithProducts(int $id)
    {
        if($this->userRepository->show($id)->user_type_id==1){
            return 'seller not found';
        }
        return $this->sellerRepository->sellerWithProducts($id);
    }
}
