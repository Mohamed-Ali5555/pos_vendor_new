@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add products</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item">products</li>
                            <li class="breadcrumb-item active">Add product</li>
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

                            <form action="{{ route('product.store') }}" method="post">
                                @csrf


                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Summary <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="summary" placeholder="Some text ..." name="summary">  {{ old('summary') }}</textarea>

                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">description</label>
                                            <textarea id="description" class="form-control" placeholder="write some text....." name="description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Stock <span class="text-danger">*</span> </label>
                                            <input type="number" class="form-control" placeholder="Stock" name="stock"
                                                value="{{ old('stock') }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">photo <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="photo">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>


                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">size_guide <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail1" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text"
                                                    name="size_guide">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>


                                        </div>
                                    </div>






                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Price <span class="text-danger">*</span> </label>
                                            <input type="number" step="any" class="form-control"
                                                placeholder="Price" name="price" value="{{ old('price') }}">
                                        </div>
                                    </div>





                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Discount </label>
                                            <input type="number" min="0" max="100" step="any"
                                                class="form-control" placeholder="Discount" name="discount"
                                                value="{{ old('discount') }}">
                                        </div>
                                    </div>















                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">Brands </label>

                                        <select name="brand_id" class="form-control show-tick">
                                            <option value="">--brands--</option>
                                            @foreach (\App\Models\Brand::get() as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>

                                                    {{ $brand->title }}

                                                </option>
                                            @endforeach
                                        </select>

                                    </div>







                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">Category </label>
                                        <select id="cat_id" name="cat_id" class="form-control show-tick">
                                            <option value="">-- category --</option>


                                            @foreach (\App\Models\Category::where('is_parent', 1)->get() as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('cat_id') == $category->id ? 'selected' : '' }}>

                                                    {{ $category->title }}</option>
                                            @endforeach


                                        </select>
                                    </div>







                                    <div class="col-lg-12  col-sm-12 d-none" id="child_cat_div">
                                        <label for="">Child category </label>
                                        <select id="child_cat_id" name="child_cat_id" class="form-control show-tick">

                                        </select>
                                    </div>






                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">Size </label>
                                        <select name="size" class="form-control show-tick">
                                            <option value="">-- Size --</option>
                                            <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small
                                            </option>
                                            <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>Medium
                                            </option>
                                            <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Larg
                                            </option>
                                            <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>Extra Larg
                                            </option>
                                        </select>
                                    </div>






                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">conditions </label>
                                        <select name="condition" class="form-control show-tick">
                                            <option value="">-- condition --</option>

                                            <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New
                                            </option>
                                            <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>
                                                Popular
                                            </option>
                                            <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>
                                                Winter
                                            </option>
                                        </select>
                                    </div>


                                    <div class="col-lg-12  col-sm-12">
                                        <label for="">added by </label>
                                        <select name="added_by" class="form-control show-tick">

                                            <option value="admin" {{ old('added_by') == 'admin' ? 'selected' : '' }}>
                                                admin
                                            </option>
                                            {{-- @foreach (\App\Models\seller::orderBy('full_name', 'ASC')->get() as $item)
                                                <option value="{{ $item->full_name }}"
                                                    {{ old('added_by') == $item->full_name ? 'selected' : '' }}>
                                                    {{ $item->full_name }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>







                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">additional_info</label>
                                            <textarea id="description" class="form-control description" placeholder="write some text....."
                                                name="additional_info"> {{ old('additional_info') }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">return_cancellation</label>
                                            <textarea id="description" class="form-control description" placeholder="write some text...."
                                                name="return_cancellation">{{ old('return_cancellation') }}</textarea>
                                        </div>
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
    <script>
        $('#lfm,#lfm1').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('.description').summernote();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>
    <script>
     


        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            if (cat_id != null) {
                $.ajax({

                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''>--child--</option>";
                        if (response.status) { //===true
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title +
                                    "</option>";
                            });

                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }


                        $('#child_cat_id').html(html_option);

                    }

                });
            }
        });
    </script>
@endsection
