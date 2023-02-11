<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;   
     protected $guarded =[]; 

   /**
         * The products that belong to the Order
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function products(): BelongsToMany
        {
            return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
        } 
     

}
