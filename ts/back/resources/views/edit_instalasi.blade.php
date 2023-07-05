<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instalasi</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ url('public/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
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
                        <a class="nav-link" href="{{ url('daftar_service') }}" class>Service</a>
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
                        <h5>Form Edit Instalasi</h5>
                    </div>
                    <form action="{{ route('update_instalasi') }}" method="post" enctype="multipart/form-data">
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
                                                    <td width="65%" style="margin:0;padding:0;border:none;">FM.RD-03-148/00</td>
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
                                            Instalasi / Pemasangan
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
                                    <td width="70%" style="margin:0;padding:0;border:none;">*Formulir diisikan dilapangan saat pemasangan</td>
                                    <td width="30%" align="right" style="margin:0;padding:0;border:none;">
                                        Tanggal : <input type="date" name="tanggal_ts" id="tanggal_ts" style="border:none" value="{{ $dataTs->tanggal_ts }}" placeholder="........................................................." >
                                    </td>
                                </tr>
                            </table>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="50%" align="center"style="vertical-align:middle;padding:0;margin:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Konsumen</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="konsumen" id="konsumen" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->konsumen}}" placeholder=".........................................................................." >
                                                    </td>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Nama Alat</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="nama_alat" id="nama_alat" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->nama_alat}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Nama Pos</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="nama_pos" id="nama_pos" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->nama_pos}}" placeholder=".........................................................................." >
                                                    </td>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">No. HP Pos</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="no_hp_pos" id="no_hp_pos" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->no_hp_pos}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Kabupaten</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="kabupaten" id="kabupaten" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->kabupaten}}" placeholder=".........................................................................." >
                                                    </td>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Kecamatan</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="kecamatan" id="kecamatan" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->kecamatan}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Latitude</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="latitude" id="latitude" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->latitude}}" placeholder=".........................................................................." >
                                                    </td>
                                                    <td width="16%" style="margin:0;padding:0;border:none;">Longitude</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="32%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="longitude" id="longitude" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->longitude}}" placeholder=".........................................................................." >
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
                                        <td align="center" colspan="6" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">
                                            Setup Alat : (Sertakan informasi di sebelah ceklist,seperti SN)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="solar_panel" name="solar_panel" value="solar_panel" {{ $dataTs->rel_d_instalasi_setup_setting[0]->solar_panel == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Solar Panel</label>
                                            </div>
                                        </td>
                                        <td width="18%" style="margin:0;padding:0;">
                                            <input type="text" name="solar_panel_note" id="solar_panel_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->solar_panel_note}}">
                                        </td>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="accu" name="accu" value="accu" {{ $dataTs->rel_d_instalasi_setup_setting[0]->accu == "yes" ? 'checked' : '' }}>
                                                <label class="form-check-label">Accu</label>
                                            </div>
                                        <td width="18%" style="margin:0;padding:0;">
                                            <input type="text" name="acuu_note" id="acuu_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->acuu_note}}">
                                        </td>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="solar_charge" name="solar_charge" value="solar_charge" {{ $dataTs->rel_d_instalasi_setup_setting[0]->solar_charge == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Solar Charge</label>
                                            </div>
                                        <td width="19%" style="margin:0;padding:0;">
                                            <input type="text" name="solar_charge_note" id="solar_charge_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->solar_charge_note}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="box_panel" name="box_panel" value="box_panel" {{ $dataTs->rel_d_instalasi_setup_setting[0]->box_panel == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Box Panel</label>
                                            </div>
                                        </td>
                                        <td width="18%" style="margin:0;padding:0;">
                                            <input type="text" name="box_panel_note" id="box_panel_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->box_panel_note}}">
                                        </td>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="logger" name="logger" value="logger" {{ $dataTs->rel_d_instalasi_setup_setting[0]->logger == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Logger</label>
                                            </div>
                                        <td width="18%" style="margin:0;padding:0;">
                                            <input type="text" name="logger_note" id="logger_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->logger_note}}">
                                        </td>
                                        <td width="15%" style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gsm_modem" name="gsm_modem" value="gsm_modem" {{ $dataTs->rel_d_instalasi_setup_setting[0]->gsm_modem == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">GSM Modem</label>
                                            </div>
                                        <td width="19%" style="margin:0;padding:0;">
                                            <input type="text" name="gsm_modem_note" id="gsm_modem_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->gsm_modem_note}}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="20%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">Setting Logger</td>
                                        <td width="20%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">Keterangan</td>
                                        <td width="20%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">Setting GSM Modem</td>
                                        <td width="20%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">Keterangan</td>
                                        <td width="20%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">NO USER</td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="interval_simpan" name="interval_simpan" value="interval_simpan" {{ $dataTs->rel_d_instalasi_setup_setting[0]->interval_simpan == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Interval Simpan</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_simpan_note" id="interval_simpan_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->interval_simpan_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sms_server" name="sms_server" value="sms_server" {{ $dataTs->rel_d_instalasi_setup_setting[0]->sms_server == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">SMS Server</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="sms_server_note" id="sms_server_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->sms_server_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            1. <input type="text" name="no_user1" id="no_user1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->no_user1}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="kalibrasi_resolusi" name="kalibrasi_resolusi" value="kalibrasi_resolusi" {{ $dataTs->rel_d_instalasi_setup_setting[0]->kalibrasi_resolusi == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Kalibrasi/Resolusi</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="kalibrasi_resolusi_note" id="kalibrasi_resolusi_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->kalibrasi_resolusi_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="web_server" name="web_server" value="web_server" {{ $dataTs->rel_d_instalasi_setup_setting[0]->web_server == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Web Server</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="web_server_note" id="web_server_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->web_server_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            2. <input type="text" name="no_user2" id="no_user2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->no_user2}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="level_awal" name="level_awal" value="level_awal" {{ $dataTs->rel_d_instalasi_setup_setting[0]->level_awal == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Level Awal</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="level_awal_note" id="level_awal_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->level_awal_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="mail_server" name="mail_server" value="mail_server" {{ $dataTs->rel_d_instalasi_setup_setting[0]->mail_server == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Mail Server</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="mail_server_note" id="mail_server_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->mail_server_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            3. <input type="text" name="no_user3" id="no_user3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->no_user3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="aktivasi_alarm" name="aktivasi_alarm" value="aktivasi_alarm" {{ $dataTs->rel_d_instalasi_setup_setting[0]->aktivasi_alarm == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Aktifasi Alarm</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="aktivasi_alarm_note" id="aktivasi_alarm_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->aktivasi_alarm_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="jwt_ftp_http_server" name="jwt_ftp_http_server" value="jwt_ftp_http_server" {{ $dataTs->rel_d_instalasi_setup_setting[0]->jwt_ftp_http_server == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">JWT/FTP/HTTP Server</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="jwt_ftp_http_server_note" id="jwt_ftp_http_server_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->jwt_ftp_http_server_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            4. <input type="text" name="no_user4" id="no_user4" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->no_user4}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="cek_pembacaan" name="cek_pembacaan" value="cek_pembacaan" {{ $dataTs->rel_d_instalasi_setup_setting[0]->cek_pembacaan == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Cek Pembacaan</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="cek_pembacaan_note" id="cek_pembacaan_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->cek_pembacaan_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="capture_mms" name="capture_mms" value="capture_mms" {{ $dataTs->rel_d_instalasi_setup_setting[0]->capture_mms == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Capture & MMS</label>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="capture_mms_note" id="capture_mms_note" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->capture_mms_note}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            5. <input type="text" name="no_user5" id="no_user5" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_setup_setting[0]->no_user5}}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">&nbsp;</td>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">SERVER 1</td>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">SERVER 2</td>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">SERVER 3</td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Status Setup Server</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_setup_server1" id="status_setup_server1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_setup_server1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_setup_server2" id="status_setup_server2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_setup_server2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_setup_server3" id="status_setup_server3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_setup_server3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Address</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="address1" id="address1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->address1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="address2" id="address2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->address2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="address3" id="address3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->address3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Username</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="username1" id="username1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->username1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="username2" id="username2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->username2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="username3" id="username3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->username3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Password</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="password1" id="password1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->password1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="password2" id="password2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->password2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="password3" id="password3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->password3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Interval Data</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_data1" id="interval_data1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_data1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_data2" id="interval_data2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_data2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_data3" id="interval_data3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_data3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Status Photo Web</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_photo_web1" id="status_photo_web1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_photo_web1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_photo_web2" id="status_photo_web2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_photo_web2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="status_photo_web3" id="status_photo_web3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->status_photo_web3}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Iinterval Photo</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_photo1" id="interval_photo1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_photo1}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_photo2" id="interval_photo2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_photo2}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="interval_photo3" id="interval_photo3" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi_sending[0]->interval_photo3}}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td width="10%" style="margin:0;padding:0;border:none;">Keterangan : </td>
                                        <td width="90%" style="margin:0;padding:0;border:none;">
                                            <textarea class="form-control" name="note1" id="tinymce" style="border-radius: 0;">{{ $dataTs->rel_d_instalasi_note[0]->note1}}</textarea>
                                        </td>
                                        {{-- <td width="10%" style="margin:0;padding:0;border:none;">Keterangan : </td>
                                        <td width="90%" style="margin:0;padding:0;border:none;">
                                            1. <input type="text" class="col-11" name="note1" id="note1" style="border:none" value="{{ $dataTs->rel_d_instalasi_note[0]->note1}}" placeholder=".........................................................................." >
                                        </td> --}}
                                    </tr>
                                    {{-- <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            2. <input type="text" class="col-11" name="note2" id="note2" style="border:none" value="{{ $dataTs->rel_d_instalasi_note[0]->note2}}" placeholder=".........................................................................." >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;border:none;">&nbsp;</td>
                                        <td style="margin:0;padding:0;border:none;">
                                            3. <input type="text" class="col-11" name="note3" id="note3" style="border:none" value="{{ $dataTs->rel_d_instalasi_note[0]->note3}}" placeholder=".........................................................................." >
                                        </td> --}}
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;">
                                    <tr>
                                        <td colspan="5" width="5%" align="center" style="margin:0;padding:0;font-weight:bold;background:#aaaeab">
                                            SENSOR/PERALATAN KLIMATOLOGI YANG AKAN DIPASANG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="5%" align="center" style="margin:0;padding:0;font-weight:bold;">No</td>
                                        <td width="15%" align="center" style="margin:0;padding:0;font-weight:bold;">Nama</td>
                                        <td width="10%" align="center" style="margin:0;padding:0;font-weight:bold;">SN</td>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;">Spek/Rentang Ukur</td>
                                        <td width="25%" align="center" style="margin:0;padding:0;font-weight:bold;">Nilai Kalibrasi</td>
                                    </tr>
                                    @foreach ($dataTs->rel_d_instalasi_sensor_pasang as $key => $value)
                                    <tr>
                                        <td align="center" style="margin:0;padding:0;">{{$key+1}}</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$key}}][nama]" id="value[{{$key}}][nama]" class="col-11" style="border:none" 
                                            value="{{$value->nama}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$key}}][sn]" id="value[{{$key}}][sn]" class="col-11" style="border:none" value="{{$value->sn}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$key}}][spek_rentang_ukur]" id="value[{{$key}}][spek_rentang_ukur]" class="col-11" style="border:none" value="{{$value->spek_rentang_ukur}}">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$key}}][nilai_kalibrasi]" id="value[{{$key}}][nilai_kalibrasi]" class="col-11" style="border:none" value="{{$value->nilai_kalibrasi}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @for ($i = $count_x; $i <= 12; $i++)
                                    <tr>
                                        <td align="center" style="margin:0;padding:0;">{{$i}}</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$i}}][nama]" id="value[{{$i}}][nama]" class="col-11" style="border:none">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$i}}][sn]" id="value[{{$i}}][sn]" class="col-11" style="border:none">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$i}}][spek_rentang_ukur]" id="value[{{$i}}][spek_rentang_ukur]" class="col-11" style="border:none">
                                        </td>
                                        <td style="margin:0;padding:0;">
                                            <input type="text" name="value[{{$i}}][nilai_kalibrasi]" id="value[{{$i}}][nilai_kalibrasi]" class="col-11" style="border:none">
                                        </td>
                                    </tr>
                                    @endfor
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" style="font-weight: normal;">
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;">NB :</td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">1.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Pastikan tutup sensor terbuka
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">2.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Pastikan konektor antena tidak short, arah antena menuju ke BTS terdekat (OpenSignal.app)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">3.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Tegangan yang digunakan untuk panjang kabel diatas 10 meter menggunakan 24V (Sensor arus 4mA-20mA), dibawah 10 meter menggunakan 12V (Sensor arus 4mA-20mA)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">4.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Koordinat sebaiknya disetting menggunakan SMS, untuk memastikan koordinat dengan benar
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">5.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Interval waktu data Logger dan GSM harus sama
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">6.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Data yang paling valid diambil dari Logger langsung atau email
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="4%" align="center" style="margin:0;padding:0;"></td>
                                        <td width="2%" align="center" style="margin:0;padding:0;">7.</td>
                                        <td width="94%" style="margin:0;padding:0;">
                                            Diharuskan menyertakan foto kegiatan dari 0%, 50%, 75% dan 100% baik hard maupun soft file
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered" style="font-weight: normal;margin:0;padding:0">
                                    <tr>
                                        <td width="16%" align="center" style="margin:0;padding:0;background:#aaaeab">&nbsp;</td>
                                        <td width="28%" align="center" style="margin:0;padding:0;background:#aaaeab">Time</td>
                                        <td width="28%" align="center" style="margin:0;padding:0;background:#aaaeab">Teknisi 1</td>
                                        <td width="28%" align="center" style="margin:0;padding:0;background:#aaaeab">Teknisi 2</td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Start work</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="date" name="foot_mulai" id="foot_mulai" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_mulai}}">
                                        </td>
                                        <td rowspan="2" style="margin:0;padding:0;">
                                            <input type="text" name="foot_teknisi1" id="foot_teknisi1" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_teknisi1}}">
                                        </td>
                                        <td rowspan="2" style="margin:0;padding:0;">
                                            <input type="text" name="foot_teknisi2" id="foot_teknisi2" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_teknisi2}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:0;">Finish work</td>
                                        <td style="margin:0;padding:0;">
                                            <input type="date" name="foot_selesai" id="foot_selesai" class="col-11" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_selesai}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="margin:0;padding:0;">
                                            <table width="100%" style="margin:0;padding:0;border:none;">
                                                <tr>
                                                    <td colspan="3" width="16%" style="margin:0;padding:0;border:none;">Saya yang bertandatangan :</td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="margin:0;padding:0;border:none;">Instansi</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="78%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="foot_instansi_customer" id="foot_instansi_customer" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_instansi_customer}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="margin:0;padding:0;border:none;">Nama</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="78%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="foot_nama_customer" id="foot_nama_customer" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_nama_customer}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="margin:0;padding:0;border:none;">Jabatan</td>
                                                    <td width="2%" style="margin:0;padding:0;border:none;">:</td>
                                                    <td width="78%" style="margin:0;padding:0;border:none;">
                                                        <input type="text" class="col-11" name="foot_jabatan_customer" id="foot_jabatan_customer" style="border:none" value="{{ $dataTs->rel_d_instalasi[0]->foot_jabatan_customer}}" placeholder=".........................................................................." >
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="center" style="margin:0;padding:0;">Tanda tangan</td>
                                        <td style="margin:0;padding:0;">
                                            <table width="100%" class="table table-bordered" style="margin:0;padding:0;">
                                                <tr>
                                                    <td align="center" style="margin:0;padding:0;">Kualitas pekerjaan :</td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Excellent" value="Excellent" {{ $dataTs->rel_d_instalasi[0]->foot_kualitas_pekerjaan == 'Excellent' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="Excellent">Excellent</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Good" value="Good" {{ $dataTs->rel_d_instalasi[0]->foot_kualitas_pekerjaan == 'Good' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="Good">Good</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Rata-rata" value="Rata-rata" {{ $dataTs->rel_d_instalasi[0]->foot_kualitas_pekerjaan == 'Rata-rata' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="Rata-rata">Rata-rata</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="margin:0;padding:0;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="foot_kualitas_pekerjaan" id="Buruk" value="Buruk" {{ $dataTs->rel_d_instalasi[0]->foot_kualitas_pekerjaan == 'Buruk' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="Buruk">Buruk</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body text-left">
                            <h5>Gambar progres kerja</h5>
                            <div class="col-lg-6 col-12" style="margin:0;padding:0">
                                <div class="form-group">
                                    <input type="file" name="filename[]" id="filename" multiple class="form-control" accept="image/*">
                                    {{-- <input type="file" name="filename[]" id="filename" multiple class="form-control" accept="image/*"> --}}
                                    @if ($errors->has('files'))
                                      @foreach ($errors->get('files') as $error)
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $error }}</strong>
                                      </span>
                                      @endforeach
                                    @endif
                                </div>
                            </div>
                            <i style="color:red">*Block semua gambar yang ingin ditambahkan lalu klik open dan simpan form</i>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-1 text-center">
                                <div style="border:1px dotted #fff;text-align:left">
                                    @foreach($dataTs->rel_d_img as $key => $value)
                                        <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                    @endforeach
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <div class="mt-1 text-center">
                                <div class="images-preview-div" style="border:1px dotted #fff;text-align:left"></div>
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
    <script >
        $(function() {
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="100" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#filename').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });
        tinymce.init({
            selector: 'textarea#tinymce',
            height: 300
        });
    </script>
</body>

{{-- <script type="text/javascript">
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
</script> --}}
</html>