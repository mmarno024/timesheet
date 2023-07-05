<?php
set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);
?>
@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Data Detail @stop
<!-- ------------------------------------------------------------------------------- -->
@section('title-small') @stop
<!-- ------------------------------------------------------------------------------- -->
@section('breadcrumb')
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> @stop
<!-- ------------------------------------------------------------------------------- -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            @component('layouts.common.coloradmin.panel_button') @endcomponent @yield('breadcrumb')
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="col-sm-12 m-b-10">
                    <div class="row m-b-10" ng-show="f.tab=='list' && data_logger!=null">
                         <div ng-show="kd_logger != '5'" class="col-lg-4 col-md-6 col-sm-12">
                            <select name="vmodes" class="form-control input-sm" style="background:aquamarine"
                                ng-options="vmode.vname for vmode in arrView" ng-change="oViewmode()"
                                ng-model="vmodeselected">
                                <option value="">- Display Options -</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" ng-show="f.tab=='list'">
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>Start Date</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date1">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>End Date</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date2">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3" ng-show="f.plant=='002'">
                            <label>Project</label>
                            <div class="input-group">
                                <input type="text" ng-value="q.plantnamex"
                                    class="form-control input-sm" placeholder="Choose project ..." readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('plant')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>Hardware</label>
                            <div class="input-group">
                                <input type="text" ng-value="q.kd_hardware+' - '+q.location" class="form-control input-sm"
                                    placeholder="Choose hardware ..." readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('kd_hardware')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>Display Format</label>
                            <select ng-model="q.vqmode" class="form-control input-sm" style="background:aquamarine">
                                <option ng-repeat="vq in ['View per Interval','View per Hour','View per Day','View per Month']">@{{ vq }}</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>&nbsp;</label>
                            <button class="btn btn-sm btn-primary btn-block" ng-click="oSearch()">Load Data</button>
                        </div>
                    </div>
                    <div class="alert alert-warning" style="margin:10px 0 0 0;" ng-show="data_logger!=null">
                        <span class="m-r-20"><i class="fa fa-id-card"></i>&nbsp;Hardware : @{{data_logger.kd_hardware}}</span>
                        <span class="m-r-20"><i class="fa fa-map-marker"></i>&nbsp;Location : @{{data_logger.location}} <i>(  @{{data_logger.latitude}},  @{{data_logger.longitude}})</i></span>
                        <span class="m-r-20"><i class="fa fa-calendar"></i>&nbsp;Last Data : @{{data_logger.tlocal}}</span>
                    </div>
                    <hr />
                </div>
            </div>
            <hr>
            <div ng-show="f.tab=='list'">
                <div class="col-sm-12 m-b-20" ng-if="result=='2'">
                    <div class="col-lg-2 col-md-4 col-sm-4" style="float: right">
                        <button type="button" class="btn btn-sm btn-danger btn-block"
                            ng-click="oPdf(data_logger.kd_hardware,q.date1,q.date2,q.vqmode)"><i
                                class="fa fa-download"></i>&nbsp;Download PDF</button>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4" style="float: right">
                        <button type="button" class="btn btn-sm btn-success btn-block" ng-click="oXls(data_logger.kd_hardware,q.date1,q.date2,q.vqmode)"><i class="fa fa-download"></i>&nbsp;Download Excel</button>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div ng-show="result!=2 && result!=3" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div class="m-0 p-0">
                                <canvas id="grafik" height="210" width="600"></canvas>
                            </div>
                        </div>
                    </div>

                    <div ng-show="result==2" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="div1" class="table-responsive">
                                <div class="" style="margin: 0 0 10px;  ">
                                    <span class="m-r-20"><i class="fa fa-id-card"></i>&nbsp;Hardware : @{{data_logger.kd_hardware}}</span>
                                    <span class="m-r-20"><i class="fa fa-map-marker"></i>&nbsp;Location : @{{data_logger.location}} <i>(  @{{data_logger.latitude}},  @{{data_logger.longitude}})</i></span>
                                    <span class="m-r-20"><i class="fa fa-calendar"></i>&nbsp;Last Data : @{{data_logger.tlocal}}</span>
                                </div>
                                <table class="table table-condensed table-bordered" style="white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th style="padding:3px;" class="text-center">No.</th>
                                            <th style="padding:3px;" class="text-center">Actual Date</th>
                                            <th style="padding:3px;" ng-repeat="(k,v) in data_table[0].sensor" class="text-center">@{{v.properties.nm_sensor}} <i>(@{{v.properties.satuan}})</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="font-size:10px;" ng-repeat="(k,v) in data_table">
                                            <td align="center" style="padding:3px;">@{{ $index + 1 }}</td>
                                            <td align="center" style="padding:3px;">@{{ v . date_act }}</td>
                                            <td align="right" ng-repeat="(k1,v1) in v.sensor" style="padding:3px;">@{{ v1.value }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div ng-show="result==3" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="gallery" class="gallery">
                                <div class="col-sm-4" ng-repeat="v in data_img">
                                    <div class="image gallery-group-1" style="width: 100%;">
                                        <div class="image-inner">
                                            <a href="{{ url('device_img') }}/@{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="{{ url('device_img') }}/@{{ v . img_name }}" alt="" />
                                            </a>
                                            <p class="image-caption">@{{ v . kd_hardware }}</p>
                                        </div>
                                        <div class="image-info m-0 p-0">
                                            <div class="desc m-0 p-0" style="min-height: 150px; font-size: 10px;">
                                                <table class="table table-condensed table-bordered">
                                                    <tr>
                                                        <td>Filename</td>
                                                        <td>@{{ v . img_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lat, Long</td>
                                                        <td>@{{ v . latitude }}, @{{ v . longitude }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location</td>
                                                        <td>@{{ v . location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Capture</td>
                                                        <td>@{{ v . date_capture }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js') }}"></script>
    <script src="{{ url('coloradmin/assets/plugins/chartjs2/utils.js') }}"></script>
    <script src="{{ url('coloradmin/assets/plugins/chartjs/Chart.bundle.js') }}"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('trs_local_trs_raw_detail') }}");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "{{ Auth::user()->userid }}",
                plant: "{{ Auth::user()->def_plant }}"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {
                date1: jsDate("{{ date('Y-m-d H:i:s') }}"),
                date2: jsDate("{{ date('Y-m-d H:i:s') }}"),
                vqmode: '',
            };
            $scope.view_mode = "";

            $scope.arrView = [{
                    "vid": 1,
                    "vname": "View Grafik"
                },
                {
                    "vid": 2,
                    "vname": "View Tabel"
                },
                {
                    "vid": 3,
                    "vname": "View Gambar"
                }
            ];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            $scope.oViewmode = function() {
                if ($scope.vmodeselected.vid == "3") {
                    $scope.result = 3;
                } else if ($scope.vmodeselected.vid == "2") {
                    $scope.result = 2;
                } else {
                    $scope.result = 1;
                }
            }

            $scope.oSearch = function() {
                SfService.httpGet(SfService.getUrl("_list_all"), {
                    plant: $scope.f.plant,
                    plantx: $scope.q.plantx,
                    hw: $scope.q.kd_hardware,
                    vq: $scope.q.vqmode,
                    t1: moment($scope.q.date1).format('YYYY-MM-DD 00:00:01'),
                    t2: moment($scope.q.date2).format('YYYY-MM-DD 23:59:59')
                }, function(jdata) {
                    $scope.data_logger = jdata.data.data_logger;
                    $scope.data_graph = jdata.data.data_graph;                    
                    $scope.data_table = jdata.data.data_table;
                    $scope.data_img = jdata.data.data_img;
                    if($scope.data_logger){
                        if ($scope.data_logger.kd_logger != '5') {
                            if ($scope.data_table == '' || $scope.data_table == null) {
                                swal('', 'Data pada tanggal terpilih tidak ada', 'error');
                                return false;
                            }
                        } else {
                            if ($scope.data_img == '' || $scope.data_img == null) {
                                swal('', 'Data pada tanggal terpilih tidak ada', 'error');
                                return false;
                            }
                        }
                        if ($scope.data_logger.kd_logger != '5') {
                            $scope.label=[];
                            $scope.dataset = [];
                            angular.forEach($scope.data_graph, function(item, i) {
                                angular.forEach(item.data, function(item2, i2) {
                                    $scope.arr_dataset = {
                                        backgroundColor: item2.properties.color,
                                        borderColor: item2.properties.color,
                                        borderWidth: 1.5,
                                        pointRadius: 1.5,
                                        fill: false,
                                        label: item2.properties.nm_sensor,
                                        data: item2.nilai,
                                    }
                                    $scope.dataset.push($scope.arr_dataset);
                                });
                                angular.forEach(item.label, function(item2, i2) {
                                    $scope.arr_label = item2.date;
                                    $scope.label.push($scope.arr_label);
                                });
                            });
                            $scope.dataset = {
                                labels: $scope.label,
                                datasets: $scope.dataset
                            };
                            
                            $scope.ctx = document.getElementById('grafik');
                            $scope.myChart = new Chart($scope.ctx, {
                                type: 'line',
                                data: $scope.dataset,
                                options: {
                                    animation: false,
                                    responsive: true,
                                    title: {
                                        display: false,
                                        text: '-',
                                        fontSize: 12,
                                        padding: 2
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                fontSize: 8
                                            },
                                        }],
                                        xAxes: [{
                                            ticks: {
                                                fontSize: 8
                                            }
                                        }]
                                    },
                                    legend: {
                                        labels: {
                                            boxWidth: 10,
                                            fontSize: 10
                                        }
                                    }
                                },
                            });
                        }
                    }
                });
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'plant':
                        SfLookup("{{ url('sys_syplant_lookup') }}?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.plantx = jsondata.project;
                                $scope.q.plantnamex = jsondata.project_name;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_hardware':
                        SfLookup("{{ url('trs_local_mst_hardware_lookup2') }}?plant=" + $scope.f.plant +
                            "&logger=" + $scope.q.kd_logger + "&plantx=" + $scope.q.plantx,
                            function(id, name, jsondata) {
                                $scope.q.kd_hardware = jsondata.kd_hardware;
                                $scope.q.location = jsondata.location;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_raw_detail', $scope.h.id);
            }

            $scope.oPdf = function(hardware,date1,date2,vqmode) {
                window.open('trs_local_trs_raw_detail_all_pdf?hw=' + hardware + '&t1=' + moment(date1).format('YYYY-MM-DD 00:00:00') + '&t2=' + moment(date2).format('YYYY-MM-DD 23:59:59') + '&vq=' + vqmode);
            }

            $scope.oXls = function(hardware,date1,date2,vqmode) {
                window.open('trs_local_trs_raw_detail_all_xls?hw=' + hardware + '&t1=' + moment(date1).format('YYYY-MM-DD 00:00:00') + '&t2=' + moment(date2).format('YYYY-MM-DD 23:59:59') + '&vq=' + vqmode);
            }

            $scope.oSearch();
        }]);

    </script>
@endsection
