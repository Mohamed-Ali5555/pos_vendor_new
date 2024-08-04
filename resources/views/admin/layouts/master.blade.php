<!doctype html>
<html lang="en">

@include('admin.layouts.head')

<body class="theme-blue">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="../assets/images/logo-icon.svg" width="48" height="48" alt="Lucid">
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->

    <div id="wrapper">

     @include('admin.layouts.nav')
     @include('admin.layouts.sidebar')


      @yield('content')

    </div>
    @include('admin.layouts.footer')
</body>

</html>






































