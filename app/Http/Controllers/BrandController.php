<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Brands = Brand::orderBy('id','DESC')->get();
        return view('admin.brand.index',compact('Brands')); 
    }


    public function brandStatus(Request $request){
      if($request->mode="true"){
        DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
      }else{
        DB::table('brands'->where('id',$request->id)->update(['status'=>'inactive']));
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
        return view('admin.brand.create');

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
            'title'=>'nullable|string',
            'photo'=>'required',
            'status'=>'nullable|in:active,inactive',

        ]);
        $data=$request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $new=Brand::create($data);
        if($new){
            return redirect()->route('brand.index')->with('success','Brand successfuly created');
        }else{
            return back()->with('error','something went wrong!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

        $brand = Brand::find($id);
        if($brand){
            return view('admin.brand.edit',compact('brand'));
        }else{
            return back()->with('error','Data not found !');

        }

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $brand = Brand::find($id);
        if($brand){

            $this->validate(  $request,[
                'title'=>'nullable|string',
                'photo'=>'required',
                'status'=>'nullable|in:active,inactive',
    
            ]);

    $data = $request->all();
    $new = $brand->fill($data)->save();
    if($new){
        return redirect()->route('brand.index')->with('success','successfully updated brand');

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
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $brand = Brand::find($id);
        if($brand){
                  $status = $brand->delete();
                  if($status){
                      return redirect()->route('brand.index')->with('success','Brand successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
