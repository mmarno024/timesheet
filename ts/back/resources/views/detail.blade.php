<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
</head>

<body class="bg-info"
    style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}" class>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Report</a>
                    </li>
                </ul>
                <ul class="d-flex  me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-inverse rounded-0 text-danger">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="col-sm-12 mt-3 mb-5 p-0">
            <div class="card-deck">
                <div class="card rounded-0">
                    <div class="card-header text-left">
                        <h5>Detail User {{ $dataUser->rel_is[0]->nm_instansi }}</h5>
                    </div>
                    <div class="card-body text-left"
                        style="background-image: url('public/assets/images/report.png');background-repeat: no-repeat;background-position: right top;">
                        <a href="{{ route('report') }}" class="btn btn-sm btn-primary rounded-0">Back to report</a>
                        <p>
                        <table class="table table-bordered table-sm" style="font-size:14px;">
                            <tbody>
                                <tr>
                                    <td width="14%">User</td>
                                    <td width="3%" style="text-align:center">:</td>
                                    <td width="83%">{{ $dataUser->user }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td style="text-align:center">:</td>
                                    <td>{{ $dataUser->name }}</td>
                                </tr>
                                <tr>
                                    <td>Instansi</td>
                                    <td style="text-align:center">:</td>
                                    <td>
                                        @foreach ($dataUser->rel_is as $k1 => $v1)
                                            <p>{{ $v1->id_instansi }} - {{ $v1->rel_id_instansi[0]->nm_instansi }}
                                            </p>
                                        @endforeach
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>Email</td>
                                    <td style="text-align:center">:</td>
                                    <td>{{ $dataUser->email == null || $dataUser->email == '' ? 'email is not found' : $dataUser->email }}
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>Token</td>
                                    <td style="text-align:center">:</td>
                                    <td>{{ $dataUser->token }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td style="text-align:center">:</td>
                                    <td>{{ $dataUser->status }}</td>
                                </tr>
                                <tr>
                                    <td>Expired Date</td>
                                    <td style="text-align:center">:</td>
                                    <td>{{ $dataUser->expired_date }}</td>
                                </tr>
                                <tr>
                                    <td>IP Address</td>
                                    <td style="text-align:center">:</td>
                                    <td>
                                        @foreach ($dataUser->rel_ip as $k1 => $v1)
                                            {{ $v1->ip_address }},&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hardware</td>
                                    <td style="text-align:center">:</td>
                                    <td>
                                        @foreach ($dataUser->rel_hw as $k1 => $v1)
                                            {{ $v1->hardware }},&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <b>Parameter :</b>
                        <p>
                            @foreach ($dataUser->rel_hw as $k1 => $v1)
                                <p><b>{{ $k1 + 1 }}.</b>
                                    <i>http://43.252.105.147/api/data?pt</i>={{ $dataUser->user_code }}<i>&dev</i>={{ $v1->hardware }}
                                </p>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
