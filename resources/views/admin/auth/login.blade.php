<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Login Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
          @include('admin.layouts.includes.head')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">
    @if (Session::has('verify-message'))
      <div class="alert alert-secondary">{{Session::get('verify-message')}}</div>
    @endif
    @if (Session::has('msg'))
          <small class="text-danger">{{ Session::get('msg')}}</small>
    @endif
    @if (Session::has('password_message'))
          <span class="alert alert-secondary">{{ Session::get('password_message')}}</span>
    @endif
    @if (Session::has('status'))
          <span class="alert alert-secondary">{{ Session::get('status')}}</span>
    @endif
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card align-items-center card-outline card-primary">
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
              <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
              @if($errors->has('email'))
                  <small class="text-danger"><b>{{$errors->first('email')}}!</b></small>
              @endif
            <div class="input-group mb-3">
              <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
              @if($errors->has('password'))
                  <small class="text-danger"><b>{{$errors->first('password')}}!</b></small>
              @endif
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember_me" name="remember_me">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" style="background-color: #0969D9" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
          {{-- <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div> --}}
          <!-- /.social-auth-links -->
    
          <p class="mb-1">
            <a href="{{ route('forget.password.get') }}">I forgot my password</a>
          </p>
          <span class="m-3">New user? <a href="/admin/register" class="under">Sign Up</a></span>
          {{-- <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p> --}}
        </div>
        <!-- /.card-body -->
      </div>  
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
    
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    </body>
</html>
