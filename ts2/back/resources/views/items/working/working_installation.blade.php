@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 class="total">Instalasi atau pemasangan</h3>
                    </div>
                </div>

                


                <form action="#">

                    <ul class="nav nav-tabs lined" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#form_lk" role="tab">Form Luar Kota</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#form_instal" role="tab">Form Instalasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#form_foto" role="tab">Unggah Foto</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade show active" id="form_lk" role="tabpanel">
                            
                            
                            <div class="listview-title mt-1 text-warning">Anggota bertugas</div>
                            <div class="section mb-5 p-2">
                                <div ng-repeat="v in [1,2]" class="card" style="margin-bottom: 20px;">
                                    <span style="margin: 5px 0 0 10px;"> Anggota ke - @{{ v }}</span>
                                    <div class="card-body">
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_name">Nama Anggota</label>
                                                <input type="text" class="form-control" name="person_name" id="person_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_jabatan">Jabatan</label>
                                                <input type="text" class="form-control" name="person_jabatan" id="person_jabatan">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_peran">Peran / Penugasan</label>
                                                <input type="text" class="form-control" name="person_peran" id="person_peran">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_ctg_lk">Kategori LK</label>
                                                <select class="form-control" name="person_ctg_lk" id="person_ctg_lk">
                                                    <option value="">- Pilih -</option>
                                                    <option value="kategori1">Kategori 1</option>
                                                    <option value="kategori2">Kategori 2</option>
                                                    <option value="kategori3">Kategori 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_ctg_tunjangan">Kategori Tunjangan</label>
                                                <select class="form-control" name="person_ctg_tunjangan" id="person_ctg_tunjangan">
                                                    <option value="">- Pilih -</option>
                                                    <option value="kategori1">Kategori 1</option>
                                                    <option value="kategori2">Kategori 2</option>
                                                    <option value="kategori3">Kategori 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="insentif_khusus">Insentif Khusus</label>
                                                <input type="text" class="form-control" name="insentif_khusus" id="insentif_khusus">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-block btn-lg">Tambah anggota</button>
                            </div>

                            <div class="listview-title mt-1 text-warning">Rangkaian kunjungan luar kota</div>
                            <div class="section mb-5 p-2">
                                <div ng-repeat="v in [1,2]" class="card" style="margin-bottom: 20px;">
                                    <span style="margin: 5px 0 0 10px;"> Aktifitas ke - @{{ v }}</span>
                                    <div class="card-body">
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_name">Instansi / Lokasi</label>
                                                <input type="text" class="form-control" name="person_name" id="person_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_jabatan">Agenda</label>
                                                <input type="text" class="form-control" name="person_jabatan" id="person_jabatan">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_peran">Tanggal Berangkat</label>
                                                <input type="date" class="form-control" name="person_peran" id="person_peran">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_peran">Tanggal Selesai / Kembali</label>
                                                <input type="date" class="form-control" name="person_peran" id="person_peran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-block btn-lg">Tambah aktifitas</button>
                            </div>



                            <div class="listview-title mt-1 text-warning">Deskripsi laporan</div>
                            <div class="section mb-5 p-2">
                                <div ng-repeat="v in [1,2]" class="card" style="margin-bottom: 20px;">
                                    <span style="margin: 5px 0 0 10px;"> Deskripsi ke - @{{ v }}</span>
                                    <div class="card-body">
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_deskripsi_@{{ v }}">Deskripsi Laporan</label>
                                                <textarea style="height: 150px;" class="form-control" name="person_deskripsi_@{{ v }}" id="person_deskripsi_@{{ v }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="person_jabatan_@{{ v }}">Keterangan</label>
                                                <input type="text" class="form-control" name="person_jabatan_@{{ v }}" id="person_jabatan_@{{ v }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-block btn-lg">Tambah deskripsi</button>
                            </div>


                        </div>

                        <div class="tab-pane fade" id="form_instal" role="tabpanel">

                            <div class="listview-title mt-1 text-warning">Data konsumen</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="customer">Konsumen</label>
                                                <input type="text" class="form-control" name="customer" id="customer">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="hardware_name">Nama Alat</label>
                                                <input type="text" class="form-control" name="hardware_name" id="hardware_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="post_name">Nama Pos</label>
                                                <input type="text" class="form-control" name="post_name" id="post_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="post_name">Nomor GSM Pos</label>
                                                <input type="text" class="form-control" name="post_name" id="post_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="district">Kabupaten</label>
                                                <input type="text" class="form-control" name="district" id="district">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="sub_district">Kecamatan</label>
                                                <input type="text" class="form-control" name="sub_district" id="sub_district">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="latitude">Latitude</label>
                                                <input type="number" class="form-control" name="latitude" id="latitude">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="longitude">Longitude</label>
                                                <input type="number" class="form-control" name="longitude" id="longitude">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="listview-title mt-1 text-warning">Setup alat</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="listview simple-listview transparent flush">
                                            <li>
                                                <div>Solar Panel</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="solar_panel">
                                                    <label class="form-check-label" for="solar_panel"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="solar_panel_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="solar_panel_note" id="solar_panel_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Accu</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="accu">
                                                    <label class="form-check-label" for="accu"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="accu_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="accu_note" id="accu_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Solar Charge</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="solar_charge">
                                                    <label class="form-check-label" for="solar_charge"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="solar_charge_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="solar_charge_note" id="solar_charge_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Box Panel</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="box_panel">
                                                    <label class="form-check-label" for="box_panel"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="box_panel_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="box_panel_note" id="box_panel_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Logger</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="logger">
                                                    <label class="form-check-label" for="logger"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="logger_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="logger_note" id="logger_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>GSM Modem</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="gsm_modem">
                                                    <label class="form-check-label" for="gsm_modem"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="gsm_modem_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="gsm_modem_note" id="gsm_modem_note">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>


                            <div class="listview-title mt-1 text-warning">Setting Logger</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="listview simple-listview transparent flush">
                                            <li>
                                                <div>Interval Simpan</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="interval_simpan">
                                                    <label class="form-check-label" for="interval_simpan"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="interval_simpan_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="interval_simpan_note" id="interval_simpan_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Kalibrasi/Resolusi</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="kalibrasi">
                                                    <label class="form-check-label" for="kalibrasi"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="kalibrasi_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="kalibrasi_note" id="kalibrasi_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Level Awal</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="level_awal">
                                                    <label class="form-check-label" for="level_awal"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="level_awal_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="level_awal_note" id="level_awal_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Aktivasi Alarm</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="aktivasi_alarm">
                                                    <label class="form-check-label" for="aktivasi_alarm"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="aktivasi_alarm_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="aktivasi_alarm_note" id="aktivasi_alarm_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Cek Pembacaan</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="cek_pembacaan">
                                                    <label class="form-check-label" for="cek_pembacaan"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="cek_pembacaan_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="cek_pembacaan_note" id="cek_pembacaan_note">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>


                            <div class="listview-title mt-1 text-warning">Setting GSM Modem</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="listview simple-listview transparent flush">
                                            <li>
                                                <div>SMS Server</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="sms_server">
                                                    <label class="form-check-label" for="sms_server"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="sms_server_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="sms_server_note" id="sms_server_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Web Server</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="web_server">
                                                    <label class="form-check-label" for="web_server"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="web_server_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="web_server_note" id="web_server_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Mail Server</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="mail_server">
                                                    <label class="form-check-label" for="mail_server"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="mail_server_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="mail_server_note" id="mail_server_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>JWT/FTP/HTTP Server</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="jwt_server">
                                                    <label class="form-check-label" for="jwt_server"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="jwt_server_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="jwt_server_note" id="jwt_server_note">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>Capture & MMS</div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="capture">
                                                    <label class="form-check-label" for="capture"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="capture_note">Keterangan</label>
                                                        <input type="text" class="form-control" name="capture_note" id="capture_note">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>


                            <div class="listview-title mt-1 text-warning">Nomor Telepon User</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="listview simple-listview transparent flush">
                                            <li ng-repeat="v in [1,2]">
                                                <div class="form-group basic">
                                                    <div class="input-wrapper">
                                                        <label class="label" for="telp_user_@{{ v }}">Nomor Telepon User @{{ v }}</label>
                                                        <input type="text" class="form-control" name="telp_user_@{{ v }}" id="telp_user_@{{ v }}">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-success btn-block btn-lg">Tambah nomor</button>

                                    </div>
                                </div>
                            </div>


                            <div class="section-title">Sending Server</div>
                            <div class="card">
                                <div class="card-body pt-0">

                                    <ul class="nav nav-tabs lined" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#server1" role="tab">Server 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#server2" role="tab">Server 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#server3" role="tab">Server 2</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-2">
                                        <div class="tab-pane fade show active" id="server1" role="tabpanel">
                                            <ul class="listview simple-listview transparent flush">
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_setup1">Status Setup Server</label>
                                                            <input type="text" class="form-control" name="status_setup1" id="status_setup1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="address1">Address</label>
                                                            <input type="text" class="form-control" name="address1" id="address1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="username1">Username</label>
                                                            <input type="text" class="form-control" name="username1" id="username1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="password1">Password</label>
                                                            <input type="text" class="form-control" name="password1" id="password1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_data1">Interval Data</label>
                                                            <input type="text" class="form-control" name="interval_data1" id="interval_data1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_photo1">Status Photo Web</label>
                                                            <input type="text" class="form-control" name="status_photo1" id="status_photo1">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_photo1">Interval Photo</label>
                                                            <input type="text" class="form-control" name="interval_photo1" id="interval_photo1">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="server2" role="tabpanel">
                                            <ul class="listview simple-listview transparent flush">
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_setup2">Status Setup Server</label>
                                                            <input type="text" class="form-control" name="status_setup2" id="status_setup2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="address2">Address</label>
                                                            <input type="text" class="form-control" name="address2" id="address2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="username2">Username</label>
                                                            <input type="text" class="form-control" name="username2" id="username2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="password2">Password</label>
                                                            <input type="text" class="form-control" name="password2" id="password2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_data2">Interval Data</label>
                                                            <input type="text" class="form-control" name="interval_data2" id="interval_data2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_photo2">Status Photo Web</label>
                                                            <input type="text" class="form-control" name="status_photo2" id="status_photo2">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_photo2">Interval Photo</label>
                                                            <input type="text" class="form-control" name="interval_photo2" id="interval_photo2">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="server3" role="tabpanel">
                                            <ul class="listview simple-listview transparent flush">
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_setup3">Status Setup Server</label>
                                                            <input type="text" class="form-control" name="status_setup3" id="status_setup3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="address3">Address</label>
                                                            <input type="text" class="form-control" name="address3" id="address3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="username3">Username</label>
                                                            <input type="text" class="form-control" name="username3" id="username3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="password3">Password</label>
                                                            <input type="text" class="form-control" name="password3" id="password3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_data3">Interval Data</label>
                                                            <input type="text" class="form-control" name="interval_data3" id="interval_data3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="status_photo3">Status Photo Web</label>
                                                            <input type="text" class="form-control" name="status_photo3" id="status_photo3">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="interval_photo3">Interval Photo</label>
                                                            <input type="text" class="form-control" name="interval_photo3" id="interval_photo3">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="listview-title mt-1 text-warning">Note</div>
                            <div class="section mb-5 p-2">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <textarea style="height:150px;" class="form-control" name="note" id="note"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="listview-title mt-1 text-warning">Sensor/Alat akan dipasang</div>
                            <div class="section mb-5 p-2">
                                <div ng-repeat="v in [1,2]" class="card" style="margin-bottom: 20px;">
                                    <span style="margin: 5px 0 0 10px;"> Alat ke - @{{ v }}</span>
                                    <div class="card-body">
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="hard_name">Nama Alat</label>
                                                <input type="text" class="form-control" name="hard_name" id="hard_name">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="hard_sn">SN</label>
                                                <input type="text" class="form-control" name="hard_sn" id="hard_sn">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="hard_spek">Spek/Rentang Ukur</label>
                                                <input type="text" class="form-control" name="hard_spek" id="hard_spek">
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="hard_kalibrasi">Nilai Kalibrasi</label>
                                                <input type="text" class="form-control" name="hard_kalibrasi" id="hard_kalibrasi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p>&nbsp;</p> --}}

                                <button type="button" class="btn btn-success btn-block btn-lg">Tambah alat</button>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="form_foto" role="tabpanel">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate enim sed elit
                            consequat, sed ultricies ligula venenatis. In nec arcu eget neque sodales accumsan vel
                            et neque.
                        </div>

                    </div>



                    <button type="submit" class="btn btn-info btn-block btn-lg">Simpan data</button>
                </form>




            </div>
            <p>&nbsp;</p>
        </div>
    </div>

</div>
<script>
    var app = angular.module("myapp", [])
    app.controller("mainCtrl", ['$scope', '$http', '$interval', function($scope, $http, $interval) {
        $scope.xxx = 2;
        $scope.hello = {};
        $scope.hello.title1 = "Apps 1";
        $scope.hello.title2 = "Apps 2";

        console.log($scope.xxx);
    }]);
 </script>
@endsection