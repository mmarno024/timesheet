{{-- @extends('layouts.coloradmin_minified') --}}
@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Data Timesheet @stop
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
                    <div ng-show="f.tab=='frm'">
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    </div>
                </div>
                <button ng-show="f.plant=='002' && f.tab=='list'" type="button" class="btn btn-sm btn-inverse" ng-click="oNew()"
                    ng-attr-title="Buat Baru"><i class="fa fa-plus"></i> New</button>
                <button ng-show="f.plant!='002' && f.tab=='list'" type="button" class="btn btn-sm btn-default" ng-attr-title="Buat Baru"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            {{-- <div ng-show="f.tab=='list'">
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
            </div> --}}
            {{-- <div ng-show="f.tab=='frm'"> --}}
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%" class="table table-bordered text-bold">
                                <tr>
                                    <td rowspan="4" width="25%" class="m-0 p-2 text-center" style="vertical-align:middle">
                                        <img src="{{ url('coloradmin') }}/assets/img/logo.png" width="70%" />
                                    </td>
                                    <td rowspan="2" width="40%" class="m-0 p-2 text-center text-bold" style="background:#0cb235;font-size:20px;vertical-align:middle">Time Sheet</td>
                                    <td width="35%" class="m-0 p-2">
                                        <table width="100%" style="margin:0;padding:0">
                                            <tr>
                                                <td width="20%">Nomor</td>
                                                <td width="5%">:</td>
                                                <td width="75%">FM.RD-03-148/00</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="m-0 p-2">
                                        <table width="100%" style="margin:0;padding:0">
                                            <tr>
                                                <td width="20%">Revisi</td>
                                                <td width="5%">:</td>
                                                <td width="75%">00</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td rowspan="2" class="m-0 p-2 text-center text-bold" style="font-size:20px;vertical-align:middle">Instalasi / Pemasangan</td>
                                    <td class="m-0 p-2">
                                        <table width="100%" style="margin:0;padding:0">
                                            <tr>
                                                <td width="20%">Tanggal</td>
                                                <td width="5%">:</td>
                                                <td width="75%">1 November 2018</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="m-0 p-2">
                                        <table width="100%" style="margin:0;padding:0">
                                            <tr>
                                                <td width="20%">Halaman</td>
                                                <td width="5%">:</td>
                                                <td width="75%">1 dari 1</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                            </table>

                            <table width="100%" class="text-bold table-condensed">
                                <tr>
                                    <td class="m-0 p-2">*Formulir diisikan dilapangan saat pemasangan</td>
                                    <td class="m-0 p-2" style="text-align: right">Tanggal  :</td>
                                    <td class="m-0 p-2">
                                        <input type="date" ng-model="h.tanggal" class="form-control input-sm no-border-text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            {{-- </div> --}}
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('trs_local_trs_timesheet') }}");
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
            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                SfFormNew("#frm");
            }

            // $scope.oSearch = function(trash, order_by) {
            //     $scope.f.tab = "list";
            //     $scope.f.trash = trash;
            //     $scope.tableList = new NgTableParams({
            //         count: 100
            //     }, {
            //         getData: function($defer, params) {
            //             var $btn = $('button').button('loading');
            //             return $http.get(SfService.getUrl("_list"), {
            //                 params: {
            //                     page: $scope.tableList.page(),
            //                     limit: $scope.tableList.count(),
            //                     order_by: $scope.order,
            //                     q: $scope.f.q,
            //                     hw: $scope.q.kd_hardware,
            //                     t1: moment($scope.q.date1).format('YYYY-MM-DD 00:00:01'),
            //                     t2: moment($scope.q.date2).format('YYYY-MM-DD 23:59:59'),
            //                     trash: $scope.f.trash,
            //                     plant: $scope.f.plant,
            //                     qplant: $scope.q.plantx,
            //                     userid: $scope.f.userid
            //                 }
            //             }).then(function(jdata) {
            //                 $btn.button('reset');
            //                 $scope.tableList.total(jdata.data.data.total);
            //                 return jdata.data.data.data;
            //             }, function(error) {
            //                 $btn.button('reset');
            //                 swal('', error.data, 'error');
            //             });
            //         }
            //     });
            // }

            // $scope.oSave = function() {
            //     SfService.save("#frm", SfService.getUrl(), {
            //         h: $scope.h,
            //         f: $scope.f
            //     }, function(jdata) {
            //         $scope.oSearch();
            //         $scope.oSearch2();
            //     });
            // }

            // $scope.oShow = function(id) {
            //     SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
            //         $scope.oNew();
            //         $scope.h = jdata.data.h;
            //         $scope.f.crud = 'u';
            //     });
            // }

            // $scope.oRestore = function(id) {
            //     $scope.oDel(id, 1);
            // }

            // $scope.oLookup = function(id, selector, obj) {
            //     switch (id) {
            //         case 'plant':
            //             SfLookup("{{ url('sys_syplant_lookup') }}?plant=" + $scope.f.plant,
            //                 function(id, name, jsondata) {
            //                     $scope.q.plantx = jsondata.project;
            //                     $scope.q.plantnamex = jsondata.project_name;
            //                     $scope.$apply();
            //                 });
            //             break;
            //         case 'kd_hardware':
            //             SfLookup("{{ url('trs_local_mst_hardware_lookup2') }}?plant=" + $scope.f.plant +
            //                 "&logger=" + $scope.q.kd_logger + "&plantx=" + $scope.q.plantx,
            //                 function(id, name, jsondata) {
            //                     $scope.q.kd_hardware = jsondata.kd_hardware;
            //                     $scope.q.location = jsondata.location;
            //                     $scope.$apply();
            //                 });
            //             break;
            //         default:
            //             swal('Sorry', 'Under construction', 'error');
            //             break;
            //     }
            // }

            // $scope.oLog = function() {
            //     SfLog('trs_local_trs_raw', $scope.h.id);
            // }

            // $scope.oSearch();
        }]);
    </script>
@endsection
