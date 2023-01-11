@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add coupon</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">coupon</li>
                            <li class="breadcrumb-item active">Add coupon</li>
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

                            <form action="{{ route('coupon.store') }}" method="post">
                                @csrf


                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Coupon Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Title" name="code"
                                                value="{{ old('code') }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for=""> Coupon value</label>


                                            <input type="text" class="form-control" placeholder="eg 10%" name="value"
                                                value="{{ old('value') }}">
                                        </div>
                                    </div>


                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">Coupon type </label>
                                        <select name="type" class="form-control show-tick">
                                            <option value="">-- type --</option>
                                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}
                                           >
                                                fixed
                                            </option>
                                            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>
                                                percent
                                            </option>
                                        </select>
                                    </div>




                                    <div class="col-lg-12 col-sm-12">
                                        <label for="status">status</label>

                                        <select name="status" class="form-control show-tick">
                                            <option value="">-- status --</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>



                                </div>
                                 <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection
