<?php

namespace Infrastructure\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'active'
    ];
    protected $visible = [
        'id','name', 'address', 'active'
    ];
}
