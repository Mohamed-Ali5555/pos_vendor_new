@extends('admin.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <ul class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ul>
                        <p class="float-right">Total Orders : {{ \App\Models\Order::count() }}</p>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('admin.layouts.notification')

                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Order</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width:60px;">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @forelse($orders as $order)
                                        <?php $i++; ?>

                                         <tr>
                                                
                                                <td>{{$i}}</td>
                                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{$order->payment_method="cod" ? "Cash on Delivery" : $order->payment_method}}</td>
                                                <td>{{ucfirst($order->payment_status)}}</td>
                                                <td>{{number_format($order->total_amount,2)}}</td>
                                                {{-- <td>{{$order->email}}</td> --}}

                                                <td><span class="badge 
                                                @if($order->condition=='pending')
                                                 badge-info
                                                @elseif($order->condition=='proccessing')
                                                badge-primary
                                                @elseif($order->condition=='delivered')
                                                badge-success
                                                @else
                                                badge-danger
                                                @endif ">{{$order->condition}}</span></td>
                                               

                                                 <td>
                                                        <a href="{{ route('order.show', $order->id) }}"
                                                            data-toggle="tooltip" title="view"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-eye"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('order.destroy', $order->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $order->id }}"
                                                                class="dlBtn btn btn-sm btn-outline-danger"
                                                                data-placement="button"><i class="fas fa-trash-alt"></i></a>

                                                        </form>

                                                    </td>
                                            </tr>
                                        @empty 
                                        <tr>
                                        <td>No orders</td>
                                        </tr>
                                        
                                        @endforelse
                                            
                                           
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

<script>
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});
$('.dlBtn').click(function(e){
    var form  = $(this).closest('form');
    var dataID = $(this).data('id');
    
    e.preventDefault();
    swal({
           title: "Are you sure?",
           text: "Once deleted, you will not be able to recover this imaginary file!",
           icon: "warning",
           buttons: true,
           dangerMode: true,
    })
    .then((willDelete)=>{
        form.submit();
        if(willDelete){
           swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        }else{
            swal("Your imaginary file is safe!");
        }

    });
})
</script>
    {{-- <script>
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
                    form.submit();
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        })
    </script> --}}
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            // ajax code
            $.ajax({
                url: "{{ route('coupon.status') }}", //this name in web.php route
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    // console.log(response.status);
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        alert('please try again !');
                    }
                }
            })
        })
    </script>
@endsection
