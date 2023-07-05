<!DOCTYPE html>
<html lang="en">
<style>
    .h9 {
        font-size: 10px;
    }

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body class="bg-info"
    style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="text-center">Login</h5>
                    <h6 class="text-muted text-center">Form Timesheet</h6>
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                                Something it's wrong:
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success rounded-0">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger rounded-0">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for=""><strong>Email</strong></label>
                            <input type="text" name="email" class="form-control rounded-0" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control rounded-0"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block rounded-0">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
