<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="{{ asset('css/Registration.css') }}">


<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>
<body>
    @extends('Templates.master')
        @section('title')
        Register
        @endsection

<script type="text/javascript" src="{{ asset('js/RegistrationValidations.js') }}"></script>
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="{{url('/Register')}}" method="post">
                            @CSRF
                            <!--- UserName -->
                            <div class="form-group row">
                                    <label for="UserName" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="UserName" class="form-control" name="UserName">
                                    </div>
                                </div>

                            <!--- UserName -->
                            <div class="form-group row">
                                    <label for="Password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="Password" id="Password" class="form-control" name="Password">
                                    </div>
                                </div>


                                <!--- Full Name -->
                            <div class="form-group row">
                                    <label for="FullName" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="FullName" class="form-control" name="FullName">
                                    </div>
                                </div>

                                <!--- Email Address -->
                                <div class="form-group row">
                                    <label for="Email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Email" class="form-control" name="Email">
                                    </div>
                                </div>

                               
                                <!--- Phone Number -->
                                <div class="form-group row">
                                    <label for="PhoneNumber" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="PhoneNumber" name = "PhoneNumber" class="form-control">
                                    </div>
                                </div>

                                

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>



</body>
</html>
