<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class category extends Model
{
    use HasFactory;


protected $fillable=['title','slug','summary','photo','is_parent','parent_id','status'];



// public static function shiftChild($cat_id){
//     return Category::whereIn('id',$cat_id)->update(['is_parent' =>1]);

// }

        public function products(){
            return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
        }

        public function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id'); //show title and id only to send in ajax code

        }
}
