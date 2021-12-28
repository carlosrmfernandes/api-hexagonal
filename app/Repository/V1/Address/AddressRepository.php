<?php

namespace App\Repository\V1\Address;

use App\Models\Address;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class AddressRepository extends BaseRepository
{

    public function __construct(Address $address)
    {
        parent::__construct($address);
    }
    
    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $address = $this->obj->create($attributes);
            DB::commit();
            return $address;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $address = $this->obj->find($id);
            if ($address) {
                $address = $address->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return (object) $address;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }
        
}
