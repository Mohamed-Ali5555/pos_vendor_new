<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttribute;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductController extends Controller
{



    
        public function index(){
            
            $products = Product::where(['added_by'=>'seller','user_id'=>auth('seller')->user()->id])->orderBy('id','desc')->get();
            return view('seller.product.index',compact('products'));
    }
    
    
    public function productStatus(Request $request){
        if($request->mode=='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
    
        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
    
        }
        return response()->json(['msg'=>'successfuly updated status' , 'status'=>true]);
    }
    
    public function create()
    {
    if(auth('seller')->user()->is_verified){
    
        return view('seller.product.create');
    
      }else{
        return back()->with('error','you need to verified your account');
      }
        
    }


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
            $slug =$slug.'-'.Str::random(4);        }
        $data['slug']=$slug;
        $data['added_by']='seller';
        $data['user_id']=auth('seller')->user()->id;


        $data['offer_price']=($request->price-(($request->price*$request->discount)/100)); 

      //  return $data;

        $new = Product::create($data);
        if($new){
            return redirect()->route('seller-product.index')->with('success',' product successfully created ');

        }else{
            return back()->with('error','something went wrong!');
        }
    }

    
    public function show( $id)
    {
        $products = Product::find($id);
        $productAttr=ProductAttribute::where('product_id',$id)->orderBy('id','DESC')->get();
    
        if($products){
            return view('seller.product.product-attribute',compact('products','productAttr'));
        }else{
            return back()->with('error','Data not found !');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $product = Product::find($id);
    
        if($product){
            return view('seller.product.edit',compact('product'));
        }else{
            return back()->with('error','Data not found !');
        }
    }
    
    
    
    
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
    
            $data['offer_price']=($request->price-(($request->price*$request->discount)/100)); 
    
            // return $data;
    
            $new = $product->fill($data)->save();
    
            if($new){
                return redirect()->route('seller-product.index')->with('success',' product successfully updated ');
    
            }else{
                return back()->with('error','something went wrong!');
            }
    }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $product = Product::find($id);
        if($product){
                  $status = $product->delete();
                  if($status){
                   
                      return redirect()->route('seller.product.index')->with('success','product successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }    }
    
    
    public function addProductAttribute(Request $request,$id){
        try{
            $data = $request->all();
            foreach($data['original_price'] as $key=>$val){
                if(!empty($val)){
                    $attribute = new ProductAttribute([
                        'original_price' =>$val,
                        'size'=>$data['size'][$key],
                        'product_id'=>$id,
                        'stock'=>$data['stock'][$key],
                        'offer_price'=>$data['size'][$key],
                    ]);
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success','product attribute added success');
    
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Failed to add product attributes');
    
        }
        // $data = $request->all();
        // foreach($data['original_price'] as $key=>$val){
        //     if(!empty($val)){
        //         $attribute=new ProductAttribute;
        //         $attribute['size'] = $data['size'][$key];
    
    
        //     }
        // }
    }
    
    
        public function attributeDelete( $id)
        {
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
    
