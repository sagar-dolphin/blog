<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ForgotPassword</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-10">
        <div class="row">
            <main class="login-form">
                <div class="cotainer">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @if (Session::has('message'))
                                       <div class="alert alert-success" role="alert">
                                          {{ Session::get('message') }}
                                      </div>
                                  @endif
                            <div class="card mt-2">
                                <div class="card-header">Reset Password</div>
                                <div class="card-body">
                
                                    <form action="{{ route('forget.password.post') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="email_address" value="{{old('email')}}"ass="form-control" name="email" autofocus><br>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary m-2 resetPassBtn">
                                                Send Password Reset Link
                                            </button>
                                        </div>
                                    </form>
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </main>  
        </div>
    </div>

        
</body>
</html>
