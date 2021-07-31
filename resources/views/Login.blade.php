<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/LoginPage.css') }}">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    @extends('Templates.master')
        @section('title')
        Login
        @endsection




         <div id="login">
        <div class="container">
          @if(count($errors) > 0)
          <div id="loginError">
           @foreach( $errors->all() as $message )
            <div class="alert alert-danger display-hide">
             <button class="close" data-close="alert"></button>
             <span>{{ $message }}</span>
            </div>
           @endforeach
         </div>
          @endif
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">

                        <form id="login-form" class="form" action="/Login" method="post">
                        @CSRF
                            <h3 class="text-center text-info" id = signInLabel>Sign In</h3>
                            <div class="form-group">
                                <label for="UserName" class="text-info">Username:</label><br>
                                <input type="text" name="UserName" id="UserName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Password" class="text-info">Password:</label><br>
                                <input type="password" name="Password" id="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="Register" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
