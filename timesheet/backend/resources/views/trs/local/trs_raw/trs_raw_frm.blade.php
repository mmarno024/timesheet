{{-- @extends('layouts.coloradmin_minified') --}}
@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Data Raw @stop
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
            @component('layouts.common.coloradmin.panel_button')
            @endcomponent @yield('breadcrumb')
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                    placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch()"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="f.tab=='list'">
                    <div class="col-sm-12">
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label>Start Date</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date1">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label>End Date</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date2">
                        </div>
                        <div ng-if="f.plant=='002'" class="col-lg-2 col-md-3 col-sm-4">
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
                        <div class="col-lg-2 col-md-3 col-sm-4">
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
                            <label style="margin-top: -5px">&nbsp;</label>
                            <button class="btn btn-sm btn-primary btn-block" ng-click="oSearch()">Load Data</button>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="f.tab=='list'">
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is
                    deleted item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;font-size:11px;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td style="padding:5px;" title="'Receive Date'" filter="{created_at: 'text'}" sortable="''">
                                @{{ v.created_at }}</td>
                            <td style="padding:5px;" title="'Actual Date'" filter="{tlocal: 'text'}" sortable="''">
                                @{{ v.tlocal }}</td>
                            <td style="padding:5px;" title="'Project'" filter="{plant: 'text'}" sortable="''">
                                @{{ v.rel_plant.plantname.substr(0, 10) }}..</td>
                                <td style="padding:5px;" title="'Location'" filter="{location: 'text'}" sortable="">
                                    @{{ v.location.substr(0, 10) }}..</td>
                            <td style="padding:5px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="''">
                                @{{ v.kd_hardware }}</td>
                            <td style="padding:5px;" title="'Browser'" filter="{browser: 'text'}" sortable="''">
                                @{{ v.browser.substr(0, 15) }}..</td>
                            <td style="padding:5px;" title="'Value'" filter="{location: 'text'}" sortable="">
                                <span ng-repeat="v1 in v.rel_d_gpa"
                                    class="label label-primary m-r-5" style="font-size: 10px;">
                                    @{{ v1.kd_sensor }} : @{{ v1.value }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='id'>ID</label>
                            <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength=""
                                ng-readonly="f.crud!='c' || true " placeholder="auto" readonly>
                            <label title='kd_hardware'>Hardware</label>
                            <input type="text" ng-model="h.kd_hardware" id="h_kd_hardware" class="form-control input-sm"
                                maxlength="5" readonly>
                            <label title='uid'>UID</label>
                            <input type="text" ng-model="h.uid" id="h_uid" class="form-control input-sm" maxlength=""
                                readonly>
                            <label title='location'>Location</label>
                            <input type="text" ng-model="h.location" id="h_location" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='timestamp'>Timestamp</label>
                            <input type="text" ng-model="h.timestamp" id="h_timestamp" class="form-control input-sm"
                                readonly>
                            <label title='timeutc'>UTC Time</label>
                            <input type="text" ng-model="h.timeutc" id="h_timeutc" class="form-control input-sm" readonly>
                            <label title='tlocal'>Local Time</label>
                            <input type="text" ng-model="h.tlocal" id="h_tlocal" class="form-control input-sm"
                                readonly>
                            <label title='latitude'>Latitude</label>
                            <input type="text" ng-model="h.latitude" id="h_latitude" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='sender'>Sender</label>
                            <input type="text" ng-model="h.sender" id="h_sender" class="form-control input-sm" readonly>
                            <label title='browser'>Browser</label>
                            <input type="text" ng-model="h.browser" id="h_browser" class="form-control input-sm" readonly>
                            <label title='secret_key'>Key</label>
                            <input type="text" ng-model="h.secret_key" id="h_secret_key" class="form-control input-sm" readonly>
                            <label title='longitude'>Longitude</label>
                            <input type="text" ng-model="h.longitude" id="h_longitude" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-12">
                            <label title='parameter'>Parameter</label> <span class="label label-primary">@{{h.dat_name}}</span>
                            <textarea class="form-control input-sm" style="height:100px;" ng-model="h.parameter" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span ng-repeat="v1 in h.rel_d_gpa">
                                <button type="button" class="btn btn-warning m-t-5">@{{ v1.rel_sensor.nm_sensor }} : @{{ v1.value }} <i>(@{{ v1.rel_sensor.satuan }})</i></button>&nbsp;
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('trs_local_trs_raw') }}");
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
                date2: jsDate("{{ date('Y-m-d H:i:s') }}")
            };
            $scope.limit = '';
            $scope.order = 'desc';
            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();
            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                SfFormNew("#frm");
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                $scope.tableList = new NgTableParams({
                    count: 100
                }, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.order,
                                q: $scope.f.q,
                                hw: $scope.q.kd_hardware,
                                t1: moment($scope.q.date1).format('YYYY-MM-DD 00:00:01'),
                                t2: moment($scope.q.date2).format('YYYY-MM-DD 23:59:59'),
                                trash: $scope.f.trash,
                                plant: $scope.f.plant,
                                qplant: $scope.q.plantx,
                                userid: $scope.f.userid
                            }
                        }).then(function(jdata) {
                            $btn.button('reset');
                            $scope.tableList.total(jdata.data.data.total);
                            return jdata.data.data.data;
                        }, function(error) {
                            $btn.button('reset');
                            swal('', error.data, 'error');
                        });
                    }
                });
            }

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                    $scope.oSearch2();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
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
                SfLog('trs_local_trs_raw', $scope.h.id);
            }

            $scope.oSearch();
        }]);
    </script>
@endsection
