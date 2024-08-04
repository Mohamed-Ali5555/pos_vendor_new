@extends('admin.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> coupons
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('coupon.create') }}">Create coupons</a>
                        </h2>
                        <ul class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">coupon</li>
                        </ul>
                        <p class="float-right">Total coupons : {{ \App\Models\Coupon::count() }}</p>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    {{-- @include('backend.layouts.notification') --}}

                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>coupon</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Code</th>
                                             <th>Value</th>
                                            <th>Type</th>
                                           
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($coupons->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($coupons as $coupon)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $coupon->code }}</td>
                                                    <td>{{ $coupon->value }}</td>

                                                 
                                                    <td>
                                                        @if ($coupon->type == 'fixed')
                                                            <span
                                                                class="badge badge-success">{{ $coupon->type }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ $coupon->type }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="toogle" value="{{ $coupon->id }}"
                                                            data-toggle="switchbutton"
                                                            {{ $coupon->status == 'active' ? 'checked' : '' }}
                                                            data-onlabel="active" data-offlabel="inactive"
                                                            data-size="sm"data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('coupon.edit', $coupon->id) }}"
                                                            data-toggle="tooltip" title="edit"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-edit"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('coupon.destroy', $coupon->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $coupon->id }}"
                                                                class="dlBtn btn btn-sm btn-outline-danger"
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
            </div>

        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
            url:"{{route('coupon.status')}}",
            type:"post",
            data:{
                _token:'{{csrf_token()}}',
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    alert(response.msg);
                }else{
                    alert('please try again !');
                }
            }
        })
    })
       
    </script>
@endsection
