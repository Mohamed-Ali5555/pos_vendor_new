@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>edit user</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">user</li>
                            <li class="breadcrumb-item active">edit user</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-md-12">
                    {{-- ################################# --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- ########################### --}}
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">




                    <div class="card">
                        <div class="header">
                            <h2><strong>Basic</strong> Information <small>Description text here...</small> </h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
                                        <li><a href="javascript:void(0);" class="waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class="waves-effect waves-block">Another
                                                action</a></li>
                                        <li><a href="javascript:void(0);" class="waves-effect waves-block">Something
                                                else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                            <form action="{{ route('user.update',$user->id) }}" method="post">
                                @csrf

                                @method('patch')


                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">full name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="full_name"
                                                name="full_name" value="{{ $user->full_name }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Username </label>
                                            <input type="text" class="form-control" placeholder="username"
                                                name="username" value="{{ $user->username }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" placeholder="email" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>





                                    {{-- <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">password <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="password"
                                                name="password" value="{{ $user->password }}">
                                        </div>
                                    </div> --}}




                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="phone"
                                                name="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>





                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="address"
                                                name="address" value="{{ $user->address }}">
                                        </div>
                                    </div>








                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">photo</label>

                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text"
                                                    name="photo" value="{{$user->photo}}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>


                                        </div>
                                    </div>






                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">Role </label>
                                        <select name="role" class="form-control show-tick">
                                            <option value="">-- condition --</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                admin
                                            </option>

                                            <option value="customer" {{ $user->role  == 'customer' ? 'selected' : '' }}>
                                                customer
                                            </option>

                                            <option value="vendor" {{ $user->role  == 'vendor' ? 'selected' : '' }}>
                                                vendor
                                            </option>
                                        </select>
                                    </div>




                                    <div class="col-lg-12 col-sm-12">
                                        <label for="status">status</label>

                                        <select name="status" class="form-control show-tick">
                                            <option value="">-- status --</option>
                                            <option value="active" {{ $user->status  == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive"
                                                {{ $user->status  == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>



                                </div>
                                 <button type="submit" class="btn btn-success">update</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
