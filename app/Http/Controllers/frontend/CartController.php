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
        $product_id = $request->product_id;
        $product_qty = $request->input('product_qty');
        // $productQuantity= $request->input('productQuantity'); // stock
        // return  $product_qty;
        // if($product_qty > $productQuantity){
        //     $response['message'] ="we currently do not have enough items in stock";
        //     $response['status'] = false;
        // }
        // ###################################3
        $product = Product::find($product_id);

        // التحقق من توفر الكمية في المخزون
        if ($product_qty > $product->stock - $product->reserved_stock) { // 6 10 0
            return response()->json([
                'status' => false,
                'message' => "We currently do not have enough items in stock."
            ]);
        //     $response['status'] = false;

        // $response['message'] ="we currently do not have enough items in stock";
        }

        // حجز الكمية
     $product->increment('reserved_stock', $product_qty); //6


        // ##################################33
       // dd($product_qty);
    //    $product = DB::table('products')->where('id',$product_id)->get()->toArray();//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 
        // return $product_id;

        $product = product::getProductByCart($product_id);
        // return $product['offer_price'];

        $size = $request->input('product_size');
        // $price = $request->input('offer_price');

        
    //    return $product;

        $price=$product[0]['offer_price'];
    // dd($price);    

        $cart_array=[];
        foreach(Cart::instance('shopping')->content() as $item){
            $cart_array[] = $item->id;
        }
        $result = Cart::instance('shopping') ->add($product_id,$product[0]['title'],$product_qty,$price, ['size' => $size])->associate('App\Models\product');


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
       


        $cartItem = Cart::instance('shopping')->get($rowId);

        if (!$cartItem) {
            $response['message'] = "Product not found in cart.";
            $response['status'] = false;
            return $response;
        }

        $currentQuantity = $cartItem->qty; // الكمية الحالية في العربة current value in cart


        if($request_quantity>$productQuantity){
            $response['message'] ="we currently do not have enough items in stock";
            $response['status'] = false;
        }elseif($request_quantity<1){
            $response['message'] ="you can not add less than 1 quantity";
            $response['status'] = false;
        }else{

            ////////////////////////////////
            //#############################
            // تحديث الكمية في العربة
            Cart::instance('shopping')->update($rowId, $request_quantity);

            // حساب الفرق وتحديث reserved_stock
            $quantityDifference = $request_quantity - $currentQuantity; // وليكن ضفت فيالعربه 4 وجيت عملت update يبقي requested ==5 والي في العربه 4
        
        
            $productId = $cartItem->id;
            $product = Product::find($productId);


//يعني لو بذود وليكن واحد بعمل incement اما لو بقلل يعمل decrement
            if ($product) {
                // إذا كانت الكمية الجديدة أكبر، نقوم بزيادة reserved_stock
                if ($quantityDifference > 0) {
                    $product->increment('reserved_stock', $quantityDifference);
                } 
                // إذا كانت الكمية الجديدة أقل، نقوم بتقليل reserved_stock
                else {
                    $product->decrement('reserved_stock', abs($quantityDifference));
                }
            }
    
            ////////////////////////////////
            //#############################


            // Cart::instance('shopping')->update($rowId,$request_quantity);
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
    public function cartDelete(Request $request)
    {
        $rowId = $request->input('rowId');
        $cartItem = Cart::instance('shopping')->get($rowId);
    
        if (!$cartItem) {
            // إذا لم يتم العثور على العنصر في العربة
            $response['status'] = false;
            $response['message'] = "Product not found in cart.";
            return json_encode($response);
        }
    
        $productId = $cartItem->id; // الحصول على معرف المنتج
    
        Cart::instance('shopping')->remove($rowId);
    
        $product = Product::find($productId);
    
        if ($product) {
            // زيادة الكمية المحجوزة من المخزون
            $product->decrement('reserved_stock', $cartItem->qty);
        } else {
            // إذا لم يتم العثور على المنتج في قاعدة البيانات
            $response['status'] = false;
            $response['message'] = "Product not found.";
            return json_encode($response);
        }
    
        $response['status'] = true;
        $response['message'] = "Product was deleted from cart.";
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
    
        if ($request->ajax()) {
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
                'value'=>$coupon->discount($total_price), //discount is a function in coupon model in folder Models
            ]);
            // Cart::instance('shopping')->destroy();
            // Session::forget('coupon');
            // Cart::instance('shopping')->destroy();

            return back()->with('success','Coupon Applied successfuly');
            
           }
    }
}
