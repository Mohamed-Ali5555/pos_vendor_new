@extends('frontend.layouts.master')


@section('content')
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                            quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium
                                            eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1"
                                                min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                            cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
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

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $categories->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>

                        {{-- <form action="#" method="post"> --}}
                        {{-- @csrf --}}
                        <select id="sortBy" name="sortBy" onchange="this.form.submit();" class="small right">
                            <option selected>Default Sort</option>
                            <option value="priceAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif>Price - Lower To
                                Higher</option>
                            <option value="priceDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif>Price - Higher To
                                Lower</option>
                            <option value="titleAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif>Alphabetical
                                Ascending</option>
                            <option value="titleDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif>Alphabetical
                                Descending</option>
                            <option value="disAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'disAsc') selected @endif>Discount - Lower To
                                Higher</option>
                            <option value="disDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'disDesc') selected @endif>Discount - Higher To
                                Lower</option>
                        </select>
                        {{-- </form>   / --}}
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center" id="product-data">
                            <!-- Single Product -->
                            @foreach ($products as $productcategory)
                                <div class="col-9 col-sm-6 col-md-4 col-lg-4">

                                    @include('frontend/layouts/_single-product', [
                                        'product' => $productcategory,
                                    ])
                                </div>
                            @endforeach





















                        </div>
                    </div>

                    <div class="ajax-load text-center" style="display:none;">
                        {{-- <img src="{{frontend/img/loader.gif=>your image}}"> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            {{-- alert(sort); --}}
            window.location = "{{ $categories->slug }}?sort=" + sort;
            //route that route in indexcontroller-->productCategory ==>function  and categories slug that related to category products 
            // explane = = producteds that relation ship to categories and value of sort that you choose it valllllll.
        })
    </script>





        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

       {{-- /////////// add to wishlst //////////// --}}
       <script>
           $(document).on('click', '.add_to_wishlist_before_click_view', function(e) {
               e.preventDefault(e);

               var product_id = $(this).data('id');
               var product_qty = $(this).data('quantity');
               var token = "{{ csrf_token() }}";

               $.ajax({
                   url: "{{ route('wishlist.store') }}",
                   type: "post",
                   dataType: "json",

                   data: {
                       product_id: product_id,
                       product_qty: product_qty,
                       _token: token,
                       _method: "post",
                   },
                   beforeSend: function() {
                       $('add_to_wishlist_before_click_view_' + product_id).html(
                           '<i class="fa fa-spinner fa-spin">loading...</i>');
                   },
                   complete: function() {
                       $('add_to_wishlist_before_click_view_' + product_id).html(
                           '<i class="fa fa-spinner fa-spin">Add to cart...</i>');
                   },
                   success: function(data) {
                       console.log(data);

                       if (data['status']) {

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
               })
           });
       </script>
       {{-- /////////// add to wishlst //////////// --}}

       {{-- ////  add to cart before modeal --}}
       <script>
           $(document).on('click', '.add_to_cart', function(e) {
               e.preventDefault();
               var product_id = $(this).data('product-id');
               var product_qty = $(this).data('quantity');

               {{-- alert(product_id); --}}

               var token = "{{ csrf_token() }}";

               $.ajax({
                   url: "{{ route('cart.store') }}",
                   type: "POST",
                   dataType: "json",

                   data: {
                       product_id: product_id,
                       product_qty: product_qty,
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
                       {{-- $('body #header-ajax').html(data['header']); --}}
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
                   }
               });
           });
       </script>

       {{-- ////  add to cart before modeal --}}


       {{-- //  change quantity and get new value  --}}
       <script>
           $('.qty-text22').change('key up', function() {
               var id = $(this).data('id');

               var spinner = $(this),
                   input = spinner.closest('div.quantity').find('input[type="number"]');
               var newVal = parseFloat(input.val());

               $('#add_to_cart22_' + id).attr('data-quantity', newVal);

               {{-- alert(newVal); --}}
           })
       </script>
       {{-- //  change quantity and get new value  --}}


       <script>
           $(document).on('click', '.add_to_cart22', function() {
               var product_id = $(this).data('product_id');
               var product_qty = $(this).data('quantity');

               var token = "{{ csrf_token() }}";
               $.ajax({
                   url: "{{ route('cart.store') }}",
                   type: "POST",
                   dataType: "json",
                   data: {
                       product_id: product_id,
                       product_qty: product_qty,
                       _token: token,
                       _method: "POST",
                   },


                   beforeSend: function() {
                       $('#add_to_cart22_' + product_id).html(
                           '<i class="fa fa-spinner fa-spin"></i>  loading...');
                   },
                   complete: function() {
                       $('#add_to_cart22_' + product_id).html(
                           '<i class="fa fa-cart-plus"></i>  Add to cart...');

                   },
                   success: function(data) {
                       console.log(data);
                       $('body #header-ajax').html(data['header']);
                       if (data['status']) {
                           swal({
                               title: "Good job!",
                               text: data['message'],
                               icon: "success",
                               button: "Aww yiss!",
                           });
                       }
                   }
               })

           })
       </script>
       {{-- ///////  add to wishlist //// --}}
       <script>
           $(document).on('click', '.add_to_wishlist_click_view_modal', function(e) {
               e.preventDefault();
               var product_id = $(this).data('id');
               var product_qty = $(this).data('quantity');
               {{-- alert (product_qty); --}}

               var token = "{{ csrf_token() }}";
               {{-- var path=; --}}



               $.ajax({
                   url: "{{ route('wishlist.store') }}",
                   type: "POST",
                   dataType: "json",

                   data: {
                       product_id: product_id,
                       product_qty: product_qty,
                       _token: token,
                       _method: "POST",
                   },




                   beforeSend: function() {
                       $('#add_to_wishlist_click_view_modal_' + product_id).html(
                           '<i class="fa fa-spinner fa-spin"></i>');
                   },
                   complete: function() {
                       $('#add_to_wishlist_click_view_modal_' + product_id).html(
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
       {{-- end add to witshlist --}}

       {{-- /// move to compare page///// --}}

       <script>
           $(document).on('click', '.add_to_compare', function(e) {
               e.preventDefault();

               var product_id = $(this).data('id');
               {{-- alert(product_id); --}}
               var token = "{{ csrf_token() }}";

               $.ajax({
                   url: "{{ route('compare.store') }}",
                   type: "post",
                   dataType: "json",
                   data: {
                       product_id: product_id,
                       _token: token,
                       _method: "post",

                   },
                   beforeSend: function() {
                       $('#add_to_compare_' + product_id).html('<i class="fas fa-spinner fa spin"></i>');
                   },
                   complete: function() {
                       $('#add_to_compare_' + product_id).html('<i class="fa fa-exchange"></i> ');
                   },
                   success: function(data) {
                       console.log(data);
                       if (data['status']) {
                           $('body #header-ajax').html(data['header']);
                           $('body #compare_counter').html(data['compare_count']);

                           swal({
                               title: "Good job!",
                               text: data['message'],
                               icon: "success",
                               button: "Aww yiss!",
                           });
                       } else if (data['percent']) {
                           $('body #header-ajax').html(data['header']);
                           $('body #compare_counter').html(data['compare_count']);
                           swal({
                               title: "Opps!",
                               text: data['message'],
                               icon: "warning",
                               button: "ok!",
                           });
                       } else {
                           swal({
                               title: "Sorry!",
                               text: data['message'],
                               icon: "error",
                               button: "Aww yiss!",
                           });
                       }

                   }

               })

           })
       </script>
       {{-- /// move to compare page///// --}}
@endsection
