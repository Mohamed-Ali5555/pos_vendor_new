<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\user;
use App\Models\ProductReview;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('5')->get();
        $promo_banners = Banner::where(['status' => 'active', 'condition' => 'promo'])->orderBy('id', 'DESC')->first();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->limit(3)->orderBy('id', 'DESC')->get();
        $new_products = Product::where(['status' => 'active', 'condition' => 'new'])->orderBy('id', 'DESC')->limit('8')->get();
        $featured_products = Product::where(['status' => 'active', 'is_featured' => 1])->orderBy('id', 'DESC')->limit('6')->get();
        $brands = Brand::where('status', 'active')->orderBy('id', 'DESC')->get();

        // $topRatedProducts = DB::table('product_reviews')->select('*',DB::raw("(select max(`rate`) from product_reviews)"))->orderBy("rate",'asc')->get();

        // $topRatedProducts = Product::select('products.*')
        // ->Join('product_reviews', 'products.id', 'product_reviews.product_id')
        // ->orderBy('product_reviews.rate', 'DESC')
        // ->distinct('products.id')
        // ->take(6)
        // ->get();


        // return $topRatedProducts;

                // $reviews = ProductReview::where('id','product_id') ->latest()
                // ->paginate(3);


           //Top rated products
    //  $item_rated=DB::table('product_reviews')->select('product_id',DB::raw('AVG(rate) as count'))->
    //  groupBy('product_id')->orderBy("count",'desc')->get();
    //  $product_ids=[];
      
    //  foreach($item_rated as $item){
    //     array_push($product_ids,$item->product_id);
    //  }
    
    //  $idoImloded = implode(',' , array_fill(0,count($product_ids),'?'));
    //  if($idoImloded !=null){
    //  $topRatedProducts=Product::whereIn('id',$product_ids)->orderByRaw("field(id,{$idoImloded})",$product_ids)->get();
    //  }else{
    //     $topRatedProducts=[];
    // }


        // return dd($topRatedProducts);

        //top rated product
        // here that i want to get high rate from product reviews get product_id 
        $item_rated = DB::table('product_reviews')->select('product_id',DB::raw('AVG(rate) as count'))->
        groupBy('product_id')->orderBy('count','desc')->get();
        
        $product_ids=[];
        // in this i make array in var product_ids and 
        // get item_rated id === to products_ids store in this store in array called products_id
        foreach($item_rated as $item){
            array_push($product_ids,$item->product_id);
        }

        $idoImloded = implode(',',array_fill(0,count($product_ids),'?'));
        // this i think == products_ids ->count() how many but in array 
        //you can make $product_ids !=null its ok 
        if($idoImloded!=null){
            $best_rated = Product::whereIn('id',$product_ids)->orderByRaw("field(id,{$idoImloded})",$product_ids)->get();
        }else{
            $best_rated=[];
        }

        // top sellers
        $items  = DB::table('product_orders')->select('product_id',DB::raw('COUNT(product_id) as count'))->groupBy('product_id')
        ->orderBy('count','desc')->get();

        $product_ids=[];
        foreach($items as $item){
            array_push($product_ids,$item->product_id);

        }

        $idoImloded_selling = implode(',',array_fill(0,count($product_ids),'?'));

        if($idoImloded_selling!=null){
            $best_sellings = Product::whereIn('id',$product_ids)->orderByRaw("field(id,{$idoImloded_selling})",$product_ids)->get();
        }else{
            $best_sellings=[];
        }


        // $best_rated === orderByRaw(field  in here get id that in model product == $products_id such as i had 1,2,3 in product_id and are in product get those
        // and orderByRaw order as chat gpt in this  )
        //return $best_rated;
        return view('frontend.index', compact('banners', 'promo_banners', 'brands', 'new_products',
        'categories', 'featured_products','best_rated','best_sellings'));
    }

    //product detail

    public function productDetail($slug)
    {
        $product = product::with('rel_products')->where('slug', $slug)->first();
        // $product = Product::with('rel_prods')->where('slug',$slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product'));
        } else {
            return 'product detail not found';
        }
    }

    // product category
    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with(['products'])->where('slug', $slug)->first();
        //      $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->paginate(12);

        //return $request->all();
        $sort = ''; //this is a new variable
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return ('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'Asc')->paginate(12);
            } elseif ($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'Desc')->paginate(12);

            } elseif ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'Asc')->paginate(12);

            } elseif ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'Desc')->paginate(12);

            } elseif ('disAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'Asc')->paginate(12);

            } elseif ('disDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'Desc')->paginate(12);

            } else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
            }
        }
        // $route = 'product-category';
        ////////////////////////////////////////////
        // if($request->ajax()){
        //     $view = view('frontend/layouts._single-product'.compact('products'))->render();
        //     return response()->json(['html'=>$view]);
        // }
        // ///////////////////////////////////////////
        return view('frontend.pages.product.product-category', compact(['categories', 'products']));

    }
    public function aboutUs(Request $request){
      
        try{
            $brands=Brand::where('status','active')->orderBy('id','DESC')->get();

            $abouts=AboutUs::first();
            
            // return $abouts;
            if($abouts != null){
            return view('frontend.pages.about_us',compact('abouts','brands'));
            }else{
                return 'admin dont aff about information';
            }
        }catch(\Exception  $exception){
            return back()->with('error', 'page error');
        }
   
    }


    ///contact page
    public function contactUs(Request $request){

        // $abouts=AbouteUs::first();
        // return $abouts;
        return view('frontend.pages.contact_us');
    }
    public function contactSubmit(Request $request){
        $this->validate($request,[
            'f_name'=>'string|required',
            'l_name'=>'string|required',
            'email'=>'email|required',
            'message'=>'string|nullable|max:200',
            'subject'=>'min:4|string|required',

        ]);
        $data = $request->all();
        $data = Mail::to('oppnot280@gmail.com')->send(new Contact($data));
        return back()->with('success','successfuly send your enquirey');

    }
    public function shop(Request $request)
    {
        $products=Product::query();

        // $products=Product::query()->get();

        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();

            $products = $products->whereIn('cat_id', $cat_ids);
            //  dd( $cat_ids);
        }

        //SORT BY BRAND
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();

            $products = $products->whereIn('brand_id', $brand_ids);
            //  dd( $products);
        }

      

        //sort by size
        if (!empty($_GET['size'])) {
            $products = $products->where('size', $_GET['size']);
            //  dd( $products);
        }

        if (!empty($_GET['sortBy'])) {
            // $sort = $_GET['sortBy'];
            // dd($sort);

            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where('status', 'active')->orderBy('offer_price', 'Asc');

            }if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where('status', 'active')->orderBy('offer_price', 'DESC');

            }if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where('status', 'active')->orderBy('title', 'Asc');

            }if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where('status', 'active')->orderBy('title', 'Desc');

            }if ($_GET['sortBy'] == 'disAsc') {
                $products = $products->where('status', 'active')->orderBy('price', 'Asc');

            }
            if ($_GET['sortBy'] == 'disDesc') {
                $products = $products->where('status', 'active')->orderBy('price', 'Desc');
            }
        }
          //sort price or filter price
          if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            //    dd($price);

            //   $products= $products->whereBetween('offer_price',$price)->where('status','active')->paginate(12);
            //   $products=$products->whereBetween('offer_price',$price)->where('status','active')->paginate(12);
            $products = $products->whereBetween('offer_price', $price)->where('status', 'active');

            //   dd($products);
        }
   
        else {
            // $products = $products;
            $products= $products->where('status','active')->paginate(15);


        }

        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();
        $cats = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();
        // dd($data);

        // category filter
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }

        /// SORT FILTER

        $sortByUrl = '';
        if (!empty($data['sortBy'])) { /// this is the name

            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }

        // price filter
        // $price_range_url="";
        // if(!empty($data['price_range'])){
        //     $price_range_url .= '&price=' .$data['price_range'];
        // }

        $price_range_url = "";
        if (!empty($data['price_range'])) {
            $price_range_url .= '&price=' . $data['price_range'];
        }
        //    FILTER BY BRANDS

        $brandUrl = '';
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }

        //size filter
        $sizeUrl = "";
        if (!empty($data['size'])) {
            $sizeUrl .= '&size=' . $data['size'];
        }
        // return dd($sortByUrl);
        return redirect()->route('shop', $catUrl . $sortByUrl . $brandUrl . $sizeUrl . $price_range_url);

    }

    public function autoSearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = product::where('title', 'LIKE', '%' . $query . '%')->get();

        $data = array();

        // $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->title, 'id' => $product->id);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => "No Result fount", 'id' => ''];
        }

    }

    /// search function
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = product::where('title', 'LIKE', '%' . $query . '%')->orderBy('id', 'DESC')->paginate(20);

        $brands = Brand::where('status', 'active')->orderBy('title', 'DESC')->with('products')->get();
        $cats = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function userAuth()
    {
        // Session::put('user.intended',URL::previous());

        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user' . $request->email);

            // if(Session::get('url.intended')){
            //     return Redirect::to(Session::get('url.intended'));
            // }else{
            return redirect()->route('home')->with('success', 'Sucessfuly login');
            // }

        } else {
            return back()->with('error', 'Invalid email & password');
        }

    }

    public function registerSubmit(Request $request)
    {
      
        $validated = $request->validate([
            'email' => 'email|required|unique:users,email', // Replace 'your_table_name' with your actual table name
            'password' => 'required|min:4',
            'full_name' => 'string|required',
            'username' =>'string|nullable',

        ]);

        
        // return $request->all();
        $data = $request->all();
        
        // $check = $this->create($data);
        $check = user::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);

        Session::put('user', $data['email']);
        Auth::login($check);
        if ($check) {
            return redirect()->route('home')->with('success', 'Successfuly registered');
        } else {
            return back()->with('error', ['Please check your credentials']);
        }
    }

    public function userLogout()
    {
        Session::flush();  ///flush()   forget('user')
        Auth::logout();
        return \redirect()->home()->with('success', 'Successfuly logout');
    }

    public function userAccount(Request $request)
    {
        // $validated = $request->validate([
        //     'newpassword'=>'password|min:4',
        //     'oldpassword'=>'password|min:4',

        //     // 'full_name'=>'required|string',
        //     // 'username'=>'nullable|string',
        //     // 'phone'=>'nullable|min:8',

        // ]);
        $user = Auth::user();
        return view('frontend.user.account', compact('user'));
    }



    
    public function updateAccount(Request $request, $id)
    {
        // return $request->all();
        $validated = $request->validate([
            // 'newpassword'=>'password|min:4',
            // 'oldpassword'=>'password|min:4',

            'full_name'=>'required|string',
            'username'=>'nullable|string',
            'phone'=>'nullable|min:8',

        ]);

        $hashpassword = Auth::user()->password; // old password
        // return $hashpassword;
     

        if($request->oldpassword==null && $request->newpassword==null){
        User::where('id',$id)->update([
            'full_name'=>$request->full_name,
            'username'=>$request->username,
            'phone'=>$request->phone,
        ]);
        return back()->with('success','successfuly updated two');
        }else{
            // return "gggg";/
            if(\Hash::check($request->oldpassword,$hashpassword)){
                // return $request->all();
                // if(\Hash::check($request->newpassword,$request->oldpassword)){
                    User::where('id',$id)->update([
                        'full_name'=>$request->full_name, 
                        'username'=>$request->username,
                        'phone'=>$request->phone,
                        'password'=>Hash::make($request->newpassword),
                    ]);
                    return back()->with('success','Account successfuly updated');

                // }else{
                //     return back()->with('error','New password not be the same with old password');
                // }
            }else{
                return back()->with('error','New password does not match');

            }

        }
    }

    public function userDashboard(){
        $user = Auth::user();
        return view('frontend.user.dashboard',compact('user'));
    }

    public function userAddress(){
        $user = Auth::user();
        return view('frontend.user.address',compact('user'));
    }


    public function userOrder(){
        $user = Auth::user();
        return view('frontend.user.order');
    }


}
