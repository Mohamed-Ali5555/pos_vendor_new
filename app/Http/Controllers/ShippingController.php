<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use DB;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::orderBy('id','DESC')->get();
        return view('admin.shipping.index',compact(('shippings')));
    }


    public function shippingStatus(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'inactive']);

        }

        return response()->json(['msg'=> 'successfuly updated status','status'=>true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // return $request;
            $validated = $request->validate([
                'shipping_address' => 'string|required',
                'delivery_time' => 'string|nullable',
                'delivery_charge' => 'numeric|nullable',
                'status' => 'nullable|in:active,inactive',
            
    
        
            ]);
            $data = $request->all();
       
    
            $new = Shipping::create($data);
            if($new){
                return redirect()->route('shipping.index')->with('success','successfully created Shipping');
    
            }else{
                 return back()->with('error','something went wrong!');
            }
            // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::find($id);
        if($shipping){
            return view('admin.shipping.edit',compact('shipping'));
        }else{
            return back()->with('error','Data not found !');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $shipping = Shipping::find($id);
        if($shipping){


      // return $request;
      $validated = $request->validate([
        'shipping_address' => 'string|required',
        'delivery_time' => 'string|nullable',
        'delivery_charge' => 'numeric|nullable',
        

    ]);
    $data = $request->all();
    $new = $shipping->fill($data)->save();
    if($new){
        return redirect()->route('shipping.index')->with('success','successfully updated shipping');

    }else{
         return back()->with('error','something went wrong!');
    }



        }else{
            return back()->with('error','Data not found !');
        }//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       
        $shipping = Shipping::find($id);
        if($shipping){
                  $status = $shipping->delete();
                  if($status){
                      return redirect()->route('shipping.index')->with('success','shipping successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
