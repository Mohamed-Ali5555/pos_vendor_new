@extends('admin.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Banners
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('banner.create') }}">Create Banners</a>
                        </h2>
                        <ul class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Banner</li>
                        </ul>
                        <p class="float-right">Total Banners : {{ \App\Models\Banner::count() }}</p>
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
                            <h2><strong>Banner</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>photo</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Banners->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($Banners as $Banner)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $Banner->title }}</td>
                                                    <td>{!! html_entity_decode($Banner->description) !!}</td>
                                                    <td><img src="{{ $Banner->photo }}" alt="banner image"
                                                            style="max-height:90px; max-width:120px;"></td>
                                                    <td>
                                                        @if ($Banner->condition == 'banner')
                                                            <span
                                                                class="badge badge-success">{{ $Banner->condition }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $Banner->condition }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="toogle" value="{{ $Banner->id }}"
                                                            data-toggle="switchbutton"
                                                            {{ $Banner->status == 'active' ? 'checked' : '' }}
                                                            data-onlabel="active" data-offlabel="inactive"
                                                            data-size="sm"data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('banner.edit', $Banner->id) }}"
                                                            data-toggle="tooltip" title="edit"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-edit"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('banner.destroy', $Banner->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $Banner->id }}"
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}

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



            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {  
               
                if (result.isConfirmed) {
                     form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }else{
                        swal("Your imaginary file is safe!");

                }
            })

    
        })
    </script>
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            // ajax code
            $.ajax({
                url: "{{ route('banner.status') }}", //this name in web.php route
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
