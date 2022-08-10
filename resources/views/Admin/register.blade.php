<!DOCTYPE html>
<html lang="en"> 

<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/assets/img/mini_logo.png')}}">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">
     
</head>

<body class="bg-info">
 
<div class="main-wrapper account-wrapper"> 
    <div class="account-page  "> 
		<div class="account-center">
			<div class="account-box w-75 h-auto rounded"> 
	            <div class="row">
	                <div class="col my-auto">
	                    <img src="{{url('public/assets/img/login-img.png')}}" width="100%">
	                </div>
	                <div class="col my-auto">
	                	
	               		<form method="post" action="{{ url('register') }}" class="form-signin">
	               			@csrf
							<div class="account-logo">
	                            <a href="index-2.html">
	                            	<img src="{{ url('public/assets/img/mini_logo.png')}}" alt="">
	                            </a>
	                        </div>
	                        <div class="form-group">
	                            <label>Username</label>
	                            <input type="text" class="form-control" name="username" placeholder="User Name">
	                            @error('username')
	                            <div class="text-center text-danger">
	                            	{{ $message }}
	                            </div>
	                            @enderror
	                             
	                        </div>
	                        <div class="form-group">
	                            <label>Email Address</label>
	                            <input type="email" class="form-control" name="email" placeholder="Email">

	                            @error('email')
	                            <div class="text-center text-danger">
	                            	{{ $message }}
	                            </div>
	                            @enderror
	                           
	                        </div>
	                        <div class="form-group">
	                            <label>Password</label>
	                            <input type="password" class="form-control" name="password" placeholder="Password">

	                            @error('password')
	                            <div class="text-center text-danger">
	                            	{{ $message }}
	                            </div>
	                            @enderror
	                             
	                        </div>
	                        <div class="form-group">
	                            <label>Confirm Password</label>
	                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
	                        </div>
	                        @if(Session::has('passError'))
		                	<div class="alert alert-danger text-center">
		                		<span>
		                			{{Session::get('passError')}}
		                		</span>
		                	</div>
		                	@endif
	                        <div class="form-group checkbox">
	                            <label>
	                                <input type="checkbox"> I have read and agree the Terms & Conditions
	                            </label>
	                        </div>
	                        <div class="form-group text-center">
	                            <button class="btn btn-primary account-btn" type="submit">Signup</button>
	                        </div>
	                        <div class="text-center login-link">
	                            Already have an account? <a href="{{ url('login') }}">Login</a>
	                        </div>
	                    </form> 
	                </div>
	            </div>            
               
			</div>
        </div>
    </div>
</div>
    <script src="{{url('public/assets/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{url('public/assets/js/popper.min')}}.js"></script>
    <script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/assets/js/app.js')}}"></script>
</body>


<!-- login23:12-->
</html>