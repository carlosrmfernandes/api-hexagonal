<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'cep','state','neighborhood','street','street_number','complement'
    ];
    protected $visible = [
        'id','cep','state','neighborhood','street','street_number','complement'
    ];

}
           