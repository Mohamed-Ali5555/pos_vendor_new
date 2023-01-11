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
               <a href="javascript:void(0);" class="add_to_wishlist_before_click_view" data-quantity="1"
                   data-id="{{ $product->id }}" id="add_to_wishlist_before_click_view_{{ $product->id }}"><i
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
               <a href="javascript:void(0);" data-quantity="1" data-price="{{ $product->offer_price }}"
                   data-product-id="{{ $product->id }}" class="add_to_cart" id="add_to_cart{{ $product->id }}"><i
                       class="icofont-shopping-cart"></i>
                   Add to Cart</a>
           </div>

           <!-- Quick View -->
           <div class="product_quick_view">
               <a href="javascript:void(0);"data-toggle="modal" data-target="#quickview{{ $product->id }}"><i
                       class="icofont-eye-alt"></i> Quick View</a>
           </div>

           <p class="brand_name">
               {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
           <a href="#">{{ ucfirst($product->title) }}</a>
           <h6 class="product-price">{{$product->offer_price}}
           <small><del class="text-danger">{{$product->price }}</del></small>
           </h6>
       </div>
   </div>















   <!-- Quick View Modal Area -->
   <div class="modal fade" id="quickview{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="quickview"
       aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,.5);z-index:99999999999999;">
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
                                       @php
                                           $photo = explode(',', $product->photo);
                                       @endphp
                                       <!-- Product Image -->
                                       <img class="first_img" src="{{ asset($photo[0]) }}" alt="">
                                       <!-- Product Badge -->
                                       <div class="product_badge">
                                           <span class="badge-new">{{ $product->condition }}</span>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-12 col-lg-7">
                                   <div class="quickview_pro_des">
                                       <h4 class="title">{{ ucfirst($product->title) }}
                                       </h4>
                                       <div class="top_seller_product_rating mb-15">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                       </div>
                                       <h5 class="price">
                                           {{-- {{ Helper::currency_converter($product->offer_price) }} --}}
                                           {{-- <span>{{ Helper::currency_converter($product->price) }} --}}
                                           </span>
                                       </h5>
                                       <p>{!! html_entity_decode($product->summary) !!}</p>
                                       <a href="{{ route('product.detail', $product->slug) }}">View
                                           Full Product Details</a>
                                   </div>
                                   <!-- Add to Cart Form -->
                                   <div class="cart" method="post">
                                       <div class="quantity">



                                           <input type="number" class="qty-text22" data-id="{{ $product->id }}"
                                               step="1" min="1" max="99" name="quantity"
                                               value="1" />






                                       </div>
                                       <button type="submit" name="addtocart" value="5"
                                           class="cart-submit add_to_cart22" data-quantity="1"
                                           data-price="{{ $product->offer_price }}"
                                           data-product_id="{{ $product->id }}"
                                           id="add_to_cart22_{{ $product->id }}">Add to
                                           cart</button>
                                       <!-- Wishlist -->
                                       <div class="modal_pro_wishlist  ">
                                           <a href="javascript:void(0);" class="add_to_wishlist_click_view_modal"
                                               data-quantity="1" data-id="{{ $product->id }}"
                                               id="add_to_wishlist_click_view_modal_{{ $product->id }}"><i
                                                   class="icofont-heart"></i></a>

                                       </div>
                                       <!-- Compare -->
                                       <div class="modal_pro_compare">
                                           <a href="compare.html"><i class="icofont-exchange"></i></a>
                                       </div>
                                   </div>
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








 
@section('scripts')
    





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
