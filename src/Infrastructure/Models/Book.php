<?php

namespace Infrastructure\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'isbn', 'value'
    ];
    protected $visible = [
        'id','name', 'isbn', 'value'
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
