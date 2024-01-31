<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/html-template/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:58 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Forgot Password</title>

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
<h1>Forgot Password?</h1>
<p class="account-subtitle">Enter your email to get a password reset link in your email</p>

<form action="{{ Route('forgot')}}" method="POST">
    @csrf
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Email" name="email">
        @if ($errors->any())
            <span style="color: red">{{$errors->first()}}</span>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
    </div>
</form>

<div class="text-center dont-have">Remember your password? <a href="{{ url('/')}}">Login</a></div>
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
