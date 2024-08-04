<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = category::orderBy('id','DESC')->get();
        return view('admin.category.index',compact(('categorys')));
    }

    

    public function categoryStatus(Request $request){
        if($request->mode=='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
        }

        return response()->json(['msg'=>'successfully updated status','status'=>true]);
    }


    public function create()
    {
        // $parent_cats = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        // check if   category == parent or not or get category is parent

        $parent_cats = category::where('is_parent',1)->orderBy('title','ASC')->get();

        return view('admin.category.create',compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' =>'string|required',
            'summary' => 'string|nullable',
            'photo' => 'required',
            'is_parent' => 'sometimes|in:1',
            'parent_id' =>'nullable',
            'status' => 'nullable|in:active,inactive',

        ]);

       $data = $request->all();

       $slug = Str::slug($request->input('title'));
       $slug_count = category::where('slug',$slug)->count();
       if($slug_count >0){
        $slug =time(). '-' .$slug;
       }

       $data['slug'] = $slug;
       $data['is_parent'] = $request->input('is_parent',0);
    //    $data['parent_id'] = $request->input('parent_id','');




       $new = category::create($data);

       if($new){
        return redirect()->route('category.index')->with('success','category has been created');
       }else{
        return back()->with('error','something went error');
       }

    //    return $request->all();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parent_cats = Category::where('is_parent',1)->orderBy('title','ASC')->get();

        if($category){
            return view('admin.category.edit',compact(['category','parent_cats']));
        }else{
            return back()->with('error','Data not found !');
    }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {     
        
        $category = Category::find($id);

        $validated = $request->validate([
            'title' =>'string|required',
            'summary' => 'string|nullable',
            'photo' => 'required',
            'is_parent' => 'sometimes|in:1',
            'parent_id' =>'nullable',
            'status' => 'nullable|in:active,inactive',

        ]);

       $data = $request->all();

       if($request->is_parent==1){
        $data['parent_id']= '';
        }  

       

       $data['is_parent'] = $request->input('is_parent',0);
    //    $data['parent_id'] = $request->input('parent_id','');


       $new = $category->fill($data)->save();

       if($new){
        return redirect()->route('category.index')->with('success','category has been updated');
       }else{
        return back()->with('error','something went error');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        //if you want to delete parent you should delete child
        $category = category::where('id',$id);
        $child_cat_id = Category::where('parent_id',$id);  // parent id == child 
if($category){

    $status2 = $child_cat_id->delete();

    $status = $category->delete();
    return redirect()->route('category.index')->with('success','category successfuly deleted');

}else
{
    return back()->with('error','Data not found !');
}



// $category = Category::find($id);
// $child_cat_id = Category::where('parent_id',$id)->pluck('id');  // parent id == child 
// if($category){
//           $status = $category->delete();
//           if($status){
//               if(count($child_cat_id)>0){
//                   Category::shiftChild($child_cat_id);
//               }
//               return redirect()->route('category.index')->with('success','category successfuly deleted');
//           }else{
//               return back()->with('error','something went wrong');
//           }
// }else{
//     return back()->with('error','Data not found !');
// }
    }
    // public function getChildByParent(Request $request,$id){

    //     // return $request->all();
    //     $category = Category::find($request->id);

    //     $child_id = DB::table('categories')->where('parent_id',$id)->pluck('title','id');//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 

        // $child_id = Category::getChildByParentID($request->id);

        // return $child_id;
  
    //      if($category){
    //       if(count($child_id)<=0){  // < = 0 because  chid_id or parent_id not equal 1 but its child to parent
    //           return response()->json(['status'=>false,'data'=>null,'msg'=>'']);
    //       }
    //       return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
    
    //      }else{
    //       return response()->json(['status'=>false,'data'=>null,'msg'=>'category not found']);
  
    //      }
    //   }


      public function getChildByParent(Request $request,$id){
        $category = Category::find($request->id);

        $child_id = DB::table('categories')->where('parent_id',$id)->pluck('title','id');

        if($category){
            if(count($child_id)<=0){  //<=0
                return response()->json(['status'=>false,'data'=>null,'msg'=>'']);
            }
            return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
        }else{
            return response()->json(['status'=>false,'data'=>null,'msg'=>'category not found']);
        }

      }
}
