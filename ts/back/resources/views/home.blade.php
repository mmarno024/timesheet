<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('public/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
</head>
<body class="bg-info"
    style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('daftar_timesheet') }}" class="">Timesheet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('report') }}">Report</a>
                    </li>
                </ul>
                <ul class="d-flex  me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-inverse rounded-0 text-danger">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="col-sm-12 mt-3 p-0">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5>Dashboard Timesheet</h5>
                </div>
                <div class="card-body" style="background-image: url('public/assets/images/apixxx.png');background-repeat: no-repeat;background-position: right top;">
                    <h5>Selamat datang user {{ Auth::user()->name }}</h5>
                    <hr />
                    <p style="margin-bottom:20px;">
                        <span class="" style="color: red"><i>Silahkan ganti password lama jika diperlukan</i></span>
                    </p>
                    <div class="col-lg-12 col-12" style="margin-bottom: 20px;">
                        <div class="col-lg-4 col-4" style="margin-bottom:10px;float:left;">
                            <input type="text" class="form-control input-xs" name="old_password" placeholder="Password Lama">
                        </div>
                        <div class="col-lg-4 col-4" style="margin-bottom:10px;float:left;">
                            <input type="text" class="form-control input-xs" name="new_password1" placeholder="Password Baru">
                        </div>
                        <div class="col-lg-4 col-4" style="margin-bottom:10px;float:left;">
                            <input type="text" class="form-control input-xs" name="new_password2" placeholder="Konfirmasi Password Baru">
                        </div>
                        <div class="col-lg-3 col-3" style="margin-bottom:10px;">
                            <button type="submit" class="btn btn-block btn-primary">Update Password</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <b>Panduan penggunaan :</b>
                            <p style="margin-top:20px;">
                                User dapat memilih dalam mengisi timesheet
                                <li>Mengisi langsung pada sistem (isi data & unggah foto progres langsung pada sistem) </li>
                                <li>Mengisi manual pada form hardcopy lalu di scan & diunggah kedalam sistem (unggah scan timesheet & foto progres pada sistem) </li>
                            </p>
                            <b>Download Form Timesheet :</b>
                            <p style="margin-top:20px;">
                                <div class="col-lg-3 col-6 text-center" style="float: left;">
                                    <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                    <p>Form Tugas Luar Kota</p>
                                    <a style="text-decoration:none" href="{{url('download2')}}">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download File</button>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 text-center" style="float: left;">
                                    <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                    <p>Form Instalasi/Pemasangan Alat</p>
                                    <a style="text-decoration:none" href="{{url('download3')}}">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download File</button>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 text-center" style="float: left;">
                                    <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                    <p>Form Service/Maintenance Alat</p>
                                    <a style="text-decoration:none" href="{{url('download4')}}">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download File</button>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 text-center" style="float: left;">
                                    <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                    <p>Form Checklist Instalasi/Service</p>
                                    <a style="text-decoration:none" href="{{url('download1')}}">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download File</button>
                                    </a>
                                </div>
                                {{-- <p></p>
                                <a style="text-decoration:none" href="{{url('download2')}}">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download Form Tugas Luar Kota</button>
                                </a>
                                <a style="text-decoration:none" href="{{url('download3')}}">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download Form Instalasi</button>
                                </a>
                                <a style="text-decoration:none" href="{{url('download4')}}">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download Form Service/Maintenance</button>
                                </a>
                                <a style="text-decoration:none" href="{{url('download1')}}">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download Form Checklist Pemasangan</button>
                                </a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
