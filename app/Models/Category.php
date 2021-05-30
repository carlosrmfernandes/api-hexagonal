<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name','background_color','sub_title','image','checked'
    ];
    protected $visible = [
        'id','name','background_color','sub_title','image','checked','subCategory','users'
    ];

    public function subCategory(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function users(){
        return $this->hasMany(User::class,'category_id','id',);
    }
}
