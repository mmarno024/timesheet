@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 class="total">Jenis Luar Kota</h3>
                    </div>
                </div>

                <ul class="listview image-listview text inset line">
                    <li>
                        <a class="text-dark" href="{{ url('working_installation') }}">
                            <div class="item">
                                <div class="in">
                                    <div><i class="fa fa-file-pen text-danger"></i> Instalasi atau Pemasangan</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="text-dark" href="{{ url('working_service') }}">
                            <div class="item">
                                <div class="in">
                                    <div><i class="fa fa-file-pen text-danger"></i> Service atau Maintenance</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="text-dark" href="{{ url('working_survey') }}">
                            <div class="item">
                                <div class="in">
                                    <div><i class="fa fa-file-pen text-danger"></i> Survey Alat atau Lokasi</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="text-dark" href="{{ url('working_etc') }}">
                            <div class="item">
                                <div class="in">
                                    <div><i class="fa fa-file-pen text-danger"></i> Lainnya</div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

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