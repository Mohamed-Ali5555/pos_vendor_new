
<!doctype html>
<html lang="en">

<head>
<title> Login page admin  </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="Mohamed Ali">

<link rel="icon" href="{{get_setting('favicon')}}" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('backend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/color_skins.css')}}">
</head>

<body class="theme-blue">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top text-center">
                        {{-- <img src="{{asset(get_setting('logo'))}}" alt="Lucid"> --}}
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Login to your account ADMIN</p>
                        </div>                              
                                {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

                          {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

                        <div class="body">

                            <form class="form-auth-small" method="POST" action="{{ route('admin.login') }}">
                                            @csrf

                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email Admin</label>
                                    <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autofocus placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="password"  name="password"   required autocomplete="current-password"  placeholder="password" >
                                </div>
                      
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                          
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <!-- END WRAPPER -->
    

</body>
</html>
