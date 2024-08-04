        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count() <= 0)
            <p class="text-center"> You Dont have any items in compare list</p>
        @else
            <table class="table table-bordered mb-30">

                <tbody>

                    <tr>
                        <td class="com-title">product image</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            @php
                                $photo = explode(',', $item->model->photo);
                            @endphp
                            <td class="com-pro-img">
                                <a href="{{ route('product.detail', $item->model->slug) }}"><img
                                        src="{{ asset($photo[0]) }}" alt=""></a>
                            </td>
                        @endforeach




                    </tr>
                    <tr>
                        <td class="com-title">product Name</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td><a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a></td>
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title">Rating</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td>
                                <div class="rating"></div>
                           
                            </td>
                        @endforeach



                    </tr>
                    <tr>
                        <td class="com-title">Price</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            {{-- <td>{{ Helper::currency_converter($item->price) }}</td> --}}kkk
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title">Description</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td> {!! html_entity_decode($item->model->summary) !!} </td>
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title">Category</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td> {{ $item->model->category['title'] }} </td>
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title">Brand</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td> {{ $item->model->brand['title'] }} </td>
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title">Availability</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            @if ($item->model->stock > 0)
                                <td class="instock"> instock </td>
                            @else
                                <td class="instock"> Out Of Stock </td>
                            @endif
                        @endforeach

                    </tr>

                    <tr>
                        <td class="com-title">size</td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td> {{ $item->model->size }} </td>
                        @endforeach

                    </tr>
                    <tr>
                        <td class="com-title"></td>
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                            <td class="action">

                                <a href="javascript:void(0);" data-id="{{ $item->rowId }}"
                                    class="mb-1 compare_addTocart move-to-cart" id="move_to_cart_{{ $item->rowId }}"><i
                                        class="icofont-shopping-cart"></i></a>
                                <a href="javascript:void(0);" data-id="{{ $item->rowId }}"
                                    class="mb-1 compare_addWishlist move-to-wishlist" id=""><i
                                        class="icofont-heart"></i></a>



                                <a href="javascript:void(0);" data-id="{{ $item->rowId }}" id=""
                                    class="mb-1  delete_compare">
                                    <i class="icofont-close"></i></a>
                            </td>
                        @endforeach


                    </tr>

                </tbody>
            </table>
        @endif



        @section('scripts')
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
           {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}


            {{-- ///move to wishlist --}}
            <script>
                $('.move-to-wishlist').on('click', function(e) {
                    e.preventDefault();
                    var rowId = $(this).data('id');

                    var token = "{{ csrf_token() }}";



                    $.ajax({
                        url: "{{ route('compare.move.wishlist') }}",
                        type: "POST",
                        dataType: "json",

                        data: {
                            rowId: rowId,

                            _token: token,
                            _method: "POST",
                        },



                        success: function(data) {
                            if (data['status']) {
                                $('body #cart_counter').html(data['cart_count']);
                                $('body #wishlist_list').html(data['wishlist_list']);
                                $('body #compare').html(data['compare_list']);
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

                    });

                });
            </script>
            {{-- ///move to wishlist --}}
           

            {{-- //// move to cart --}}
            <script>
                $('.move-to-cart').on('click', function(e) {
                    e.preventDefault();
                    var rowId = $(this).data('id');

                    var token = "{{ csrf_token() }}";



                    $.ajax({
                        url: "{{ route('compare.move.cart') }}",
                        type: "POST",
                        dataType: "json",

                        data: {
                            rowId: rowId,

                            _token: token,
                            _method: "POST",
                        },

                        beforeSend: function() {
                            $('#move_to_cart_' + rowId).html('<i class="fa fa-spinner fa-spin"></i>');
                        },

                        success: function(data) {
                            console.log(data);
                            ///////////this make refresh when you add product
                            $('body #header-ajax').html(data['header']);

                            if (data['status']) {
                                $('body #cart_counter').html(data['cart_count']);
                                $('body #wishlist_list').html(data['wishlist_list']);
                                $('body #compare').html(data['compare_list']);
                                $('body #header-ajax').html(data['header']);

                                swal({
                                title: "Good job!",
                                text: data['message'],
                                icon: "success",
                                button: "Aww yiss!",
                            }).then(() => {
                                // Refresh the page after the user closes the success message
                                window.location.reload();
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

                    });

                });
            </script>

            {{-- //// move to cart --}}
        @endsection
