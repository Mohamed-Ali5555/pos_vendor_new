<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session ;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.pages.cart.index');
    }

    public function cartStore(Request $request){
        // return $request->all();
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
    //    $product = DB::table('products')->where('id',$product_id)->get()->toArray();//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 

        $product = product::getProductByCart($product_id);

        $size = $request->input('product_size');
        // return $size;

        
    //    return $product;

        $price=$product[0]['offer_price'];
    // dd($price);    

        $cart_array=[];
        foreach(Cart::instance('shopping')->content() as $item){
            $cart_array[] = $item->id;
        }
        $result = Cart::instance('shopping')
        ->add($product_id,$product[0]['title'],$product_qty,$price, ['size' => $size])->associate('App\Models\product');


        if($result){
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="It was added";
    
        }
         //header refresh when you add product
         if($request->ajax()){
            $header= view('frontend.layouts.header')->render();
            $response['header'] = $header;
         }
    //   if($request->ajax()){
    //     $header=view('frontend.layouts.header')->render();
    //     $response['header']=$header;
    //   }
        return json_encode($response);
    }


    public function cartUpdate(Request $request){
        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty'); // new value
        $productQuantity= $request->input('productQuantity'); // stock

        if($request_quantity>$productQuantity){
            $response['message'] ="we currently do not have enough items in stock";
            $response['status'] = false;
        }elseif($request_quantity<1){
            $response['message'] ="you can not add less than 1 quantity";
            $response['status'] = false;
        }else{
            Cart::instance('shopping')->update($rowId,$request_quantity);
            $response['message'] ="Quantity was updated successfully";

            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();

        } 

        
        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $cart_list=view('frontend.layouts._cart-lists')->render();
    
            $response['header']=$header;
            $response['cart_list']=$cart_list;
    
            // $response['message']=$message;
            $response['cart_count']=Cart::instance('shopping')->count();

        }

        return $response;

    }
    public function cartDelete(Request $request){
        $id = $request->input('rowId');
        Cart::instance('shopping')->remove($id);

        $response['status'] = true;
        $response['message'] = "it was delete";
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();

        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);

    }


    public function couponAdd(Request $request){
        $code = $request->input('code');
        $coupon = coupon::where('code',$code)->first();
        if(!$coupon){
            return back()->with('error','Invalid coupon code , please enter valid coupon code');

        }
  
           if($coupon){
            $total_price = (float)str_replace(',','', Cart::instance('shopping')->subtotal());
            // return $total_price;
            session()->put('coupon',[
                'id'=>$request->id,
                'code'=>$request->code, // we store in session name => coupon not in table migration but in session 
                'value'=>$coupon->discount($total_price), //discount is a function in coupon model
            ]);
            // Cart::instance('shopping')->destroy();
            // Session::forget('coupon');
            // Cart::instance('shopping')->destroy();

            return back()->with('success','Coupon Applied successfuly');
            
           }
    }
}
