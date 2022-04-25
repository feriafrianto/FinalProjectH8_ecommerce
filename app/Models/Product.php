<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status','price','weight','image','sub_category_id'];
    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory','sub_category_id');
    }
}
