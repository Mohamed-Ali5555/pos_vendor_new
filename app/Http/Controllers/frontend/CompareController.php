<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    
    public function compare(){
        return view('frontend.pages.compare');
    }

    public function compareStore(Request $request){
        $product_id = $request->input('product_id');
        $product=Product::getProductByCart($product_id);
        //    dd ($product);
        $price = $product[0]['offer_price'];

        $compare_array =[];

        

        foreach(Cart::instance('compare')->content() as $item){
            $compare_array[] = $item->id;
        }

        if(in_array($product_id,$compare_array)){
            $response['percent'] = true;
            $response['message']="Item is aleady in your compare";
        }elseif (count($compare_array) >5){
            $response['status']=false;
            $response['message']="we dont have enough items";
        }elseif($product[0]['stock']<=0){
            $response['status']=false;
            $response['message']="we dont have enough items";
        }else{
                 
        $result=Cart::instance('compare')->add($product_id,$product[0]['title'],1,$price)->associate('App\Models\Product');
        // $result = Cart::instance('compare')->add($product_id,$product[0]['title'],$price)->associate('App\Models\Product');
        if($result){
            $response['status']=true;
            // $response['product_id']=$product_id;
            // $response['total']=Cart::subtotal();
            $response['compare_count']=Cart::instance('compare')->count();
            $response['message']="It was add to compare poage";

        }
        }
        return json_encode($response);
    }



    public function moveToCart(Request $request){
        $item = Cart::instance('compare')->get($request->input('rowId'));

        cart::instance('compare')->remove($request->input('rowId'));
        $result = cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            $response['status'] = true;
            $response['message'] = "item has moved to wishlist";
        }
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

    public function moveToWishlist(Request $request){
        // get product that in compare 
       $item = Cart::instance('compare')->get($request->input('rowId'));
        // \ then delete it from compare
        Cart::instance('compare')->remove($request->input('rowId'));
        /// then add product to wishlist 

        $result = Cart::instance('wishlist')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            $response['status'] = true;
            $response['message'] = "item has moved to wishlist";
        }
        if($request->ajax()){
            $wishlist = view('frontend.layouts._wishlist')->render();
            $compare = view('frontend.layouts._compare')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['compare_list'] = $compare;

            $response['header'] = $header; 
        }
        return $response;
    }

    
    public function compareDelete(Request $request){
        // $id=$request->input('rowId');
        Cart::instance('compare')->remove($request->id);


        $response['status']=true;
        $response['message']="item has removed from compare";
        $response['cart_count']=Cart::instance('shopping')->count();


        if($request->ajax()){
            $wishlist=view('frontend.layouts._wishlist')->render();
            $compare=view('frontend.layouts._compare')->render();

            $header=view('frontend.layouts.header')->render();

            $response['wishlist_list']=$wishlist;
            $response['compare_list']=$compare;

            $response['header']=$header;
            $wishlist=view('frontend.layouts.header')->render();
          
          }
          
          return $response;
    }
}
