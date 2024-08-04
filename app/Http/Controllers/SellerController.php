<?php

namespace App\Http\Controllers;

use App\Models\seller;
use Illuminate\Http\Request;
use DB;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sellers = seller::get();
        return view('admin.seller.index',compact('sellers'));
    }

    public function sellerStatus(Request $request){
        
        if($request->mode=="true"){
            DB::table('sellers')->where('id',$request->id)->update([
                'status'=>'active',
            ]);
        }else{
            DB::table('sellers')->where('id',$request->id)->update([
                'status'=>'inactive',
            ]); 
        }
        return response()->json(['msg'=>'successfuly updated','status'=>true]);
    }


    
    public function sellerverified(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('sellers')->where('id',$request->id)->update(['is_verified'=>'1']);
        }else{
            DB::table('sellers')->where('id',$request->id)->update(['is_verified'=>'0']);

        }

        return response()->json(['msg'=> 'successfuly updated verified','verified'=>true]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'full_name'=>'required|min:2',
            'username'=>'required|min:2',
            'email' => 'email|required|unique:sellers,email', // Replace 'your_table_name' with your actual table name
            'password'=>'required|min:2',

            'address'=>'nullable|string',
            'status'=>'required|in:active,inactive',
            'phone'=>'nullable|string',
            'photo'=>'nullable',

        ]);
        $data=$request->all();
        $new = seller::create($data);
        if($new){
            return redirect()->route('seller.index')->with('success',' seller successfully created ');

        }else{
             return back()->with('error','something went wrong!');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = seller::findOrFail($id);
        return view('admin.seller.edit',compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $seller = seller::findOrFail($id);
        if($seller){
        // $this->validate($request,[
        //     'full_name'=>'required|min:2',
        //     'username'=>'required|min:2',
        //     'email' => 'email|required|unique:sellers,email', // Replace 'your_table_name' with your actual table name
        //     'password'=>'required|min:2',

        //     'address'=>'nullable|string',
        //     'phone'=>'nullable|string',
        //     'photo'=>'nullable',

        // ]);

        $data=$request->all();
        $new = $seller->fill($data)->save();
        if($new){
            return redirect()->route('seller.index')->with('success',' seller successfully updated ');

        }else{
             return back()->with('error','something went wrong!');
        } 
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = seller::find($id);
        if($seller){
                  $status = $seller->delete();
                  if($status){
                   
                      return redirect()->route('seller.index')->with('success','seller successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
