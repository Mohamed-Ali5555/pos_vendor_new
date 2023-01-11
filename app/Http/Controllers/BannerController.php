<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Banners = Banner::orderBy('id','DESC')->get();
        return view('admin.banner.index',compact('Banners')); 
    }


    public function bannerStatus(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);

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
        return view('admin.banner.create');
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
                'title' => 'string|required',
                'slug' =>'string|nullable|exists:banners,slug',
                'description' => 'string|nullable',
                'photo' => 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive',
            
    
        
            ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if($slug_count>0){
            $slug =time(). '-' .$slug;
        }
        $data['slug']=$slug;
            $new = Banner::create($data);
            if($new){
                return redirect()->route('banner.index')->with('success','successfully created banner');
    
            }else{
                 return back()->with('error','something went wrong!');
            }
            // return $request->all(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $banner = Banner::find($id);
        if($banner){
            return view('admin.banner.edit',compact('banner'));
        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $banner = Banner::find($id);
        if($banner){


      // return $request;
      $validated = $request->validate([
        'title' => 'string|required',
        'slug' =>'string|nullable|exists:banners,slug',

        'description' => 'string|nullable',
        'photo' => 'required',
        'condition' => 'nullable|in:banner,promo',
        'status' => 'nullable|in:active,inactive',
    


    ]);
    $data = $request->all();
    $new = $banner->fill($data)->save();
    if($new){
        return redirect()->route('banner.index')->with('success','successfully updated banner');

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
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if($banner){
                  $status = $banner->delete();
                  if($status){
                      return redirect()->route('banner.index')->with('success','Banner successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
