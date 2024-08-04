@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-responsive" id="cart_list">
                            @include('frontend.layouts._cart-lists')

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form">
                            <form action="{{ route('coupon.add') }}" id="coupon-form" method="post">
                                @csrf
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Enter Your Coupon Code">
                                <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td id="subtotal">${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</td>
                                    </tr>

                                    <tr>
                                        <td>Save Amount </td>
                                        <td>$
                                            @if (\Illuminate\Support\Facades\Session::has('coupon'))
                                                {{ number_format(\Illuminate\Support\Facades\Session::get('coupon')['value']) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr id="subtotalall">
                                        <td>Total</td>
                                        @if (\Illuminate\Support\Facades\Session::has('coupon'))
                                            <td>$
                                                {{ number_format((float) str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal()) - \Illuminate\Support\Facades\Session::get('coupon')['value'], 2) }}
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- @if (session('user')) --}}
                        <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                        {{-- @endif --}}
                        {{-- <a href="{{route('checkout1')}}" class="btn btn-primary d-block">Proceed To Checkout</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>





    {{-- <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('#code').val();
            alert(code);
            $('.coupon-btn').html(' <i class ="fas fa-spinner fa-spin" > </i> Applying....');
            $('#coupon-form').submit();
        });
    </script> --}}

    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('#code').val();
            //alert(code);
            $('.coupon-btn').html(' <i class ="fas fa-spinner fa-spin" > </i> Applying....');
            $('#coupon-form').submit();
        })
    </script>







@endsection
