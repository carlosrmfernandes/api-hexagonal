<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleTrait
 *
 * @author carlosfernandes
 */

namespace App\Service\V1\DeliveryOrder\Traits;
trait RuleTrait
{

    public function rules($id = null)
    {
        return [
            'status' => 'required|boolean|max:1',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'delivery_address' => 'required|string|max:255',
        ];
    }
}