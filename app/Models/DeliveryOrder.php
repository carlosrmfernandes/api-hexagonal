<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{

    protected $fillable = [
        'product_id', 'quantity', 'price','status','cep','city','neighborhood','street','street_number','complement','consumer_id','seller_id'
    ];
    protected $visible = [
        'id', 'product_id', 'quantity', 'price','status','cep','city','neighborhood','street','street_number','complement','consumer_id','seller_id'
    ];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

}
