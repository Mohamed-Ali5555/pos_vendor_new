  <!-- jQuery (Necessary for All JavaScript Plugins) -->
  <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/classy-nav.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/scrollup.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jarallax.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jarallax-video.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/active.js') }}"></script>

  {{-- // auto complete  --}}
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  {{-- /// end this  --}}

  {{-- <script>
     setTimeout(function(){
       $('#alert').slideUp();
     },4000);
    </script> --}}


  <script>
      $(document).on('click', '.add_to_compare_model', function(e) {
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
                  $('#add_to_compare_model_' + product_id).html(
                      '<i class="fas fa-spinner fa spin"></i>');
                        $('#add_to_compare_model2_' + product_id).html(
                      '<i class="fas fa-spinner fa spin"></i>');
              },
              complete: function() {
                  $('#add_to_compare_model_' + product_id).html('<i class="fa fa-exchange"></i> ');
                              $('#add_to_compare_model2_' + product_id).html('<i class="fa fa-exchange"></i> ');

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




  {{-- /////////// add to wishlst add_to_wishlist_before_click_view//////////// --}}
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
  {{-- /////////// add to wishlst add_to_wishlist_before_click_view//////////// --}}

  {{-- ////  add to cart before modeal --}}
  <script>
      $(document).on('click', '.add_to_cart', function(e) {
          e.preventDefault();
          var product_id = $(this).data('product-id');
          var product_qty = $(this).data('quantity');

          //alert(product_id);

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















  {{-- add to cart on modal  and change quantity --}}
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


                  $('#add_to_cart222_' + product_id).html(
                      '<i class="fa fa-spinner fa-spin"></i>  loading...');
              },
              complete: function() {
                  $('#add_to_cart22_' + product_id).html(
                      '<i class="fa fa-cart-plus"></i>  Add to cart...');
                  $('#add_to_cart222_' + product_id).html(
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











  <script>
      $('#select_size').on('change', function() {
          var responseId = $(this).val();
          var product_id = $('.add_to_cart_button_details').data('product_id');


          $('#add_to_cart_button_details_' + product_id).attr('data-size', responseId);

      });
  </script>

  {{-- ////////c change quantity  --}}
  <script>
      $(document).on('keyup click', '.qty-text', function(e) {
          e.preventDefault();
          var id = $(this).data('id');
          //alert(id);
          var spinner = $(this),
              input = spinner.closest("div.quantity").find('input[type="number"]');



          if (event.type === 'click' || (event.type === 'keyup' && (event.key === 'ArrowUp' || event.key ===
                  'ArrowDown'))) {
              // Prevent the default behavior for click event
              if (event.type === 'click') {
                  event.preventDefault();
              }

          }
          //if (input.val() == 1) {
          //    return false;
          //}



          //if (input.val() != 1) {
          //    var newVal = parseFloat(input.val());
          //    $('#qty-input-' + id).val(newVal);
          //}

          var productQuantity = $("#update-cart-" + id).data('product-qunatity'); /// stock
          {{-- alert(productQuantity) --}}
          update_cart(id, productQuantity)
      });

      function update_cart(id, productQuantity) {
          var rowId = id;
          var product_qty = $('#qty-input-' + rowId).val();
          var token = "{{ csrf_token() }}";
          var path = "{{ route('cart.update') }}";
          //  alert(product_qty);

          $.ajax({
              url: path,
              type: "post",
              data: {
                  _token: token,
                  product_qty: product_qty,
                  rowId: rowId,
                  productQuantity: productQuantity,
              },
              success: function(data) {
                  console.log(data);
                  $('body #header-ajax').html(data['header']);
                  $('body #cart_counter').html(data['cart_count']);
                  $('body #cart_list').html(data['cart_list']);
                  if (data['status']) {
                      $('#subtotal').html('$' + data['total']);

                      $('#subtotalall').load(location.href + ' #subtotalall');
                      // var subtotal = data['total']; // Adjust this line based on your actual data structure

                      //$('#subtotalall').html('<td>Total</td><td>$' + subtotal + '</td>');

                  }
                  if (data['status']) {
                      swal({
                          title: "Good job!",
                          text: data['message'],
                          icon: "success",
                          button: "ok!",
                      });
                      alert(data['message']);
                  } else {

                      alert(data['message']);

                  }
              }

          });

      }
  </script>

  {{-- ////////c change quantity  --}}
  <script>
      // $(document).on('click', '.add_to_cart_button_details23', function(e) {

      $(document).on('click', '.add_to_cart_button_details', function(e) {
          e.preventDefault();
          var product_id = $(this).data('product_id');
          var quantity = $(this).data('quantity');
          var price = $(this).data('price');
          var size = $(this).data('size');

          var token = "{{ csrf_token() }}";


          $.ajax({
              url: "{{ route('cart.store') }}",
              type: "post",
              dataType: "json",

              data: {
                  product_id: product_id,
                  product_qty: quantity,
                  product_price: price,
                  product_size: size,
                  _token: token,
                  _method: "post",
              },
              beforeSend: function() {
                  $('#add_to_cart_button_details' + product_id).html(
                      '<i class="fa fa-spinner fa-spin"></i> loading...'
                  )
              },
              complete: function() {
                  $('#add_to_cart_button_details_' + product_id).html(
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
              }

          });
      });
  </script>


  {{-- add_to_compare --}}


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

  {{-- add_to_compare --}}


  {{-- cart item delete in dropdown  --}}

  <script>
      $(document).on('click', '.cart_delete_dropdown', function(e) {
          e.preventDefault();

          //alert('fff');
          var rowId = $(this).data('id');
          //alert(rowId);

          var token = "{{ csrf_token() }}";
          //  var path=;



          $.ajax({
              url: "{{ route('cart.delete') }}",
              type: "POST",
              dataType: "json",

              data: {
                  rowId: rowId,
                  _token: token,
                  _method: "POST",
              },



              success: function(data) {
                  console.log(data);
                  ///////////this make refresh when you add product
                  ////////////////
                  if (data['status']) {
                      $('body #header-ajax').html(data['header']);


                      swal({
                          title: "Good job!",
                          text: data['message'],
                          icon: "success",
                          button: "ok!",
                      });
                  }


              },
              error: function(err) {
                  alert('error');
              }


          });
      });
  </script>














  {{-- /////// delete item from cart  /////////  --}}



  <script>
      $(document).on('click', '.cart-delete', function(e) {
          e.preventDefault();
          var rowId = $(this).data('id');

          var token = "{{ csrf_token() }}";
          {{-- var path=; --}}



          $.ajax({
              url: "{{ route('cart.delete') }}",
              type: "POST",
              dataType: "json",

              data: {
                  rowId: rowId,
                  _token: token,
                  _method: "POST",
              },



              success: function(data) {
                  console.log(data);
                  ///////////this make refresh when you add product
                  ////////////////
                  if (data['status']) {

                      $('#product_' + rowId).remove();

                      $('body #header-ajax').html(data['header']);
                      $('body #cart_list').html(data['cart_list']);
                      $('body #cart_counter').html(data['cart_count']);
                      $('#subtotal').html('$' + data['total']);

                      swal({
                          title: "Good job!",
                          text: data['message'],
                          icon: "success",
                          button: "ok!",
                      });
                  }


              },
              error: function(err) {
                  alert('vgggggg');
              }


          });
      });
  </script>
  {{-- /////// delete from cart  /////////  --}}







  {{-- //// delete item from compare --}}
  <script>
      $(document).ready(function() {

          $(document).on('click', '.delete_compare', function(e) {
              // alert('g');
              e.preventDefault();
              var id = $(this).data('id');

              var token = "{{ csrf_token() }}";
              //{{-- alert(rowId); --}}

              $.ajax({
                  url: "{{ route('compare.delete') }}",
                  type: "POST",
                  dataType: "json",
                  data: {
                      _token: token,
                      id: id,
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
                  },
                  error: function(err) {
                      alert('vgggggg');
                  }

              });

          });
      });
  </script>
  {{-- //// delete item from compare --}}










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

                            $('#add_to_wishlist_click_view_modal2_' + product_id).html(
                          '<i class="fa fa-spinner fa-spin"></i>');
                  },
                  complete: function() {
                      $('#add_to_wishlist_click_view_modal_' + product_id).html(
                          '<i class="fa fa-heart"></i>  Add to wishlist...');

                                 $('#add_to_wishlist_click_view_modal2_' + product_id).html(
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
  @yield('scripts')
