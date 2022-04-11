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
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css')}}">

</head>
<body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">

<div class=" d-flex justify-content-center">
  <div class="row">
    @if (Session::has('status'))
        <div class="alert alert-secondary">{{Session::get('status')}}</div>
    @endif
    
    <form id="userRegisterForm" action="{{ route('admin.register') }}" method="POST" class="shadow rounded bg-light p-5">
      @csrf
      <h3 class="mb-5 text-center">Register Your Self</h3>
      <div class="mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" placeholder="Name">
        @if($errors->has('name'))
            <small class="text-danger"><b>{{$errors->first('name')}}!</b></small>
        @endif
      </div>
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
      <div class="mb-3">
        <label for="cnfpassword" class="form-label">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
        @if($errors->has('password_confirmation'))
           <small class="text-danger"><b>{{$errors->first('password_confirmation')}}!</b></small>
        @endif
      </div>
      <button type="submit" class="btn btn-primary registerBtn">Submit</button><br>
      <span>Already registered? <a href="{{route('user.login')}}" style="color:pink !important; font-weight:bold;">Login</a></span>  
    </form>
  </div>
</div>

    <script>

    </script>
    </body>
</html>
