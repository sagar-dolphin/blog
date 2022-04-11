@extends('user.app')

@section('bg-img',asset('user/img/post-sample-image.jpg'))
@section('head')
    <link rel="stylesheet" href="style.css">
@endsection
@section('title', 'Contact')
@section('sub-heading','Want to connect with me?')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <form id="userRegisterForm" action="{{ route('admin.register') }}" method="POST" class="shadow rounded bg-light p-5">
                @csrf
                <h3 class="mb-5 text-center">Contact Us</h3>
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
                <button type="submit" class="btn btn-primary">Submit</button><br>
                <span>Already registered? <a href="{{route('user.login')}}" style="color:pink !important; font-weight:bold;">Login</a></span>  
              </form>
        </div>
    </div>
</div>

@endsection

{{-- @section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection --}}