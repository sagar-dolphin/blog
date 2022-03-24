<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
          @include('admin.layouts.includes.head')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">
    @if (Session::has('status'))
        <div class="alert alert-secondary">{{Session::get('status')}}</div>
    @endif
    <div class="login-box">
      <div class="card align-items-center card-outline card-primary">
        <div class="card-body">
          <p class="login-box-msg">Register yourself</p>
          <form action="{{ route('admin.register') }}" method="POST">

            @csrf

            <div class="input-group mb-3">
                <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" placeholder="Name">
                
              </div>
              @if($errors->has('name'))
                  <small class="text-danger"><b>{{$errors->first('name')}}!</b></small>
              @endif
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
              <input type="password" id="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>  
            </div>
              @if($errors->has('password'))
                  <small class="text-danger"><b>{{$errors->first('password')}}!</b></small>
              @endif
              <div class="input-group mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
                @if($errors->has('password_confirmation'))
                    <small class="text-danger"><b>{{$errors->first('password_confirmation')}}!</b></small>
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
          <!-- /.social-auth-links -->
  
          <span class="">Already registered? <a href="/admin/login" class="under">Login</a></span>

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
