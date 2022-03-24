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
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css')}}">

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



<div class="container">
  <div class="row">
    <form id="userRegisterForm" class="shadow rounded bg-light p-5">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary registerBtn">Submit</button>
    </form>
  </div>
</div>
    

    
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    </body>
</html>
