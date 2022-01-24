<?php

namespace App\Repository\V1\Admin;

use App\Models\User;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function save(array $attributes): object
    {
        
    }

    public function update(int $id, array $attributes): object
    {
        
    }    

    public function show(int $id): object
    {
        
    }
    
    public function isActiveSeller(int $sellerId, $attributes): object
    {
       DB::beginTransaction();
        try {
            
            $seller = $this->obj->find($sellerId);
            if ($seller) {
                $seller = $seller->update([
                    'is_active' => $attributes['is_active'],
                ]);
            }       
            DB::commit();            
            return  $this->obj->find($sellerId)->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        } 
    }

}
