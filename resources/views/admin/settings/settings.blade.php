@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">category</li>
                            <li class="breadcrumb-item active">Add category</li>
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

                            <form action="{{ route('setting.update') }}" method="post">
                                @method('put')
                                @csrf


                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        @include('admin.layouts.notification')

                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Project Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                value="{{ $setting->title }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Meta Description <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Meta Description"
                                                name="meta_description" value="{{ $setting->meta_description }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Footer <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Footer" name="footer"
                                                value="{{ $setting->footer }}">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Logo</label>

                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="logo"
                                                    value="{{ $setting->logo }}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>


                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Favicon</label>

                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text" name="favicon"
                                                    value="{{ $setting->favicon }}">
                                            </div>
                                            <div id="holder1" style="margin-top:15px;max-height:100px;"></div>


                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Email Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Email"
                                                name="email" value="{{ $setting->email }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Address"
                                                name="address" value="{{ $setting->address }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Phone number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="phone number"
                                                name="phone" value="{{ $setting->phone }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Fax <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="fax" name="fax"
                                                value="{{ $setting->fax }}">
                                        </div>
                                    </div>






                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Facebook Url</label>
                                            <input type="text" class="form-control" placeholder="facebook_url"
                                                name="facebook_url" value="{{ $setting->facebook_url }}">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Twitter Url</label>
                                            <input type="text" class="form-control" placeholder="twiter url"
                                                name="twitter_url" value="{{ $setting->twitter_url }}">
                                        </div>
                                    </div>




                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Linkedin Url</label>
                                            <input type="text" class="form-control" placeholder="Linkedin Url"
                                                name="linkedin_url" value="{{ $setting->linkedin_url }}">
                                        </div>
                                    </div>





                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Pinterest Url</label>
                                            <input type="text" class="form-control" placeholder="Pinterest url"
                                                name="pinterest_url" value="{{ $setting->pinterest_url }}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                    </div>


                                </div>

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
        $('#lfm1').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
