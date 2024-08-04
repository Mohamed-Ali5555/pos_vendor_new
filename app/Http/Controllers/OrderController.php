<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->get();
        return view('admin.order.index',compact('orders')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if($order){
           return view('admin.order.show',compact('order')); 
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order){
            $order = $order->delete();
            return back()->with('success','deleted successfuly');
        }else{
            return back()->with('error','somthing went wrong!');
        }
    }
    public function orderStatus(Request $request){
        // $order_id = $request->order_id;
        // $order = Order::findOrFail($order_id);
        // $update = $order->update([
        //     'condition' => $request->condition
        // ]);
        

        $order = Order::where('id',$request->input('order_id'))->first();
        if($order){
            if($request->input('condition')=='delivered'){
                foreach($order->products as $item){

                    $product = product::where('id',$item->pivot->product_id)->first();
                    // update stock with decrement
                    $product->decrement('stock',$item->pivot->quantity);
                    order::where('id',$request->input('order_id'))->update([
                        'payment_status'=>'paid',
                    ]);
                }
                
            }
                $status = order::where('id',$request->input('order_id'))->update([
                    'condition'=>$request->input('condition')
                ]);
                if($status){
                    return back()->with('success','order status has been updated');
                }else{
                    return back()->with('error','Something went wrong');

                }
           
        }
        abort(404);
    }
}
