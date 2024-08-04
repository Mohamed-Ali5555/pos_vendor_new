@extends('admin.layouts.master')


@section('content')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Users
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('user.create') }}">Create Users</a>
                        </h2>
                        <ul class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ul>
                        <p class="float-right">Total Users : {{ \App\Models\User::count() }}</p>
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
                            <h2><strong>User</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Photo</th>
                                            <th>Full name</th>

                                            <th>Email</th>


                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($users as $user)
                                                <?php $i++; ?>

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td><img src="{{ $user->photo }}" alt="user image"
                                                            style="max-height:90px; max-width:120px; border-radius:50%;">
                                                    </td>

                                                    <td>{{ $user->full_name }}</td>



                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role }}</td>





                                                    <td>
                                                        <input type="checkbox" name="toogle" value="{{ $user->id }}"
                                                            data-toggle="switchbutton"
                                                            {{ $user->status == 'active' ? 'checked' : '' }}
                                                            data-onlabel="active" data-offlabel="inactive"
                                                            data-size="sm"data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target="#userID{{$user->id}}"
                                                            class="float-left btn btn-sm btn-outline-success"
                                                            data-placement="button"><i class="fas fa-eye"></i></a>


                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            data-toggle="tooltip" title="edit"
                                                            class="float-left btn btn-sm btn-outline-warning"
                                                            data-placement="button"><i class="fas fa-edit"></i></a>

                                                        <form class="float-left ml-2"
                                                            action="{{ route('user.destroy', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $user->id }}"
                                                                class="dlBtn btn btn-sm btn-outline-danger"
                                                                data-placement="button"><i class="fas fa-trash-alt"></i></a>

                                                        </form>

                                                    </td>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="userID{{$user->id}}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        @php
                                                        $user = \App\Models\User::where('id',$user->id)->first();
                                                        @endphp
                                                            <div class="modal-content">
                                                            <div class="text-center">
                                                               <img src="{{$user->photo}}" style="border-radius:50%;margin:2% 0;height:100px;"/>
                                                            </div>
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center" id="exampleModalLabel">{{$user->full_name}}
                                                                   </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong>Username:</strong>
                                                                    <p>     {{$user->username}}</p>
                                                         
                   
                                                                       <div class="row">

                                                                    <div class="col-md-6">
                                                                       <strong>Email:</strong>
                                                                       <p>{{$user->email}}</p>
                                                                       </div>

                                                                     <div class="col-md-6">
                                                                       <strong>Phone:</strong>
                                                                       <p>{{$user->phone}}</p>
                                                                       </div>

                                                                       </div>
                                                                       <div class="row">

                                                                     <div class="col-md-6">
                                                                       <strong>Address</strong>
                                                                       <p class="badge badge-warning">{{$user->adderss}}</p>
                                                                       
                                                                       </div>

                                                                      <div class="col-md-6">
                                                                       <strong>Role:</strong>
                                                                       <p class="badge badge-warning">{{$user->role}}</p>
                                                                       
                                                                       </div>
                                                                      
                                                                       <div class="col-md-6">
                                                                       <strong>Status</strong>
                                                                       <p class="badge badge-warning">{{$user->status}}</p>
                                                                       
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
                url: "{{ route('user.status') }}", //this name in web.php route
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
        });
    </script>
@endsection
