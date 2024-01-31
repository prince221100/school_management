<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/html-template/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:58 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Reset Password</title>

<link rel="shortcut icon" href="{{ url('frontend/img/favicon.png')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

<link rel="stylesheet" href="{{ url('frontend/plugins/bootstrap/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/all.min.css')}}/">

<link rel="stylesheet" href="{{ url('frontend/css/style.css')}}">
</head>
<body>

<div class="main-wrapper login-body">
<div class="login-wrapper">
<div class="container">
<div class="loginbox">
<div class="login-left">
<img class="img-fluid" src="{{ url('frontend/img/logo-white.png')}}" alt="Logo">
</div>
<div class="login-right">
<div class="login-right-wrap">
    {{-- <h2>Email id : {{$token->email}} </h2> --}}
    <h1>Reset Password?</h1>
    <p>Click the below button and Reset your password.</p>
    {{-- {{ $token->_token}} --}}
    <div class="form-group mb-0"> <a class="btn btn-primary btn-block" href="{{ Route('reset_password',[$token->email,$token->_token])}}">Reset Password Link </a></div>
    </div>
</div>
</div>
</div>
</div>
</div>


<script src="{{ url('frontend/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{ url('frontend/js/popper.min.js')}}"></script>
<script src="{{ url('frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{ url('frontend/js/script.js')}}"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:58 GMT -->
</html>
