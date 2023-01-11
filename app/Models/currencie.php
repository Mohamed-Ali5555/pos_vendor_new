<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currencie extends Model
{
    use HasFactory;

    protected $fillable=['name','symbol','exchange_rate','code','status'];

}
