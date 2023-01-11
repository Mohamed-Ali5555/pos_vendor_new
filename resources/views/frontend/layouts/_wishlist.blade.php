 <table class="table table-bordered mb-30">
     <thead>
         <tr>
             <th scope="col"><i class="icofont-ui-delete"></i></th>
             <th scope="col">Image</th>
             <th scope="col">Product</th>
             <th scope="col">Unit Price</th>

             <th scope="col"></th>
         </tr>
     </thead>
     <tbody>

         @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() > 0)
             @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
                 <tr>
                     <th scope="row">
                         <i class="icofont-close delete_wishlist" data-id="{{ $item->rowId }}"></i>
                     </th>
                     <td>
                         <img src="{{ $item->model->photo }}" alt="Product">
                     </td>
                     <td>
                         <a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a>
                     </td>
                     <td>${{ number_format($item->price, 2) }}</td>

                     <td><a href="javascript:void(0);" data-id="{{ $item->rowId }}"
                             class="move-to-cart btn btn-primary btn-sm move-to-cart-wishlist"
                             id="move_to_cart_{{ $item->rowId }}">Add to
                             Cart</a></td>
                 </tr>
             @endforeach
         @else
             <tr>
                 <td colspan="5" class="text-center">there is no wishlist product hear </td>
             </tr>

         @endif
     </tbody>
 </table>








 @section('scripts')
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script>
         $(document).on('click', '.move-to-cart-wishlist', function(e) {
             e.preventDefault();
             var product_id = $(this).data('id');
             var token = "{{ csrf_token() }}";
             $.ajax({
                 url: "{{ route('move.cart') }}",
                 type: "post",
                 data: {
                     product_id: product_id,
                     _token: token,
                 },
                 beforeSend: function() {
                     $('#move_to_cart_' +product_id ).html('<i class="fa fa-spinner fa-spin"></i>');
                 },
                 complete: function() {
                     $('#move_to_cart_' + product_id).html(
                         '<i class="fa fa-cart-plus"></i>  Add to cart...');

                 },
                 success: function(data) {

                     console.log(data);
                     $('body #header-ajax').html('header');
                     if (data['status']) {

                         $('body #cart_counter').html(data['cart_count']);
                         $('body #wishlist_list').html(data['wishlist_list']);
                         $('body #header-ajax').html(data['header']);


                         swal({
                             title: "Good job!",
                             text: data['message'],
                             icon: "success",
                             button: "Aww yiss!",
                         });

                     } else {
                         swal({
                             title: "error",
                             text: "someting went wrong",
                             icon: "error",
                             button: "Aww yiss!",
                         });
                     }

                 }
             })
         })
     </script>
     <script>
         $(document).on('click', '.delete_wishlist', function() {
             var rowId = $(this).data('id');
             var token = "{{ csrf_token() }}";

             $.ajax({
                 url: "{{ route('wishlist.delete') }}",
                 type: "post",
                 data: {
                     rowId: rowId,
                     _token: token,
                 },
                 success: function(data) {
                     if (data['status']) {
                         $('body #header-ajax').html(data['header']);
                         $('body #wishlist_list').html(data['wishlist_list']);
                         $('body #cart_counter').html(data['cart_count']);

                         swal({
                             title: "Good job!",
                             text: data['message'],
                             icon: "success",
                             button: "ok!",
                         });
                     } else {
                         swal({
                             title: "error",
                             text: "someting went wrong",
                             icon: "error",
                             button: "Aww yiss!",
                         });
                     }
                 },
                 error: function(err) {
                     alert('thers is error');
                 }

             });

         })
     </script>
 @endsection
