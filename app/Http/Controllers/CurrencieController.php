<?php

namespace App\Http\Controllers;

use App\Models\currencie;
use Illuminate\Http\Request;
use DB;
class CurrencieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencys = currencie::orderBy('id','DESC')->get();
        return view('admin.currencie.index',compact('currencys'));
    }



    public function currencyStatus(Request $request){
        if($request->mode=='true'){
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'active']);

        }else{
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'inactive']);

        }
        return response()->json(['msg'=>'successfuly updated status' , 'status'=>true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencie.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(  $request,[
            'name'=>'string|required',
            'symbol'=>'string|required',
            'exchange_rate'=>'numeric|required',
            'code'=>'string|required',

            'status'=>'nullable|in:active,inactive',

        ]);
        $data=$request->all();
        $new=Currencie::create($data);

   
        if($new){
            return redirect()->route('currencie.index')->with('success','currency successfuly created');
        }else{
            return back()->with('error','something went wrong!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function show(currencie $currencie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $currency = Currencie::find($id);
        if($currency){
            return view('admin.currencie.edit',compact('currency'));
        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency = Currencie::find($id);
        if($currency){


            $this->validate(  $request,[
                'name'=>'string|required',
                'symbol'=>'string|required',
                'exchange_rate'=>'numeric|required',
                'code'=>'string|required',
    
                'status'=>'nullable|in:active,inactive',
    
            ]);
    $data = $request->all();
    $new = $currency->fill($data)->save();
    if($new){
        return redirect()->route('currencie.index')->with('success','successfully updated currency');

    }else{
         return back()->with('error','something went wrong!');
    }



        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function destroy(currencie $currencie)
    {
         
        $currency = Currencie::find($id);
        if($currency){
                  $status = $currency->delete();
                  if($status){
                      return redirect()->route('currencie.index')->with('success','currency successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
