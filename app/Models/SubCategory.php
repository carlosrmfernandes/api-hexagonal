<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = [
        'name', 'checked','category_id'
    ];
    protected $visible = [
        'id', 'name', 'checked','category_id','category','products'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'sub_category_id','id');
    }

}
