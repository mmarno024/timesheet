@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 ng-if="xxx==1" class="total">Panduan pengisian form Luar Kota - @{{hello.title1}}</h3>
                        <h3 ng-if="xxx==2" class="total">Panduan pengisian form Luar Kota - @{{hello.title2}}</h3>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="left">
                        <li><span class="title">Pilih menu "Luar Kota" sebelah kiri bawah</span></li>
                        <li><span class="title">Klik tombol "Tambah"</span></li>
                        <li><span class="title">Tentukan pilihan jenis Luar Kota</span></li>
                        <li><span class="title">Isi data sesuai dengan kolom yang tersedia</span></li>
                        <li><span class="title">Klik "Lanjutkan" atau "Simpan"</span></li>
                        <li><span class="title">Lihat data inputan pada menu "Luar Kota"</span></li>
                    </div>
                </div>
                <div class="balance">
                    <button type="button" class="btn btn-danger shadowed  me-1 mb-1"><i class="fa fa-download"></i> &nbsp; Download panduan pengisian form</button>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Timesheet yang anda simpan</span>
                        <h1 class="total">50</h1>
                        <span class="title">periode 2023-01-01 s/d 2023-12-31</span>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="left">
                        <span class="title">
                            <div style="overflow: auto">
                                <canvas height="200px" id="myChart"></canvas>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var app = angular.module("myapp", [])
    app.controller("mainCtrl", ['$scope', '$http', '$interval', function($scope, $http, $interval) {
        $scope.xxx = 2;
        $scope.hello = {};
        $scope.hello.title1 = "Apps 1";
        $scope.hello.title2 = "Apps 2";

        console.log($scope.xxx);

        $scope.ctx = document.getElementById('myChart');
        $scope.myChart = new Chart($scope.ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: '2023',
                    data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }]);
 </script>
@endsection