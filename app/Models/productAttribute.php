<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productAttribute extends Model
{
    use HasFactory;   
     protected $fillable=['size','product_id','original_price','offer_price','stock'];

}
