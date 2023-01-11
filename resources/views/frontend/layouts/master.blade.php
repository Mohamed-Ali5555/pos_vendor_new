<!doctype html>
<html lang="en">

<head>
      @include('frontend.layouts.head')


</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <header class="header_area" id="header-ajax">

           @include('frontend.layouts.header')
               </header>

           <div class="container">
                  <div class="row">
              <div class="col-md-12">
                {{-- @include('backend.layouts.notification') --}}
              </div>
            </div></div>

           @yield('content')



        @include('frontend.layouts.footer')


      @include('frontend.layouts.script')

     






        

</body>

</html>