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
        'id', 'name', 'checked','category_id','category'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

}
