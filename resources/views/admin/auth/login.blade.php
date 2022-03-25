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
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css')}}">

</head>
<body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">
    <div class="d-flex justify-content-center">
      <div class="row">
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
      </div>
    </div>
    <div class="d-flex justify-content-center">
       
      <div class="row">
        <form id="userLoginForm" action="{{ route('admin.login') }}" method="POST" class="shadow rounded bg-light p-5">
          @csrf
          <h3 class="mb-2 text-center">Login</h3>
          <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
            <div class="form-text">We'll never share your email with anyone else.</div>
            @if($errors->has('email'))
                <small class="text-danger"><b>{{$errors->first('email')}}!</b></small>
            @endif
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            @if($errors->has('password'))
                <small class="text-danger"><b>{{$errors->first('password')}}!</b></small>
            @endif
          </div>
          <a href="{{ route('forget.password.get') }}"><u>I forgot my password</u></a><br>
          <button type="submit" class="btn btn-primary registerBtn mt-2 mb-3">Submit</button><br>
          <span class="ml-5 mt-2">New user? <a href="/admin/register" style="color:pink !important; font-weight:bold;">Sign Up</a></span>
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
