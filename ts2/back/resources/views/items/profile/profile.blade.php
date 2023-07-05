@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 class="total">Profil Pengguna</h3>
                    </div>
                </div>

                <div class="section mt-3 text-center">
                    <div class="avatar-section">
                        <a href="#">
                            <img src="{{ url('public/finapp/assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w100 rounded">
                            <span class="button">
                                <i class="fa fa-camera"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <form action="#">
                    <div class="listview-title mt-1">Foto Profil</div>
                    <div class="section mb-5 p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <div class="custom-file-upload" id="fileUpload1" style="height: 50px;">
                                            <input type="file" name="image_profile" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                                            <label for="fileuploadInput">
                                                <span>
                                                    <strong>
                                                        <i class="fa fa-arrow-up"></i>
                                                        <i>Unggah Foto</i>
                                                    </strong>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listview-title mt-1">Data diri</div>
                    <div class="section mb-5 p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="gender">Jenis Kelamin</label>
                                        <input type="text" class="form-control" name="gender" id="gender" autocomplete="off"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="address">Alamat</label>
                                        <input type="text" class="form-control" name="address" id="address" autocomplete="off"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" autocomplete="off"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="telp">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="telp" id="telp" autocomplete="off"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="listview-title mt-1">Password</div>
                    <div class="section mb-5 p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="password_ex">Password Lama</label>
                                        <input type="password" class="form-control" name="password_ex" id="password_ex" autocomplete="off"
                                            placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="password_new">Password Baru</label>
                                        <input type="password" class="form-control" name="password_new" id="password_new" autocomplete="off"
                                            placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="password_new_confirm">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" name="password_new_confirm" id="password_new_confirm" autocomplete="off"
                                            placeholder="********">
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-block btn-lg">Simpan perubahan</button>
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