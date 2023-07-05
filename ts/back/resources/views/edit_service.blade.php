<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="bg-info" style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('daftar_instalasi') }}" class>Instalasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" class>Service</a>
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
        <div class="col-sm-12 mt-3 mb-5 p-0">
            <div class="card-deck">
                <div class="card rounded-0">
                    <div class="card-header text-left">
                        <h5>Form Edit Service</h5>
                    </div>
                    <form action="{{ route('update_service') }}" method="post">
                        @csrf
                        <div class="card-body text-left" style="font-size:14px;">
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: bold;">
                                    <tr>
                                        <td width="25%" align="center" rowspan="4" style="vertical-align:middle;padding:0;margin:0;">
                                            <img src="{{url('public/assets/images/logo.png')}}">
                                        </td>
                                        <td width="40%" rowspan="2" align="center" style="vertical-align:middle;padding:0;margin:0;background:#0cb235;">
                                            Time Sheet
                                        </td>
                                        <td width="35%" style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="30%" style="margin:0;padding:0;border:none;">Nomor</td>
                                                    <td width="5%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="65%" style="margin:0;padding:0;border:none;">FM.RD-03-149/00</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="30%" style="margin:0;padding:0;border:none;">Revisi</td>
                                                    <td width="5%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="65%" style="margin:0;padding:0;border:none;">00</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" align="center" style="vertical-align:middle;padding:0;margin:0;">
                                            Service
                                        </td>
                                        <td style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="30%" style="margin:0;padding:0;border:none;">Tanggal</td>
                                                    <td width="5%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="65%" style="margin:0;padding:0;border:none;">1 November 2018</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="30%" style="margin:0;padding:0;border:none;">Halaman</td>
                                                    <td width="5%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="65%" style="margin:0;padding:0;border:none;">1 dari 1</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="id" id="id" value="{{ $dataTs->id }}">
                            <table width="100%" style="font-weight: bold;">
                                <tr>
                                    <td align="right" style="margin:0;padding:0;border:none;">
                                        Tanggal : <input type="date" name="tanggal_ts" id="tanggal_ts" style="border:none" value="{{ $dataTs->tanggal_ts}}" placeholder="........................................................." >
                                    </td>
                                </tr>
                            </table>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="50%" align="center"style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="12%" style="margin:0;padding:0;border:none;">Konsumen</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="36%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="konsumen" id="konsumen" style="border:none" value="{{ $dataTs->rel_d_service[0]->konsumen}}" placeholder=".........................................................................." >
                                                    </td>
                                                    <td rowspan="5" width="50%" style="margin:0;padding:0;border:none;">
                                                        <table width="100%" class="table table-bordered" style="margin:0;padding:0;">
                                                            <tr>
                                                                <td colspan="2" align="center" style="margin:0;padding:0;">Action</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="call" name="call" value="call" {{ $dataTs->rel_d_service_action[0]->call == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Call</label>
                                                                    </div>
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="delivery" name="delivery" value="delivery" {{ $dataTs->rel_d_service_action[0]->delivery == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Delivery</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="warranty" name="warranty" value="warranty" {{ $dataTs->rel_d_service_action[0]->warranty == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Warranty</label>
                                                                    </div>
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="demo" name="demo" value="demo" {{ $dataTs->rel_d_service_action[0]->demo == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Demo</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance" value="maintenance" {{ $dataTs->rel_d_service_action[0]->maintenance == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Maintenance</label>
                                                                    </div>
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="spare_part" name="spare_part" value="spare_part" {{ $dataTs->rel_d_service_action[0]->spare_part == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Spare-part</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="installation" name="installation" value="installation" {{ $dataTs->rel_d_service_action[0]->installation == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Installation</label>
                                                                    </div>
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="repeat_service" name="repeat_service" value="repeat_service" {{ $dataTs->rel_d_service_action[0]->repeat_service == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Repeat Service</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="training" name="training" value="training" {{ $dataTs->rel_d_service_action[0]->training == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Training</label>
                                                                    </div>
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="routine_check" name="routine_check" value="routine_check" {{ $dataTs->rel_d_service_action[0]->routine_check == "yes" ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Routine Check</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;border:none;">Lokasi/Pos</td>
                                                    <td style="margin:0;padding:0;border:none;">:</td>
                                                    <td style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="lokasi_pos" id="lokasi_pos" style="border:none" value="{{ $dataTs->rel_d_service[0]->lokasi_pos}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;border:none;">Alamat</td>
                                                    <td style="margin:0;padding:0;border:none;">:</td>
                                                    <td style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="alamat" id="alamat" style="border:none" value="{{ $dataTs->rel_d_service[0]->alamat}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;border:none;">Nama Alat</td>
                                                    <td style="margin:0;padding:0;border:none;">:</td>
                                                    <td style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="nama_alat" id="nama_alat" style="border:none" value="{{ $dataTs->rel_d_service[0]->nama_alat}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;border:none;">Serial No.</td>
                                                    <td style="margin:0;padding:0;border:none;">:</td>
                                                    <td style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="serial_no" id="serial_no" style="border:none" value="{{ $dataTs->rel_d_service[0]->serial_no}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="10%" style="margin:0;padding:0;border:none;">Problem : </td>
                                        <td width="90%" style="margin:0;padding:0;border:none;">
                                            1. <input type="text" class="col-11" name="problem1" id="problem1" style="border:none" value="{{ $dataTs->rel_d_service_problem[0]->problem1}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            2. <input type="text" class="col-11" name="problem2" id="problem2" style="border:none" value="{{ $dataTs->rel_d_service_problem[0]->problem2}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            3. <input type="text" class="col-11" name="problem3" id="problem3" style="border:none" value="{{ $dataTs->rel_d_service_problem[0]->problem3}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td colspan="3" style="margin:0;padding:0;font-weight:bold;">Kategori :</td>
                                    </tr>
                                    <tr>
                                        <td width="33%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="mekanikal" name="mekanikal" value="mekanikal" {{ $dataTs->rel_d_service_kategori[0]->mekanikal == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Mekanikal</label>
                                            </div>
                                        </td>
                                        <td width="33%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="power_supplay" name="power_supplay" value="power_supplay" {{ $dataTs->rel_d_service_kategori[0]->power_supplay == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Power Supplay</label>
                                            </div>
                                        </td>
                                        <td width="34%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="accessories" name="accessories" value="accessories" {{ $dataTs->rel_d_service_kategori[0]->accessories == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Accessories</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="elektrikal" name="elektrikal" value="elektrikal" {{ $dataTs->rel_d_service_kategori[0]->elektrikal == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Electrikal</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="logger" name="logger" value="logger" {{ $dataTs->rel_d_service_kategori[0]->logger == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Logger</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="human_error" name="human_error" value="human_error" {{ $dataTs->rel_d_service_kategori[0]->human_error == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Human Error</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sensor" name="sensor" value="sensor" {{ $dataTs->rel_d_service_kategori[0]->sensor == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Sensor</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="kelengkapan" name="kelengkapan" value="kelengkapan" {{ $dataTs->rel_d_service_kategori[0]->kelengkapan == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Kelengkapan</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            Other : <input type="text" name="other" id="other" class="col-10" style="border:none" value="{{ $dataTs->rel_d_service_kategori[0]->other }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="software" name="software" value="software" {{ $dataTs->rel_d_service_kategori[0]->software == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Software</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="modem" name="modem" value="modem" {{ $dataTs->rel_d_service_kategori[0]->modem == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Modem</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td colspan="3" style="margin:0;padding:0;font-weight:bold;">Yang Dikerjakan :</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ganti_part_modul" name="ganti_part_modul" value="ganti_part_modul" {{ $dataTs->rel_d_service_pekerjaan[0]->ganti_part_modul == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Penggantian part atau modul</label>
                                            </div>
                                        </td>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="installasi" name="installasi" value="installasi" {{ $dataTs->rel_d_service_pekerjaan[0]->installasi == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Instalasi, pemeriksaan dan running test</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="setting_kalibrasi" name="setting_kalibrasi" value="setting_kalibrasi" {{ $dataTs->rel_d_service_pekerjaan[0]->setting_kalibrasi == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Penyettingan dan kalibrasi parameter</label>
                                            </div>
                                        </td>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="training" name="training" value="training" {{ $dataTs->rel_d_service_pekerjaan[0]->training == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Training</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="modification_upgrade" name="modification_upgrade" value="modification_upgrade" {{ $dataTs->rel_d_service_pekerjaan[0]->modification_upgrade == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Modification dan upgrade perangkat keras dan lunak</label>
                                            </div>
                                        </td>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="pengiriman" name="pengiriman" value="pengiriman" {{ $dataTs->rel_d_service_pekerjaan[0]->pengiriman == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Pengiriman, demonstration dan pembuatan sample</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance" value="maintenance" {{ $dataTs->rel_d_service_pekerjaan[0]->maintenance == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Rutin dan permintaan preventive maintenance, overhaul</label>
                                            </div>
                                        </td>
                                        <td width="50%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="observasi" name="observasi" value="observasi" {{ $dataTs->rel_d_service_pekerjaan[0]->observasi == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Observasi, monitor dan testing</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="15%" style="margin:0;padding:0;border:none;">Hasil Investigasi : </td>
                                        <td width="85%" style="margin:0;padding:0;border:none;">
                                            1. <input type="text" class="col-11" name="investigasi1" id="investigasi1" style="border:none" value="{{ $dataTs->rel_d_service_investigasi[0]->investigasi1}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            2. <input type="text" class="col-11" name="investigasi2" id="investigasi2" style="border:none" value="{{ $dataTs->rel_d_service_investigasi[0]->investigasi2}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            3. <input type="text" class="col-11" name="investigasi3" id="investigasi3" style="border:none" value="{{ $dataTs->rel_d_service_investigasi[0]->investigasi3}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" style="font-weight: normal;border:none">
                                    <tr>
                                        <td width="60%" style="margin:0;padding:0;border:none;vertical-align:top">
                                            <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                                <tr>
                                                    <td style="margin:0;padding:5px;">
                                                        <b>Spare Part :</b>
                                                        <table width="100%" class="table table-bordered" style="margin:0;padding:0;font-weight: normal;">
                                                            <tr>
                                                                <td width="25%" align="center" style="margin:0;padding:0;">Part Number</td>
                                                                <td width="25%" align="center" style="margin:0;padding:0;">Spare Part</td>
                                                                <td width="10%" align="center" style="margin:0;padding:0;">Qty</td>
                                                                <td width="10%" align="center" style="margin:0;padding:0;">SF</td>
                                                                <td width="30%" align="center" style="margin:0;padding:0;">S/N</td>
                                                            </tr>
                                                            @foreach ($dataTs->rel_d_service_spare_part as $key => $value)
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$key}}][part_number]" id="value[{{$key}}][part_number]" style="border:none" value="{{ $value->part_number}}">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$key}}][spare_part]" id="value[{{$key}}][spare_part]" style="border:none" value="{{ $value->spare_part}}">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="number" class="col-11" name="value[{{$key}}][qty]" id="value[{{$key}}][qty]" style="border:none" value="{{ $value->qty}}">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$key}}][sf]" id="value[{{$key}}][sf]" style="border:none" value="{{ $value->sf}}">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$key}}][sn]" id="value[{{$key}}][sn]" style="border:none" value="{{ $value->sn}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @for ($i = $count_x; $i <= 5; $i++)
                                                            <tr>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$i}}][part_number]" id="value[{{$i}}][part_number]" style="border:none">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$i}}][spare_part]" id="value[{{$i}}][spare_part]" style="border:none">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="number" class="col-11" name="value[{{$i}}][qty]" id="value[{{$i}}][qty]" style="border:none">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$i}}][sf]" id="value[{{$i}}][sf]" style="border:none">
                                                                </td>
                                                                <td style="margin:0;padding:0;">
                                                                    <input type="text" class="col-11" name="value[{{$i}}][sn]" id="value[{{$i}}][sn]" style="border:none">
                                                                </td>
                                                            </tr>
                                                            @endfor
                                                        </table>
                                                        <table width="100%" style="margin:0;padding:0;font-weight: normal;border:none;">
                                                            <tr>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">Stock From (SF) :</td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="main_store" name="main_store" value="main_store" {{ $dataTs->rel_d_service_stock_from[0]->main_store == 'main_store' ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Main Store</label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="logistik" name="logistik" value="logistik" {{ $dataTs->rel_d_service_stock_from[0]->logistik == 'logistik' ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Logistik</label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="customer" name="customer" value="customer" {{ $dataTs->rel_d_service_stock_from[0]->customer == 'customer' ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Customer</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                                <tr>
                                                    <td width="20%" align="center" style="margin:0;padding:0;">&nbsp;</td>
                                                    <td width="30%" align="center" style="margin:0;padding:0;">Time</td>
                                                    <td width="25%" align="center" style="margin:0;padding:0;">Ttd PPIC</td>
                                                    <td width="25%" align="center" style="margin:0;padding:0;">Pemeriksa</td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">Start work</td>
                                                    <td style="margin:0;padding:0;">
                                                        <input type="date" name="foot_mulai" id="foot_mulai" class="col-11" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_mulai}}">
                                                    </td>
                                                    <td rowspan="2" style="margin:0;padding:0;">
                                                        <input type="text" name="foot_ppic" id="foot_ppic" class="col-11" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_ppic}}">
                                                    </td>
                                                    <td rowspan="2" style="margin:0;padding:0;">
                                                        <input type="text" name="foot_pemeriksa" id="foot_pemeriksa" class="col-11" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_pemeriksa}}">    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">Finish work</td>
                                                    <td style="margin:0;padding:0;">
                                                        <input type="date" name="foot_selesai" id="foot_selesai" class="col-11" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_selesai}}">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="2%" style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td width="38%" style="margin:0;padding:0;border:none;vertical-align:top">
                                            <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                                <tr>
                                                    <td style="margin:0;padding:5px;">
                                                        <p>Saya yang bertandatangan :</p>
                                                        <table width="100%" style="margin:0;padding:0;font-weight: normal;border:none;">
                                                            <tr>
                                                                <td width="19%" style="margin:0;padding:0;border:none;">Nama</td>
                                                                <td width="1%" style="margin:0;padding:0;border:none;">:</td>
                                                                <td width="80%" style="margin:0;padding:0;border:none;">
                                                                    <input type="text" class="col-11" name="foot_nama_customer" id="foot_nama_customer" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_nama_customer}}" placeholder="..........................................................................">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="19%" style="margin:0;padding:0;border:none;">Jabatan</td>
                                                                <td width="1%" style="margin:0;padding:0;border:none;">:</td>
                                                                <td width="80%" style="margin:0;padding:0;border:none;">
                                                                    <input type="text" class="col-11" name="foot_jabatan_customer" id="foot_jabatan_customer" style="border:none" value="{{ $dataTs->rel_d_service[0]->foot_jabatan_customer}}" placeholder="..........................................................................">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" style="margin:0;padding:0;font-weight: normal;border:none;">
                                                            <tr>
                                                                <td align="center" style="margin:0;padding:0;border:none;">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="margin:0;padding:0;border-bottom:1px solid #ccc;;">Tanda tangan & Cap customer</td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" style="margin:0;padding:0;font-weight: normal;border:none;">
                                                            <tr>
                                                                <td colspan="4" align="center" style="margin:0;padding:0;border:none;">Kualitas kerjaan :</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Excellent" value="Excellent" {{ $dataTs->rel_d_service[0]->foot_kualitas_pekerjaan == 'Excellent' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="Excellent">Excellent</label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Good" value="Good" {{ $dataTs->rel_d_service[0]->foot_kualitas_pekerjaan == 'Good' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="Good">Good</label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Rata-rata" value="Rata-rata" {{ $dataTs->rel_d_service[0]->foot_kualitas_pekerjaan == 'Rata-rata' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="Rata-rata">Rata-rata</label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%" style="margin:0;padding:0;border:none;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Buruk" value="Buruk" {{ $dataTs->rel_d_service[0]->foot_kualitas_pekerjaan == 'Buruk' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="Buruk">Buruk</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="10%" style="margin:0;padding:0;border:none;">Note : </td>
                                        <td width="90%" style="margin:0;padding:0;border:none;">
                                            1. <input type="text" class="col-11" name="note1" id="note1" style="border:none" value="{{ $dataTs->rel_d_service_note[0]->note1}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            2. <input type="text" class="col-11" name="note2" id="note2" style="border:none" value="{{ $dataTs->rel_d_service_note[0]->note2}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            3. <input type="text" class="col-11" name="note3" id="note3" style="border:none" value="{{ $dataTs->rel_d_service_note[0]->note3}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block rounded-0">Update form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $("#addIpRow").click(function() {
        var html_ip = '';
        html_ip += '<div id="ipRow">';
        html_ip += '<div class="input-group input-group-sm col-sm-6 p-0 mb-1">';
        html_ip +=
            '<input type="text" name="ip_address[]" id="ip_address" class="form-control rounded-0 m-input" placeholder="Masukkan IP Address" autocomplete="off">';
        html_ip += '<div class="input-group-append">';
        html_ip +=
            '<button id="removeIpRow" type="button" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash-o"></i></button>';
        html_ip += '</div>';
        html_ip += '</div>';
        $('#newIpRow').append(html_ip);
    });
    $(document).on('click', '#removeIpRow', function() {
        $(this).closest('#ipRow').remove();
    });
</script>
</html>
