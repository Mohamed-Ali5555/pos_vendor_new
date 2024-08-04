<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session ;
use App\Models\Shipping;
use App\Models\product;

use App\Models\Order;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkout1(){
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('user'));

    }

    // CHECKOUT1 ==> get user information
    // CHECKOUT2 ==> get user shipping method or check the shipping method
    // CHECKOUT3 ==> get user payment_methode 
    // checkout4 ==> check the order and store in model order  
    // public function checkout1Store(Request $request){
    //     // Define validation rules
    //     $rules = [
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'required|string|max:20',
    //         'country' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'postcode' => 'required|string|max:20',
    //         'note' => 'nullable|string',
    
    //         'sfirst_name' => 'required|string|max:255',
    //         'slast_name' => 'required|string|max:255',
    //         'semail' => 'required|email|max:255',
    //         'sphone' => 'required|string|max:20',
    //         'scountry' => 'required|string|max:255',
    //         'saddress' => 'required|string|max:255',
    //         'scity' => 'required|string|max:255',
    //         'sstate' => 'required|string|max:255',
    //         'spostcode' => 'required|string|max:20',
    
    //         'sub_total' => 'required|numeric',
    //         'total_amount' => 'required|numeric',
    //     ];
    
    //     // Validate the request data
    //     $validatedData = $request->validate($rules);
    
    //     // Store validated data in session
    //     Session::put('checkout', $validatedData);
    
    //     // Retrieve active shipping options
    //     $shippings = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();
    
    //     // Return the view with shipping options
    //     return view('frontend.pages.checkout.checkout2', compact('shippings'));
    // }
    
    public function checkout1Store(Request $request){
        // return $request->all();
       
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'note' => 'nullable|string',
    
            'sfirst_name' => 'required|string|max:255',
            'slast_name' => 'required|string|max:255',
            'semail' => 'required|email|max:255',
            'sphone' => 'required|string|max:20',
            'scountry' => 'required|string|max:255',
            'saddress' => 'required|string|max:255',
            'scity' => 'required|string|max:255',
            'sstate' => 'required|string|max:255',
            'spostcode' => 'required|string|max:20',
    
            'sub_total' => 'required|numeric',
            'total_amount' => 'required|numeric',
        ]);

        // first store it in session
        Session::put('checkout',[
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'note'=>$request->note,

            'sfirst_name'=>$request->sfirst_name,
            'slast_name'=>$request->slast_name,
            'semail'=>$request->semail,
            'sphone'=>$request->sphone,
            'scountry'=>$request->scountry,
            'saddress'=>$request->saddress,
            'scity'=>$request->scity,
            'sstate'=>$request->sstate,
            'spostcode'=>$request->spostcode,

            // store also sub total and total that in hidden button
            'sub_total'=>$request->sub_total,   
            'total_amount'=>$request->total_amount,

        ]);
        $shippings = Shipping::where('status','active')->orderBy('shipping_address','ASC')->get();
        return view ('frontend.pages.checkout.checkout2',compact('shippings'));
    }

    public function checkout2Store(Request $request){
        $request->validate([
            'delivery_charge' => 'required', // Ensure a shipping method is selected
        ], [
            'delivery_charge.required' => 'Please select a shipping method.', // Custom error message
        ]);
        Session::push('checkout',[
            'delivery_charge' =>$request->delivery_charge,
        ]);
        return view('frontend.pages.checkout.checkout3');
    }


    public function checkout3Store(Request $request){
        Session::push('checkout',[
            'payment_method' =>$request->payment_method,
            'payment_status'=>'unpaid',
        ]);
        return view('frontend.pages.checkout.checkout4');
    }

    public function checkoutStore()
    {

        DB::beginTransaction();

        try {
        // $x =Session::get('checkout');
        // return $x;
        $order = new order;
        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD'.Str::random(3, '0123456789'));
        $order['sub_total'] = (float)str_replace(',','',\Illuminate\Support\Facades\Session::get('checkout')['sub_total']);
      
      // get the coupon fron session that you are store on it and above you , you can get subtotal fron checkout and session that you have stored at it
        if(Session::has('coupon')){
            $order['coupon'] = Session::get('coupon')['value'];
        }else{
            $order['coupon'] = 0;
        }

        
    
        #######################################
        $order['total_amount']=(float)str_replace(',','',Session::get('checkout')['sub_total'])+Session::get('checkout')[0]['delivery_charge']-$order['coupon'];


     

        // $order['payment_method'] = Session::get('checkout')['1']['payment_method'];
        // $order['payment_status'] = Session::get('checkout')['1']['payment_status'];

        $order['condition'] = 'pending';

        $order['delivery_charge'] = Session::get('checkout')['0']['delivery_charge'];

        $order['first_name'] = Session::get('checkout')['first_name'];
        $order['last_name']=Session::get('checkout')['last_name'];
        $order['email']=Session::get('checkout')['email'];
        $order['phone']=Session::get('checkout')['phone'];
        $order['country']=Session::get('checkout')['country'];
        $order['address']=Session::get('checkout')['address'];
        $order['city']=Session::get('checkout')['city'];
        $order['state']=Session::get('checkout')['state'];
        $order['note']=Session::get('checkout')['note'];


        
        $order['sfirst_name']=Session::get('checkout')['sfirst_name'];
        $order['slast_name']=Session::get('checkout')['slast_name'];
        $order['semail']=Session::get('checkout')['semail'];
        $order['sphone']=Session::get('checkout')['sphone'];
        $order['scountry']=Session::get('checkout')['scountry'];
        $order['saddress']=Session::get('checkout')['saddress'];
        $order['scity']=Session::get('checkout')['scity'];
        $order['sstate']=Session::get('checkout')['sstate'];
        $order['spostcode']=Session::get('checkout')['spostcode'];

        // return $order;
        $status = $order->save();

        // foreach(Cart::instance('shopping')->content() as $item){
        //     $product_id[] =  $item->id;

        //     $product = product::find($item->id);
        //     $quantity = $item->qty;
        //     $order = products()->attach($product,['quantity'=> $quantity]);
        // }

        // دلوقتي انا بعد ما حفظت الاوردر لازم اكريت ملف product_order  بس لو تلاحظ مينفعشي اكريته الي بعد السيف عشان فيه order_id 
        //طيب انا هكريته بناءا علي ايه هو ممكن يتكريت من الاوردر ذات نفسه بس الاوردر مفيهوش product_id  ف اجيبها من cart 
      
    //   $x = Cart::instance('shopping')->content();
    //   return $x;
      
        // return $order;
        foreach(Cart::instance('shopping')->content() as $item){
            $product = Product::find($item->id);
            $quantity = $item->qty;

            if ($product->stock < $quantity) {
                DB::rollBack();
                return redirect()->route('checkout1')->with('error', 'Not enough stock for ' . $product->title);
            }

            $order->products()->attach($product, ['quantity' => $quantity]);
            $product->decrement('stock', $quantity);
             //decrement make reserved_stock == 0 that has value you added in func add-to-cart
            $product->decrement('reserved_stock', $quantity); //==0

        }

        DB::commit();





            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('complete',$order['order_number']);  // we make route on web because your redirect ->route
          } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('checkout1')->with('error', 'please try again');
    }

    }

    public function complete($order){
        return view('frontend.pages.checkout.complete',compact('order'));

    }
}
