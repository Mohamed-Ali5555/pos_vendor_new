@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add currency</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">currency</li>
                            <li class="breadcrumb-item active">Add currency</li>
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
                        
                        <form action="{{route('currencie.store')}}" method="post">
                        @csrf
                        
                       
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="name" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>


                                   <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">symbol <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="symbol" name="symbol"
                                            value="{{ old('symbol') }}">
                                    </div>
                                </div>



                                   <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">exchange_rate <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="exchange_rate" name="exchange_rate"
                                            value="{{ old('exchange_rate') }}">
                                    </div>
                                </div>



                                   <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="code" name="code"
                                            value="{{ old('code') }}">
                                    </div>
                                </div>
                            



                            



                                <div class="col-lg-12 col-sm-12">
                                       <label for="status">status</label>

                                    <select name="status" class="form-control show-tick">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
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
 <script>
  $('#lfm').filemanager('image');

 </script>
 <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>

@endsection