<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    use HasFactory;
    protected $table = "aboutus";

    protected $fillable=['heading','content','image','experience','happy_customer','team_advisor','return_customer'];
}
