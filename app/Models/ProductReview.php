<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id','rate','review','reason','status'];

    public function products(){
        return $this->hasMany('App\Models\ProductReview','product_id','id');
    }
}
