<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'description', 'image', 'price','available','user_id','sub_category_id','image'
    ];
    protected $visible = [
        'id', 'name', 'description', 'image', 'price','available','user_id','user_id','sub_category_id','subCategory','image','user'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function subCategory(){
        return $this->hasOne(SubCategory::class,'id','sub_category_id');
    }
}
