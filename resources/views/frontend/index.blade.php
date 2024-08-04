@extends('frontend.layouts.master')


@section('content')
    {{-- @if (count($banners) > 0) --}}
    <!-- Welcome Slides Area -->
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">

            @foreach ($banners as $banner)
                <!-- Single Slide -->
                <div class="single_slide bg-img" style="background-image: url({{ $banner->photo }});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="welcome_slide_text">
                                    <p class="text-white" data-animation="fadeInUp" data-delay="0">100% Cotton</p>
                                    <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">
                                        {{ $banner->title }}ffffffffff</h2>
                                    <h4 class="text-white" data-animation="fadeInUp" data-delay="600ms">
                                        {!! html_entity_decode($banner->description) !!}</h4>
                                    <a href="{{ $banner->slug }}" class="btn btn-primary" data-animation="fadeInUp"
                                        data-delay="900ms">Shop Nowgggg</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Welcome Slides Area -->
    {{-- @endif --}}

    @if (count($categories) > 0)
        <!-- Top Catagory Area -->
        <div class="top_catagory_area mt-50 clearfix">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <!-- Single Catagory -->
                        <div class="col-12 col-md-4">
                            <div class="single_catagory_area mt-50">
                                <a href="#">
                                    <img src="{{ $category->photo }}" alt="{{ $category->title }}"hhhh>
                                    <div class="single_cata_desc d-flex align-items-center justify-content-center">
                                        <div class="single_cata_desc_text">
                                            <h5>{{ ucfirst($category->title) }}</h5>
                                            <a href="{{ route('product.category', $category->slug) }}">Shop Now
                                                <i class="icofont-rounded-double-right"></i></a>
                                        </div>
                                    </div>



                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <!-- Top Catagory Area -->
    @endif









    @if (count($new_products) > 0)
        <!-- New Arrivals Area -->
        <section class="new_arrivals_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading new_arrivals">
                            <h5>New Arrivals</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($new_products as $nproduct)
                        <!-- Single Product -->
                        <div class="col-9 col-sm-6 col-md-4 col-lg-4">

                            @include('frontend.layouts._single-product', ['product' => $nproduct])

                            {{-- /// nproduct == product =>any product in this page --}}

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- New Arrivals Area -->
    @endif







    <!-- Featured Products Area -->
    <section class="featured_product_area">
        <div class="container">
            <div class="row">
                <!-- Featured Offer Area -->

                <div class="col-12 col-lg-6">
                    {{-- @foreach ($promo_banners as $promo_banner) --}}

                    {{-- @php
                                $photo = explode(',', $promo_banner->photo);
                            @endphp --}}

                    @if ($promo_banners != null)
                        <div class="featured_offer_area d-flex align-items-center"
                            style="background-image: url({{ asset($promo_banners->photo) }});">
                            <div class="featured_offer_text">

                                <h2>{!! html_entity_decode($promo_banners->description) !!}</h2>
                                <h4>{{ $promo_banners->title }}</h4>
                                <a href="{{ $promo_banners->slug }}" class="btn btn-primary btn-sm mt-3">Shop Now1</a>
                            </div>
                        </div>
                    @else
                        <div>you shoud add photo on by change condition to promo</div>
                    @endif
                    {{-- @endforeach --}}
                </div>



                <!-- Featured Product Area -->
                <div class="col-12 col-lg-6">
                    <div class="section_heading featured">
                        <h5>Featured Products</h5>
                    </div>

                    <!-- Featured Product Slides -->
                    <div class="featured_product_slides owl-carousel">
                        <!-- Single Product -->
                        @foreach ($featured_products as $product)
                            {{-- @include('frontend.layouts._single-product', ['product' => $fproduct]) --}}



                            <div class="single-product-area mb-30">
                                <div class="product_image">
                                    @php
                                        $photo = explode(',', $product->photo);
                                    @endphp
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{ asset($photo[0]) }}" alt="">

                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{ $product->condition }}</span>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="product_wishlist">
                                        <a href="javascript:void(0);" class="add_to_wishlist_before_click_view"
                                            data-quantity="1" data-id="{{ $product->id }}"
                                            id="add_to_wishlist_before_click_view_{{ $product->id }}"><i
                                                class="icofont-heart"></i></a>
                                    </div>

                                    <!-- Compare -->
                                    <div class="product_compare">
                                        <a href="javascript:void(0);" class="add_to_compare" data-id="{{ $product->id }}"
                                            id="add_to_compare_{{ $product->id }}"><i class="icofont-exchange"></i></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a href="javascript:void(0);
                                        "
                                            data-quantity="1" data-price="{{ $product->offer_price }}"
                                            data-product-id="{{ $product->id }}" class="add_to_cart"
                                            id="add_to_cart{{ $product->id }}"><i class="icofont-shopping-cart"></i>
                                            Add to Cart</a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="#" data-toggle="modal"
                                            data-target="#quickview{{ $product->id }}"><i class="icofont-eye-alt"></i>
                                            Quick View</a>
                                    </div>

                                    <p class="brand_name">
                                        {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
                                    {{-- <a
                                        href="{{ route('product.detail', $product->slug) }}">{{ ucfirst($product->title) }}</a>
                                    <h6 class="product-price">{{ Helper::currency_converter($product->offer_price) }}
                                        <small><del
                                                class="text-danger">{{ Helper::currency_converter($product->price) }}</del></small>
                                    </h6> --}}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- Featured Products Area -->



















    <!-- Best Rated/Onsale/Top Sale Product Area -->
    <section class="best_rated_onsale_top_sellares section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#top-sellers" class="nav-link" data-toggle="tab" role="tab">Top Selling
                                    Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="#best-rated" class="nav-link active" data-toggle="tab" role="tab">Best
                                    Rated</a>
                            </li>

                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="top-sellers">
                                <div class="top_sellers_area">
                                    <div class="row">
                                        @foreach ($best_sellings as $best_selling)
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                        @php 
                                                            $photo = explode(',',$best_selling->photo);
                                                        @endphp
                                                        <img src="{{ asset($photo[0]) }}" alt="Top-Sellers">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ ucfirst($best_selling->title) }}</h5>
                                                        <h6>{{ Helper::currency_converter($best_selling->offer_price) }} <span>
                                                                {{ Helper::currency_converter($best_selling->price) }}</span></h6>

                                                        @php
                                                            $reviews = \App\Models\ProductReview::where('product_id', $best_selling->id)
                                                                ->latest()
                                                                ->paginate(3);
                                                        @endphp

                                                        @foreach ($reviews as $review)
                                                            <div class="top_seller_product_rating">
                                                                @for ($i = 0; $i <5; $i++)
                                                                    @if ($review->rate > $i)
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="far fa-star" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        @endforeach
                                                        <!-- Info -->
                                                        <div
                                                            class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="javascript:void(0);" data-toggle="tooltip"
                                                                    data-placement="top" class="add_to_cart"
                                                                    data-product-id = "{{ $best_selling->id }}"
                                                                    data-quantity = "1"
                                                                    data-price = "{{ $best_selling->offer_price }}"
                                                                    id="add_to_cart{{ $best_selling->id }}"
                                                                    title="Add To Cart"><i
                                                                        class="icofont-shopping-cart"></i></a>
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:void(0);" data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    class="add_to_wishlist_before_click_view"
                                                                    data-id = "{{ $best_selling->id }}" data-quantity = "1"
                                                                    id="add_to_wishlist_before_click_view_{{ $best_selling->id }}"
                                                                    title="Wishlist"><i class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            <div class="ts_product_compare">
                                                                <a href="javascript:void(0);" data-toggle="tooltip"
                                                                    data-placement="top" class="add_to_compare"
                                                                    data-id = "{{ $best_selling->id }}" data-quantity = "1"
                                                                    id="add_to_compare_{{ $best_selling->id }}"
                                                                    title="Compare"><i class="icofont-exchange"></i></a>
                                                            </div>

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#quickview{{$best_selling->id}}"><i
                                                                        class="icofont-eye-alt"></i></a>
                                                            </div>


                                                                        <!-- Quick View Modal Area -->
                                                            <div class="modal fade" id="quickview{{ $best_selling->id }}"
                                                                tabindex="-1" role="dialog" aria-labelledby="quickview"
                                                                aria-hidden="true" data-backdrop="false"
                                                                style="background:rgba(0,0,0,.5);z-index:99999999999999;">
                                                                <div class="modal-dialog modal-lg modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close btn"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <div class="modal-body">
                                                                            <div class="quickview_body">
                                                                                <div class="container">
                                                                                    <div class="row">

                                                                                        <div class="col-12 col-lg-5">
                                                                                            <div class="quickview_pro_img">
                                                                                                @php
                                                                                                    $photo = explode(',', $best_selling->photo);
                                                                                                @endphp
                                                                                                <!-- Product Image -->
                                                                                                <img class="first_img"
                                                                                                    src="{{ asset($photo[0]) }}"
                                                                                                    alt="">
                                                                                                <!-- Product Badge -->
                                                                                                <div class="product_badge">
                                                                                                    <span
                                                                                                        class="badge-new">{{ $best_selling->condition }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-lg-7">
                                                                                            <div class="quickview_pro_des">
                                                                                                <h4 class="title">
                                                                                                    {{ ucfirst($best_selling->title) }}
                                                                                                </h4>
                                                                                                @php  
                                                                                                $reviews = \App\Models\ProductReview::where('product_id',$best_selling->id)->latest() ->paginate(3);
                                                                                                @endphp
                                                                                                @foreach ($reviews as $review )
                                                                                                    
                                                                                               
                                                                                                <div
                                                                                                    class="top_seller_product_rating mb-15">
                                                                                                    @for($i=0;$i<5;$i++)
                                                                                                    @if($review->rate > $i)
                                                                                                     <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    @else
                                                                                                     <i class="far fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    @endif 
                                                                                                    @endfor

                                                                                                </div>

                                                                                                 @endforeach
                                                                                                <h5 class="price">
                                                                                                    {{ Helper::currency_converter($best_selling->offer_price) }}
                                                                                                    <span>{{ Helper::currency_converter($best_selling->price) }}</span>
                                                                                                </h5>
                                                                                                <p>{!! html_entity_decode($best_selling->summary) !!}
                                                                                                </p>
                                                                                                <a
                                                                                                    href="{{ route('product.detail', $best_selling->slug) }}">View
                                                                                                    Full Product Details</a>
                                                                                            </div>
                                                                                            <!-- Add to Cart Form -->
                                                                                            <div class="cart"
                                                                                                method="post">
                                                                                                <div class="quantity">

                                                                                                    <input type="number"
                                                                                                        class="qty-text22"
                                                                                                        data-id="{{ $best_selling->id }}"
                                                                                                        step="1"
                                                                                                        min="1"
                                                                                                        max="99"
                                                                                                        name="quantity"
                                                                                                        value="1">






                                                                                                </div>
                                                                                                <button type="submit"
                                                                                                    name="addtocart"
                                                                                                    value="5"
                                                                                                    class="cart-submit add_to_cart"
                                                                                                    data-quantity="1"
                                                                                                    {{-- data-price="{{ $best_selling->offer_price }}" --}}
                                                                                                    data-product_id="{{ $best_selling->id }}"
                                                                                                    id="add_to_cart_{{ $best_selling->id }}">Add
                                                                                                    to
                                                                                                    cart</button>
                                                                                                <!-- Wishlist -->
                                                                                                <div
                                                                                                    class="modal_pro_wishlist  ">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="add_to_wishlist_click_view_modal"
                                                                                                        data-quantity="1"
                                                                                                        data-id="{{ $best_selling->id }}"
                                                                                                        id="add_to_wishlist_click_view_modal_{{ $best_selling->id }}"><i
                                                                                                            class="icofont-heart"></i></a>

                                                                                                </div>
                                                                                                <!-- Compare -->
                                                                                                <div
                                                                                                    class="modal_pro_compare">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="add_to_compare"
                                                                                                        data-id="{{ $best_selling->id }}"
                                                                                                        id="add_to_compare_{{ $best_selling->id }}"><i
                                                                                                            class="icofont-exchange"></i></a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Share -->
                                                                                            <div class="share_wf mt-30">
                                                                                                <p>Share with friends</p>
                                                                                                <div class="_icon">
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-facebook"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-twitter"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-pinterest"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-linkedin"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-instagram"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-envelope-o"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Quick View Modal Area -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade show active" id="best-rated">
                                <div class="best_rated_area">
                                    <div class="row">
                                        @foreach ($best_rated as $best)
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                        <img src="{{ $best->photo }}" alt="Top-Sellers">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ ucfirst($best->title) }}</h5>
                                                        <h6>{{ Helper::currency_converter($best->offer_price) }}
                                                            <span>{{ Helper::currency_converter($best->price) }}</span>
                                                        </h6>
                                                        @php
                                                            $reviews = \App\Models\ProductReview::where('product_id', $best->id)
                                                                ->latest()
                                                                ->paginate(3);
                                                        @endphp
                                                        @foreach ($reviews as $review)
                                                            <div class="top_seller_product_rating">

                                                                @for ($i = 0; $i < 5; $i++)
                                                                    @if ($review->rate > $i)
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="far fa-star" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor

                                                            </div>
                                                        @endforeach



                                                        <!-- Info -->
                                                        <div
                                                            class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="javascript:void;" data-toggle="tooltip"
                                                                    class="add_to_cart" data-quantity="1"
                                                                    data-price="{{ $best->offer_price }}"
                                                                    data-product-id = "{{ $best->id }}"
                                                                    id="add_to_cart{{ $best->id }}"
                                                                    data-placement="top" title="Add To Cart"><i
                                                                        class="icofont-shopping-cart"></i></a>
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:void;" data-toggle="tooltip"
                                                                    class="add_to_wishlist_before_click_view"
                                                                    data-quantity="1" data-id="{{ $best->id }}"
                                                                    id="add_to_wishlist_before_click_view_{{ $best->id }}"
                                                                    data-placement="top" title="Wishlist"><i
                                                                        class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            <div class="ts_product_compare">
                                                                <a href="javascript:void;" data-toggle="tooltip"
                                                                    class="add_to_compare" data-quantity="1"
                                                                    data-id="{{ $best->id }}"
                                                                    id="add_to_compare_{{ $best->id }}"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="icofont-exchange"></i></a>
                                                            </div>

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#quickview{{ $best->id }}"><i
                                                                        class="icofont-eye-alt"></i></a>
                                                            </div>


                                                            <!-- Quick View Modal Area -->
                                                            <div class="modal fade" id="quickview{{ $best->id }}"
                                                                tabindex="-1" role="dialog" aria-labelledby="quickview"
                                                                aria-hidden="true" data-backdrop="false"
                                                                style="background:rgba(0,0,0,.5);z-index:99999999999999;">
                                                                <div class="modal-dialog modal-lg modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close btn"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <div class="modal-body">
                                                                            <div class="quickview_body">
                                                                                <div class="container">
                                                                                    <div class="row">

                                                                                        <div class="col-12 col-lg-5">
                                                                                            <div class="quickview_pro_img">
                                                                                                @php
                                                                                                    $photo = explode(',', $best->photo);
                                                                                                @endphp

                                                                                                <!-- Product Image -->
                                                                                                <img class="first_img"
                                                                                                    src="{{ asset($photo[0]) }}"
                                                                                                    alt="">
                                                                                                <!-- Product Badge -->
                                                                                                <div class="product_badge">
                                                                                                    <span
                                                                                                        class="badge-new">{{ $best->condition }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-lg-7">
                                                                                            <div class="quickview_pro_des">
                                                                                                <h4 class="title">
                                                                                                    {{ ucfirst($best->title) }}
                                                                                                </h4>
                                                                                                <div
                                                                                                    class="top_seller_product_rating mb-15">
                                                                                                    <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                    <i class="fa fa-star"
                                                                                                        aria-hidden="true"></i>
                                                                                                </div>
                                                                                                <h5 class="price">
                                                                                                    {{ Helper::currency_converter($best->offer_price) }}
                                                                                                    <span>{{ Helper::currency_converter($best->price) }}</span>
                                                                                                </h5>
                                                                                                <p>{!! html_entity_decode($best->summary) !!}
                                                                                                </p>
                                                                                                <a
                                                                                                    href="{{ route('product.detail', $best->slug) }}">View
                                                                                                    Full Product Details</a>
                                                                                            </div>
                                                                                            <!-- Add to Cart Form -->
                                                                                            <div class="cart"
                                                                                                method="post">
                                                                                                <div class="quantity">

                                                                                                    <input type="number"
                                                                                                        class="qty-text22"
                                                                                                        data-id="{{ $best->id }}"
                                                                                                        step="1"
                                                                                                        min="1"
                                                                                                        max="99"
                                                                                                        name="quantity"
                                                                                                        value="1">






                                                                                                </div>
                                                                                                <button type="submit"
                                                                                                    name="addtocart"
                                                                                                    value="5"
                                                                                                    class="cart-submit add_to_cart"
                                                                                                    data-quantity="1"
                                                                                                    data-price="{{ $best->offer_price }}"
                                                                                                    data-product_id="{{ $best->id }}"
                                                                                                    id="add_to_cart{{ $best->id }}">Add
                                                                                                    to
                                                                                                    cart</button>
                                                                                                <!-- Wishlist -->
                                                                                                <div
                                                                                                    class="modal_pro_wishlist  ">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="add_to_wishlist_click_view_modal"
                                                                                                        data-quantity="1"
                                                                                                        data-id="{{ $best->id }}"
                                                                                                        id="add_to_wishlist_click_view_modal_{{ $best->id }}"><i
                                                                                                            class="icofont-heart"></i></a>

                                                                                                </div>
                                                                                                <!-- Compare -->


                                                                                                <div
                                                                                                    class="modal_pro_compare">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="add_to_compare"
                                                                                                        data-id="{{ $best->id }}"
                                                                                                        id="add_to_compare_{{ $best->id }}"><i
                                                                                                            class="icofont-exchange"></i></a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Share -->
                                                                                            <div class="share_wf mt-30">
                                                                                                <p>Share with friends</p>
                                                                                                <div class="_icon">
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-facebook"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-twitter"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-pinterest"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-linkedin"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-instagram"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-envelope-o"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Quick View Modal Area -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Rated/Onsale/Top Sale Product Area -->

    <!-- Offer Area -->
    <section class="offer_area">
        <div class="container">
            <div class="row">
                <!-- Beach Offer -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="beach_offer_area mb-4 mb-md-0">
                        <img src="frontend/img/product-img/beach.png" alt="beach-offer">
                        <div class="beach_offer_info">
                            <p>Upto 70% OFF</p>
                            <h3>Beach Item</h3>
                            <a href="#" class="btn btn-primary btn-sm mt-15">SHOP NOW</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Apparels Offer -->
                    <div class="apparels_offer_area">
                        <img src="frontend/img/product-img/apparels.jpg" alt="Beach-Offer">
                        <div class="apparels_offer_info d-flex align-items-center">
                            <div class="apparels-offer-content">
                                <h4>Apparel &amp; <br><span>Garments</span></h4>
                                <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Deals of the Week -->
                    <div class="weekly_deals_area mt-30">
                        <img src="frontend/img/product-img/weekly-offer.jpg" alt="weekly-deals">
                        <div class="weekly_deals_info">
                            <h4>Deals of the Week</h4>
                            <div class="deals_timer">
                                <ul data-countdown="2021/02/14 14:21:38">
                                    <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss -->
                                    <li><span class="days">00</span>days</li>
                                    <li><span class="hours">00</span>hours</li>
                                    <li class="d-block blank-timer"></li>
                                    <li><span class="minutes">00</span>min</li>
                                    <li><span class="seconds">00</span>sec</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Elect Offer -->
                            <div class="elect_offer_area mt-30 mt-lg-0">
                                <img src="frontend/img/product-img/elect.jpg" alt="Elect-Offer">
                                <div class="elect_offer_info d-flex align-items-center">
                                    <div class="elect-offer-content">
                                        <h4>Electronics</h4>
                                        <a href="#" class="btn">Buy Now <i
                                                class="icofont-rounded-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Backpack Offer -->
                            <div class="backpack_offer_area mt-30">
                                <img src="frontend/img/product-img/backpack.jpg" alt="Backpack-Offer">
                                <div class="backpack_offer_info">
                                    <h4>Backpacks</h4>
                                    <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Area End -->

    <!-- Popular Brands Area -->
    @if (count($brands) > 0)
        <section class="popular_brands_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="popular_section_heading mb-50">
                            <h5>Popular Brands</h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="popular_brands_slide owl-carousel">
                            @foreach ($brands as $brand)
                                <div class="single_brands">
                                    <img src="{{ asset($brand->photo) }}" alt="{{ $brand->title }}">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Popular Brands Area -->

    <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-ship"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- ///////  add to cart //// --}}
    <script>
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');
            var product_price = $(this).data('price');
            {{-- alert (product_id); --}}

            var token = "{{ csrf_token() }}";
            {{-- var path=; --}}



            $.ajax({
                {{-- url: "{{ route('cart.store') }}", --}}
                type: "POST",
                dataType: "json",

                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    product_price: product_price,
                    _token: token,
                    _method: "POST",
                },




                beforeSend: function() {
                    $('#add_to_cart' + product_id).html(
                        '<i class="fa fa-spinner fa-spin"></i>  loading...');
                },
                complete: function() {
                    $('#add_to_cart' + product_id).html(
                        '<i class="fa fa-cart-plus"></i>  Add to cart...');

                },
                success: function(data) {
                    console.log(data);
                    ///////////this make refresh when you add product
                    $('body #header-ajax').html(data['header']);
                    ////////////////
                    if (data['status']) {
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    }
                    {{-- if (data.status) {
                        alert('yyyyyyyyy');
                    } else {
                        alert('please try again !');
                    } --}}

                }


            });
        });
    </script>



    {{-- ///////  add to wishlist //// --}}
    <script>
        $(document).on('click', '.add_to_wishlist', function(e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var product_qty = $(this).data('quantity');
            {{-- alert (product_qty); --}}

            var token = "{{ csrf_token() }}";
            {{-- var path=; --}}



            $.ajax({
                {{-- url: "{{ route('wishlist.store') }}", --}}
                type: "POST",
                dataType: "json",

                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                    _method: "POST",
                },




                beforeSend: function() {
                    $('#add_to_wishlist_' + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    $('#add_to_wishlist_' + product_id).html(
                        '<i class="fa fa-heart"></i>  Add to wishlist...');

                },
                success: function(data) {
                    console.log(data);





                    ////////////////

                    if (data['status']) {
                        ///////////this make refresh when you add product
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);

                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "Aww yiss!",
                        });

                    } else if (data['percent']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning",
                            button: "ok!",
                        });
                    } else {
                        swal({
                            title: "Sorry!",
                            text: 'Sorry you can not add more product',
                            icon: "error",
                            button: "Aww yiss!",
                        });
                    }

                }


            });
        });
    </script>
@endsection
