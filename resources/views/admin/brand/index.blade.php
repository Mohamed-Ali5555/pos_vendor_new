@extends('admin.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Brands
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('brand.create') }}">Create
                                Brands</a>
                        </h2>
                        <ul class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ul>
                        <p class="float-right">Total Brands : {{ \App\Models\Brand::count() }}</p>
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
                            <h2><strong>Brand</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Slug</th>

                                            <th>photo</th>
                                        

                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Brands->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($Brands as $Brand)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $Brand->title }}</td>
                                                    <td>{{ $Brand->slug }}</td>

                                                    <td><img src="{{ $Brand->photo }}" alt="Brand image"
                                                            style="max-height:107px; width:166px;"></td>


                                           
                                                    <td>
                                                        <input type="checkbox" name="toogle" value="{{ $Brand->id }}"
                                                            data-toggle="switchbutton"
                                                            {{ $Brand->status == 'active' ? 'checked' : '' }}
                                                            data-onlabel="active" data-offlabel="inactive"
                                                            data-size="sm"data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('brand.edit', $Brand->id) }}"
                                                            data-toggle="tooltip" title="edit"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-edit"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('brand.destroy', $Brand->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $Brand->id }}"
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
    </script>
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            // ajax code
            $.ajax({
                url: "{{ route('brand.status') }}", //this name in web.php route
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
