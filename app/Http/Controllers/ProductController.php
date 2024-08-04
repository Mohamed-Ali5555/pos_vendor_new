<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\ProductAttribute;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();
        return view('admin.product.index',compact(('products'))); 
    }
    public function productStatus(Request $request){
        if($request->mode=='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);

        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);

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
        return view('admin.product.create');

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
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'additional_info'=>'string|nullable',
            'return_cancellation'=>'string|nullable',
            'stock'=>'nullable|numeric',
            'price'=>'nullable|numeric',
            'discount'=>'nullable|numeric',
            'photo'=>'required',
            'size_guide'=>'nullable',
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'size'=>'nullable',
            'condition'=>'nullable',
            'status'=>'nullable|in:active,inactive',

        ]);
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug',$slug)->count();
        if($slug_count>0){
            $slug =$slug.'-'.Str::random(4);
        }
        $data['slug']=$slug;


      //  return $data;
      //// calculate offer price 
       $data['reserved_stock'] =0;
       $data['offer_price'] = ($request->price - (($request->price*$request->discount)/100));
      $new = product::create($data);

      if($new){
        return redirect()->route('product.index')->with('success',' product successfully created ');

        }else{
            return back()->with('error','something went wrong!');
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $products = Product::find($id);
        $productAttr=ProductAttribute::where('product_id',$id)->orderBy('id','DESC')->get();

        if($products){
            return view('admin.product.product_attribute',compact('products','productAttr'));
        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $product = Product::find($id);

        if($product){
            return view('admin.product.edit',compact('product'));
        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $product = Product::find($id);
        if($product){


            $validated = $request->validate([
                'title'=>'string|required',
                'summary'=>'string|required',
                'description'=>'string|nullable',
                'additional_info'=>'string|nullable',
                'return_cancellation'=>'string|nullable',
                'stock'=>'nullable|numeric',
                'price'=>'nullable|numeric',
                'discount'=>'nullable|numeric',
                'photo'=>'required',
                'size_guide'=>'nullable',
                'cat_id'=>'required|exists:categories,id',
                'child_cat_id'=>'nullable|exists:categories,id',
                'size'=>'nullable',
                'condition'=>'nullable',
                'status'=>'nullable|in:active,inactive',

            ]);
            $data = $request->all();
            $data['reserved_stock'] =0;
            $data['offer_price']=($request->price-(($request->price*$request->discount)/100)); 

            // return $data;

            $new = $product->fill($data)->save();

            if($new){
                return redirect()->route('product.index')->with('success',' product successfully updated ');

            }else{
                return back()->with('error','something went wrong!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product = Product::find($id);
        if($product){
                  $status = $product->delete();
                  if($status){
                   
                      return redirect()->route('product.index')->with('success','product successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }


    public function addProductAttribute(Request $request,$id){

        
        // $validated = $request->validate([
         
        //     'original_price'=>'required|numeric',
        //     'offer_price'=>'required|numeric',
        //     'size_guide'=>'nullable',
        //     'product_id'=>'required|exists:products,id',
        //     'size'=>'required',


        // ]);
        // $data=$request->all();
        // return $request->all();
        $original_price = $request->original_price;
        $offer_price = $request->offer_price;
        $stock = $request->stock;
        $product_id = $request->product_id;
        $size = $request->size;
        
        for($i=0; $i < count($original_price);$i++){
            $datasave = [
                'original_price'  =>$original_price[$i],
                'offer_price'  =>$offer_price[$i],
                'product_id'  =>$id,
                'stock'  =>$stock[$i],
                'size'  =>$size[$i],
            ];
            $datasave1=ProductAttribute::create($datasave);
        }
                return redirect()->back()->with('success','product attribute successfuly add');

        // foreach($data['original_price'] as $key=>$val){
        //     if(!empty($val)){
        //         $attribute=new ProductAttribute;
        //         $attribute['original_price']=$val;
        //         $attribute['offer_price']=$data['offer_price'][$key];
        //         $attribute['stock']=$data['stock'][$key];
        //         $attribute['product_id']=$id;
        //         $attribute['size']=$data['size'][$key];
        //         $attribute->save();
        //     }
        // }
        // return redirect()->back()->with('success','product attribute successfuly add');
    }



    
    public function attributeDelete($id)
    {
        // dd($id);
        $productAttr = ProductAttribute::find($id);
        if($productAttr){
                  $status = $productAttr->delete();
                  if($status){
                   
                      return redirect()->back()->with('success','product Attribute successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }    }
}

