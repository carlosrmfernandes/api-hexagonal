<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{

    protected $fillable = [
        'product_id', 'quantity','amount_total','price','status','cep','neighborhood','street','street_number','complement','consumer_id','seller_id','note','id_mch'
    ];
    protected $visible = [
        'id', 'product_id', 'quantity','amount_total', 'price','status','cep','neighborhood','street','street_number','complement','note','id_mch','consumer_id','seller_id','product','consumer','seller' 
    ];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function consumer(){
        return $this->hasOne(User::class,'id','consumer_id');
    }
    
    public function seller(){
        return $this->hasOne(User::class,'id','seller_id');
    }

}
