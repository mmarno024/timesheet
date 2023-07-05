@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Checklist Type List @stop
<!-- ------------------------------------------------------------------------------- -->
@section('title-small') @stop
<!-- ------------------------------------------------------------------------------- -->
@section('breadcrumb')
    <span ng-show="f.tab=='list'">Data List</span>
    <span ng-show="f.tab=='frm'">Form Entry</span>
@stop
<!-- ------------------------------------------------------------------------------- -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            @component('layouts.common.coloradmin.panel_button') @endcomponent @yield('breadcrumb')
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
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                    style="white-space: nowrap;">
                    <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="oShow(v.kd_ct)">
                        <td style="padding:6px;" title="'Kode'" filter="{kd_ct: 'text'}" sortable="">
                            @{{ v . kd_ct }}</td>
                        <td style="padding:6px;" title="'Checklist Type'" filter="{nm_ct: 'text'}" sortable="">
                            @{{ v . nm_ct }}</td>
                    </tr>
                </table>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_type'>Kode</label>
                            <input type="text" ng-model="h.kd_ct" id="h_kd_ct" class="form-control input-sm"
                                maxlength="50" placeholder="auto" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label title='nm_ct'>Name</label>
                            <input type="text" ng-model="h.nm_ct" id="h_nm_ct" class="form-control input-sm"
                                maxlength="50" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('trs_local_mst_checklist_type') }}");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "{{ Auth::user()->userid }}",
                plant: "{{ Auth::user()->def_plant }}"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.sensor = [];

            var uploader = $scope.uploader = new FileUploader({
                url: "{{ url('upload_file') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    item.formData = [{
                        id: $scope.h.kd_sensor,
                        path: 'trs_local_mst_checklist_type',
                        s: 'i',
                        userid: $scope.f.userid,
                        plant: $scope.f.plant
                    }];
                },
                onSuccessItem: function(fileItem, response, status, headers) {
                    $scope.oGallery();
                }
            });

            $scope.oGallery = function() {
                SfGetMediaList('trs_local_mst_checklist_type/' + $scope.h.kd_sensor, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.kd_sensor = null;
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                if ($scope.f.plant == '002') {
                    $scope.tableList = new NgTableParams({
                        count: 25
                    }, {
                        getData: function($defer, params) {
                            var $btn = $('button').button('loading');
                            return $http.get(SfService.getUrl("_list"), {
                                params: {
                                    page: $scope.tableList.page(),
                                    limit: $scope.tableList.count(),
                                    order_by: $scope.tableList.orderBy(),
                                    q: $scope.f.q,
                                    trash: $scope.f.trash,
                                    plant: $scope.f.plant,
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
                } else {
                    SfService.httpGet("trs_local_mst_checklist_type_list", {
                        plant: $scope.f.plant
                    }, function(jdata) {
                        $scope.data = jdata.data.data;
                    });
                }
            }

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oSensor = function() {
                SfService.httpGet("trs_local_mst_checklist_type_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.sensor = jdata.data.data_sensor;
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oSearch();
        }]);

    </script>
@endsection
