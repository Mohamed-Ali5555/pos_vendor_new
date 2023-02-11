<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\user;
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

        return view('frontend.index', compact('banners', 'promo_banners', 'brands', 'new_products', 'categories', 'featured_products'));
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

    public function shop(Request $request)
    {
        // $products=Product::all();

        $products = Product::query();

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

        //sort price or filter price
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            //    dd($price);

            //   $products= $products->whereBetween('offer_price',$price)->where('status','active')->paginate(12);
            //   $products=$products->whereBetween('offer_price',$price)->where('status','active')->paginate(12);
            $products = $products->whereBetween('offer_price', $price)->where('status', 'active')->paginate(12);

            //   dd($products);
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
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'Asc')->paginate(12);

            }if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'Desc')->paginate(12);

            }if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'Asc')->paginate(12);

            }if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'Desc')->paginate(12);

            }if ($_GET['sortBy'] == 'disAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'Asc')->paginate(12);

            }
            if ($_GET['sortBy'] == 'disDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'Desc')->paginate(12);
            }

            //  dd(($_GET['sortBy']));

        } else {
            $products = $products->where('status', 'active');

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

        $data = array();
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
        Session::forget('user');
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
