@extends('seller.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> products </h2>
                        <ul class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">product Attribute</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('seller.layouts.notification')

                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ ucfirst($products->title) }}</strong> </h2>
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="{{ route('product.attribute', $products->id) }}" method="post">
                                        @csrf

                                        <div id="product_attribute" class="content"
                                            data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                            <div class="row">
                                                <div class="col-md-12"><button type="button" id="btnAdd-1"
                                                        class="btn btn-primary"> <i class="fas fa-plus-circle"></i>
                                                    </button></div>
                                            </div>
                                            <div class="row group">
                                                <div class="col-md-2">
                                                    <label for="">Size</label>
                                                    <input class="form-control form-control-sm" placeholder="eg. s"
                                                        name="size[]" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Original price</label>
                                                    <input class="form-control form-control-sm" placeholder="eg. 1200"
                                                        name="original_price[]" type="number" step="any">
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">Offer price</label>
                                                    <input class="form-control form-control-sm" placeholder="eg. 1200"
                                                        name="offer_price[]" type="number" step="any">
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Stock</label>
                                                    <input class="form-control form-control-sm" placeholder="eg. 4"
                                                        name="stock[]" type="number">
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btnRemove mt-4"><i
                                                            class="fas fa-trash"></i></button>
                                                </div>
                                            </div>

                                        </div><button class="btn btn-sm btn-info" type="submit">Submit</button>
                                    </form>
                                </div>

                                <div class="col-md-5">
                                     <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Size</th>
                                            <th>original</th>
                                            <th>offer</th>
                                            <th>stock</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($productAttr->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($productAttr as $item)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->size }}</td>

                                             
                                                    <td>${{number_format($item->original_price,2)}}</td>
                                                    <td>${{number_format($item->offer_price,2)}}</td>

                                                    <td>{{$item->stock}}</td>
                                                    <td>
                                                            <form class="float-left ml-2"
                                                            action="{{ route('seller.productAttribute.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $item->id }}"
                                                                class="dlBtn btn btn-sm btn-outline-success"
                                                                data-placement="button"><i class="fas fa-trash-alt"></i></a>

                                                        </form>
                                                        </td>

                                                    

                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>

                        </div>
                        <div class="body">


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('backend/assets/js/jquery.multifield.min.js') }}"></script>
    <script>
        $('#product_attribute').multifield();
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script>
$('.dlBtn').click(function(e){
    alert ('dddddddddd');
})
</script> --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dlBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                  
                    if (willDelete) {
                          form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        })
    </script>
@endsection
