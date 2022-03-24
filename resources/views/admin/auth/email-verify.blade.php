<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Email Verification</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard Form</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        
            <section class="content">
                <div class="container-fluid">
                    <!-- /.card -->
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Email Verification:</h5>
                        <p>
                            Before proceeding, please check your email for a verification link. If you did not receive the email,
                        </p>
                        {{-- <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info">
                                click here to request another
                            </button>.
                        </form> --}}
                    </div>
                </div><!-- /.container-fluid -->
        
            </section>
        </div>
    </div>
</body>
</html>