<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from preschool.dreamguystech.com/html-template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:39 GMT -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Preskool - Login</title>
      <link rel="shortcut icon" href="{{ url('frontend/img/favicon.png')}}" >
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
      <link rel="stylesheet" href="{{ url('frontend/plugins/bootstrap/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/fontawesome.min.css')}}">
      <link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/all.min.css')}}">
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
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>
                        <form action="{{Route('login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="role">
                                    <option value="" default selected disabled>Choose Your Role </option>
                                    <option value="1">Principle</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Student</option>

                                </select>
                                @error('role')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                           <div class="form-group">
                              <input class="form-control" type="text" placeholder="Email" name="email">
                              @error('email')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                           </div>
                           <div class="form-group">
                              <input class="form-control" type="password" placeholder="Password" name="pwd2">
                              @error('pwd')
                              <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                            @if($errors->any())
                            <span style="color: red">{{$errors->first()}}</span>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                           <div class="form-group">
                              <button class="btn btn-primary btn-block" type="submit">Login</button>
                           </div>
                        </form>
                        <div class="text-center forgotpass"><a href="{{ Route('forgot_password')}}">Forgot Password?</a></div>
                        <div class="login-or">
                           <span class="or-line"></span>

                        </div>

                        <div class="text-center dont-have">Don’t have an account? <a href="{{ url('/register')}}">Register</a></div>
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
   <!-- Mirrored from preschool.dreamguystech.com/html-template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:40 GMT -->
</html>

