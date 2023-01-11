<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist(){
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        // dd($product_id);
        $product = product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $wishlist_array=[];

        foreach(Cart::instance('wishlist')->content() as $item){
            $wishlist_array[] = $item->id;
        }


        //////// this code if you add the same product to wishlist pages
        if(in_array($product_id,$wishlist_array)){  /// if product id === or where in wishlist_array in this group
            $response['percent']=true;
            $response['message']="Item is aleady in your wishlist";

        }else{
        $result = Cart::instance('wishlist')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('\App\Models\Product');
  

        if($result){
            $response['status'] = true;
            $response['wishlist_count'] = Cart::instance('wishlist')->count();
            $response['message'] = "it was added to wishlist";
        }
    }
        return json_encode($response);
  
    }





    public function moveToCart(Request $request){
        // $product_id = $request->input('product_id');
        //    dd($product_id);

        // this -> item is in wishlist and not get it  from request only but from wishlist  and remove it 
        $item=Cart::instance('wishlist')->get($request->input('product_id'));

        Cart::instance('wishlist')->remove($request->input('product_id'));

        $result=Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');

        if($result){
        $response['status']=true;
        $response['message']="item has moved to cart";
        $response['cart_count']=Cart::instance('shopping')->count();
        }
        if($request->ajax()){
        $wishlist=view('frontend.layouts._wishlist')->render();
        $response['wishlist_list']=$wishlist;

        $header=view('frontend.layouts.header')->render();
        $response['header']=$header;
        }

        return $response;
    }
    public function wishlistDelete(Request $request){
        $id = $request->input('rowId');
        Cart::instance('wishlist')->remove($request->input('rowId'));

        $response['status'] = true;
        $response['message'] = "it was deleted";
        $response['cart_count'] = Cart::instance('shopping')->count();
 
        if($request->ajax()){
            $wishlist = view('frontend.layouts._wishlist')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;

            $wishlist=view('frontend.layouts.header')->render();
        }
        return $response;
    }
}
