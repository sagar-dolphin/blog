<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-10">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">
                            @if ($errors->has('token'))
                                <span id="tokenMsg" class="alert alert-danger">{{ $errors->first('token') }}</span>
                            @endif
                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
        
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" id="email_address" value="{{old('email')}}" class="form-control" name="email" autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" id="password" class="form-control" name="password" autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary resetPassBtn">
                                        Reset Password
                                    </button>
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
