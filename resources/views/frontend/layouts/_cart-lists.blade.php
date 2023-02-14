  <table class="table table-bordered mb-30">
      <thead>
          <tr>
              <th scope="col"><i class="icofont-ui-delete"></i></th>
              <th scope="col">Image</th>
              <th scope="col">Product</th>
              <th scope="col">Unit Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
          </tr>
      </thead>
      <tbody>
        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)

          @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
              <tr>
                  <th scope="row">
                      <i class="icofont-close cart-delete" data-id="{{ $item->rowId }}"></i>
                  </th>
                  <td>
                      <img src="{{ $item->model->photo }}" alt="Product">
                  </td>
                  <td>
                      <a href="{{ route('product.detail', $item->model->slug) }}">
                          {{ $item->name }}</a>
                  </td>
                  <td>${{ $item->price }}</td>
                                    <td>${{ $item->size }}dd</td>

                  <td>
                      <div class="quantity">
                          <input type="number" class="qty-text" data-id="{{ $item->rowId }}"
                              id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99"
                              name="quantity" value="{{ $item->qty }}">

                          <input type="hidden" data-id="{{ $item->rowId }}"
                              data-product-qunatity="{{ $item->model->stock }}" id="update-cart-{{ $item->rowId }}">

                      </div>
                  </td>
                  <td>${{ $item->subtotal() }}</td>
              </tr>
          @endforeach
          @else
          <tr>
              <td colspan="5" class="text-center">there is no shipping product hear </td>
          </tr>

      @endif
      </tbody>
  </table>
