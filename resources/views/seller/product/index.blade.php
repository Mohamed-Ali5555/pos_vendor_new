@extends('seller.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> products
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('seller-product.create') }}">Create
                                products</a>
                        </h2>
                        <ul class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('seller') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">product</li>
                        </ul>
                        <p class="float-right">Total products : {{ $products->count() }}</p>
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
                            <h2><strong>product</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($products->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($products as $product)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $product->title }}</td>

                                                    <td><img src="{{ $product->photo }}" alt="product image"
                                                            style="max-height:107px; width:166px;"></td>

                                                    
                                                    <td>${{number_format($product->price,2)}}</td>
                                                    <td>{{$product->discount}}</td>
                                                    <td>{{$product->size}}</td>

                                                     <td>
                                                     @if ($product->condition == 'new')
                                                            <span
                                                                class="badge badge-success">{{ $product->condition }}</span>
                                                        @elseif($product->condition=='popular')
                                                            <span
                                                                class="badge badge-warning">{{ $product->condition }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ $product->condition }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <input type="checkbox" name="toogle" value="{{ $product->id }}"
                                                            data-toggle="switchbutton"
                                                            {{ $product->status == 'active' ? 'checked' : '' }}
                                                            data-onlabel="active" data-offlabel="inactive"
                                                            data-size="sm"data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>

                                                           <a href="{{route('seller-product.show',$product->id)}}"  data-toggle="tooltip" title="add attribute"
                                                            class="float-left btn btn-sm btn-outline-secondary"
                                                            data-placement="button"><i class="fas fa-plus-circle"></i></a>


                                                          <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target="#productID{{$product->id}}"
                                                            class="float-left btn btn-sm btn-outline-success"
                                                            data-placement="button"><i class="fas fa-eye"></i></a>


                                                        <a href="{{ route('seller-product.edit', $product->id) }}"
                                                            data-toggle="tooltip" title="edit"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-edit"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('seller-product.destroy', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $product->id }}"
                                                                class="dlBtn btn btn-sm btn-outline-success"
                                                                data-placement="button"><i class="fas fa-trash-alt"></i></a>

                                                        </form>

                                                    </td>

                                             <!-- Modal -->
                                                    <div class="modal fade" id="productID{{$product->id}}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        @php
                                                        $product = \App\Models\product::where('id',$product->id)->first();
                                                        @endphp
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{\Illuminate\Support\Str::upper($product->full_name)}}
                                                                    {{-- to make title uapper case --}}
                                                                        </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong>Summary:</strong>
                                                                    <p>{!! html_entity_decode($product->summary) !!}</p>
                                                                    <strong>Description:</strong>
                                                                    <p>{!! html_entity_decode($product->description) !!}</p>
                   
                                                                       <div class="row">

                                                                         <div class="col-md-4">
                                                                         <strong>Price:</strong>
                                                                         <p>${{number_format($product->price,2)}}</p>
                                                                         </div>

                                                                         <div class="col-md-4">
                                                                         <strong>Offer price:</strong>
                                                                         <p>${{number_format($product->offer_price,2)}}</p>
                                                                         </div>

                                                                         <div class="col-md-4">
                                                                         <strong>Stock:</strong>
                                                                         <p>${{number_format($product->stock,2)}}</p>
                                                                         </div>
                                                                       
                                                                       </div>
                                                                       <div class="row">
                                                                       <div class="col-md-6">
                                                                         <strong>Category:</strong>
                                                                         <p>{{\App\Models\Category::where('id',$product->cat_id)->value('title')}}</p>
                                                                       </div>
                                                                       <div class="col-md-6">
                                                                       <strong>Child Category</strong>
                                                                       <p>{{\App\Models\Category::where('id',$product->Child_cat_id)->value('title')}}</p>
                                                                       
                                                                       </div>
                                                                       </div>



                                                                           <div class="row">
                                                                       <div class="col-md-6">
                                                                         <strong>Brand:</strong>
                                                                         <p>{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                                       </div>
                                                                       <div class="col-md-6">
                                                                       <strong>Size</strong>
                                                                       <p class="badge badge-success">{{$product->size}}</p>
                                                                       
                                                                       </div>
                                                                       </div>


                                                                            <div class="row">
                                                                       <div class="col-md-6">
                                                                         <strong>Condition</strong>
                                                                         <p class="badge badge-primary">{{$product->condition}}</p>
                                                                       </div>
                                                                       <div class="col-md-6">
                                                                       <strong>Status</strong>
                                                                       <p class="badge badge-warning">{{$product->status}}</p>
                                                                       
                                                                       </div>
                                                                       </div>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    

                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('scripts')
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
    <script>
    

        $('input[name=toogle]').change(function(){
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url:"{{route('seller.product.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                    mode:mode,

                },
                success:function(response){
                    if(response.status){
                        alert(response.msg);
                    }else{
                        alert('please try again');
                    }

                }
            })
        })
    </script>
@endsection
