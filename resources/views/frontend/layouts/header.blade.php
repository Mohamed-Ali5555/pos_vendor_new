<!-- Header Area -->
<header class="header_area">
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="welcome-note">
                        <span class="popover--text" data-toggle="popover"
                            data-content="Welcome to Bigshop ecommerce template."><i
                                class="icofont-info-square"></i></span>
                     <span class="text">Welcome to {{\App\Models\Setting::value('title')}}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    English
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">Bangla</a>
                                    <a class="dropdown-item" href="#">Arabic</a>
                                </div>
                            </div>
                        </div>

                        <!-- Currency Dropdown -->
                        <div class="currency-dropdown">
                            <div class="dropdown">

                                @php
                                    Helper::currency_load();
                                    $currency_code = session('currency_code');
                                    $currency_symbol = session('currency_symbol');

                                    if ($currency_symbol == '') {
                                        $system_default_currency_info = session('system_default_currency_info');
                                        $currency_symbol = $system_default_currency_info->symbol;
                                        $currency_code = $system_default_currency_info->code;
                                    }

                                @endphp




                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $currency_symbol }} {{ $currency_code }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">

                                    @foreach (\App\Models\currencie::where('status', 'active')->get() as $currency)
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="currency_change('{{ $currency['code'] }}')">{{ $currency->symbol }}
                                            {{ \Illuminate\Support\Str::upper($currency->code) }}</a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="bigshop-main-menu">
        <div class="container">
            <div class="classy-nav-container breakpoint-off">
                <nav class="classy-navbar" id="bigshopNav">

                    <!-- Nav Brand -->
                    <a href="{{route('home')}}" class="nav-brand">
                    
                    <img src="{{asset(get_setting('logo'))}}" alt="logo"></a>

                    <!-- Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Close -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a>

                                </li>
                                </li>
                                <li><a href="{{ route('about_us') }}">About Us</a>

                                </li>
                                <li><a href="{{ route('shop') }}">Shop</a>

                                </li>
                            
                              
                                
                                <li><a href="{{ route('contact_us') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Hero Meta -->
                    <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                        <!-- Search -->
                        <div class="search-area">
                            <div class="search-btn"><i class="icofont-search"></i></div>
                            <!-- Form -->
                            <form action="{{ route('search') }}" method="GET">
                                <div class="search-form">
                                    <input type="search" id="search-text" name="query" class="form-control"
                                        placeholder="Search">
                                    <button type="submit" class="btn btn-primary"
                                        style="float: right;margin: -50px -129px 0px 0px;">Search</button>
                                </div>

                            </form>
                        </div>

                        <!-- Wishlist -->
                        <div class="wishlist-area">
                            <a href="{{ route('wishlist') }}" class="wishlist-btn" id="wishlist_counter"><i
                                    class="icofont-heart"></i>
                                {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() }}

                            </a>
                        </div>
                        {{-- 
                        <!-- Wishlist -->
                        <div class="wishlist-area">
                            <div class="wishlist--btn"><a href="{{ route('wishlist') }}"> <i
                                        class="icofont-heart"></i></a> <span class="cart_quantity"
                                    id="wishlist_counter">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() }}</span>
                            </div>
                        </div> --}}

                        <!-- compare -->
                        <div class="cart-area">
                            <div class="cart--btn"><a href="{{ route('compare') }}"> <i
                                        class="icofont-exchange"></i></a> <span class="cart_quantity"
                                    id="compare_counter">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count() }}</span>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="cart-area">
                            <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity">
                                    {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}

                                </span>
                            </div>

                            <!-- Cart Dropdown Content -->
                            <div class="cart-dropdown-content">
                                <ul class="cart-list">
                                    @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                        <li>
                                            <div class="cart-item-desc">
                                                <a href="#" class="image">
                                                @if(auth()->user())
                                                    <img src="{{auth()->user()->photo}}" class="cart-thumb"
                                                        alt="">
                                                        @else 
                                                        <img src="{{Helper::useDefaultImage()}}" alt=""/>
                                                        @endif
                                                </a>
                                                <div>
                                                    <a
                                                        href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a>
                                                    <p>{{ $item->qty }} x - <span
                                                            class="price">${{ number_format($item->price, 2) }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <span class="dropdown-product-remove cart_delete_dropdown"
                                                data-id="{{ $item->rowId }}"><i class="icofont-bin"></i></span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="cart-pricing my-4">
                                    <ul>
                                        <li>
                                            <span>Sub Total:</span>
                                            <span>${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</span>

                                        </li>

                                        <li>
                                            <span>Total:</span>
                                            <span>${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="cart-box">
                                    <a href="{{ route('cart') }}" class="btn btn-success btn-sm">cart</a>

                                    <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Checkout</a>
                                </div>
                            </div>
                        </div>

                        <!-- Account -->
                        <div class="account-area">
                            <div class="user-thumbnail">
                                <img src="img/bg-img/user.jpg" alt="">
                            </div>
                            <ul class="user-meta-dropdown">
                                @auth


                                    <li class="user-title"><span>Hello,</span> {{ auth()->user()->full_name }}</li>
                                    <li><a href="{{ route('user.account') }}">My Account</a></li>
                                    <li><a href="order-list.html">Orders List</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="{{ route('user.logout') }}"><i class="icofont-logout"></i> Logout</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('user.auth') }}">Login & Register</a></li>

                                @endauth

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->
{{-- @section('scripts') --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

{{-- /// DELETE PRODUCT CART FROM DROPDOWN LIST --}}

{{-- /// DELETE PRODUCT CART FROM DROPDOWN LIST --}}




{{-- @endsection --}}
