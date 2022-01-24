<?php

namespace App\Service\V1\Admin;

use App\Repository\V1\Admin\AdminRepository;
use App\Repository\V1\User\UserRepository;
use App\Jobs\JobIsActiveUser;

class AdminService {

    protected $adminRepository;
    protected $userRepository;

    public function __construct(AdminRepository $adminRepository, UserRepository $userRepository
    ) {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
    }

    public function isActiveSeller($sellerId, $attributes) {
        if (!get_object_vars(($this->userRepository->show($sellerId)))) {
            return "seller_id invalid";
        }
        
        $seller = $this->adminRepository->isActiveSeller($sellerId, $attributes);
                
        if ($seller) {            
            JobIsActiveUser::dispatch($seller, $attributes['is_active'])
                    ->delay(now()
                            ->addSecond('15'));

            return $seller ? "Success, an email has been sent to the seller" : 'unidentified user';
        }
        
        return 'unidentified user';
    }

}
