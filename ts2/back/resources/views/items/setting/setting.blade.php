@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 class="total">Pengaturan</h3>
                    </div>
                </div>


                <div class="section inset mt-2">
                    {{-- <div class="section-title">Inset</div> --}}
        
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion1">
                                    <i class="fa fa-user-plus text-danger"></i> &nbsp; Tambah user
                                </button>
                            </h2>
                            <div id="accordion1" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">


                                    <form action="#">
                                        <div class="section mb-5 p-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="nik">NIK</label>
                                                            <input type="text" class="form-control" name="nik" id="nik1" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="username">Nama</label>
                                                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="address">Jabatan</label>
                                                            <input type="text" class="form-control" name="address" id="address" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="telp">Nomor Telepon</label>
                                                            <input type="text" class="form-control" name="telp" id="telp" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="password">Password</label>
                                                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="password_confirm">Konfirmasi Password</label>
                                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" autocomplete="off" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn btn-info btn-block btn-lg">Simpan</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion2">
                                    <i class="fa fa-users text-danger"></i> &nbsp; Daftar user
                                </button>
                            </h2>
                            <div id="accordion2" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    

                                    <div class="section mt-2">
                                        <div class="section-title">
                                            <input type="text" class="form-control" name="search" id="search" autocomplete="off" placeholder="Cari user">
                                        </div>
                                        <div class="card">
                            
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%" scope="col" class="text-center">NIK</th>
                                                            <th width="30%" scope="col" class="text-center">Nama</th>
                                                            <th width="20%" scope="col" class="text-center">Jabatan</th>
                                                            <th width="20%" scope="col" class="text-center">Nomor Telepon</th>
                                                            <th width="20%" colspan="2" scope="col" class="text-center">Aktifitas</th>
                                                            {{-- <th scope="col" class="text-end">Balance</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">15323</th>
                                                            <td>John</td>
                                                            <td>Manager</td>
                                                            <td>0123456789</td>
                                                            <td><button type="button" class="btn btn-warning btn-sm me-1 mb-1">Ubah</button></td>
                                                            <td><button type="button" class="btn btn-danger btn-sm me-1 mb-1">Hapus</button></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">55212</th>
                                                            <td>Mark</td>
                                                            <td>User</td>
                                                            <td>0123456789</td>
                                                            <td><button type="button" class="btn btn-warning btn-sm me-1 mb-1">Ubah</button></td>
                                                            <td><button type="button" class="btn btn-danger btn-sm me-1 mb-1">Hapus</button></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">44623</th>
                                                            <td>Jane</td>
                                                            <td>User</td>
                                                            <td>0123456789</td>
                                                            <td><button type="button" class="btn btn-warning btn-sm me-1 mb-1">Ubah</button></td>
                                                            <td><button type="button" class="btn btn-danger btn-sm me-1 mb-1">Hapus</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                            
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion3">
                                    <i class="fa fa-user-tag text-danger"></i> &nbsp; Hak akses user
                                </button>
                            </h2>
                            <div id="accordion3" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    

                                    <form action="#">
                                        <div class="section mb-5 p-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="userid2">ID User</label>
                                                            <select class="form-control" name="userid" id="userid2">
                                                                <option value=""></option>
                                                                <option value="">Nama user</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="input-list">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="user_access" id="user_access1">
                                                            <label class="form-check-label" for="user_access1">Grand Administrator</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="user_access" id="user_access2">
                                                            <label class="form-check-label" for="user_access2">Administrator</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="user_access" id="user_access3">
                                                            <label class="form-check-label" for="user_access3">Public User</label>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn btn-info btn-block btn-lg">Simpan</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion4">
                                    <i class="fa fa-user-lock text-danger"></i> &nbsp; Keamanan user
                                </button>
                            </h2>
                            <div id="accordion4" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    

                                    <form action="#">
                                        <div class="section mb-5 p-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group basic">
                                                        <div class="input-wrapper">
                                                            <label class="label" for="userid3">ID User</label>
                                                            <select class="form-control" name="userid" id="userid3">
                                                                <option value=""></option>
                                                                <option value="">Nama user</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <ul class="listview simple-listview transparent flush">
                                                        <li>
                                                            <div>Create</div>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="create">
                                                                <label class="form-check-label" for="create"></label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>Read</div>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="read">
                                                                <label class="form-check-label" for="read"></label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>Update</div>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="update">
                                                                <label class="form-check-label" for="update"></label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>Delete</div>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="delete">
                                                                <label class="form-check-label" for="delete"></label>
                                                            </div>
                                                        </li>
                                                    </ul>


                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn btn-info btn-block btn-lg">Simpan</button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>

                {{-- <ul class="listview image-listview text inset line">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div><i class="fa fa-user-plus text-danger"></i> Tambah user</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="in">
                                <div><i class="fa fa-user-tag text-danger"></i> Hak akses user</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="in">
                                <div><i class="fa fa-user-lock text-danger"></i> Keamanan user</div>
                            </div>
                        </div>
                    </li>
                </ul> --}}

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