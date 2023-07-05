@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Provice @stop
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
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data">
                            <td style="padding:6px;" title="'Provice'" filter="{kd_provinsi: 'text'}" sortable="">
                                @{{ v . kd_provinsi }}</td>
                            <td style="padding:6px;" title="'Provice Name'" filter="{nm_provinsi: 'text'}" sortable="">
                                @{{ v . nm_provinsi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='kd_provinsi'>Provice</label>
                            <input type="text" ng-model="h.kd_provinsi" id="h_kd_provinsi" class="form-control input-sm"
                                maxlength="2" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-4">
                            <label title='nm_provinsi'>Provice Name</label>
                            <input type="text" ng-model="h.nm_provinsi" id="h_nm_provinsi" class="form-control input-sm"
                                maxlength="30">
                        </div>
                    </div>
                    <hr> @component('layouts.common.coloradmin.form_attr') @endcomponent
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('trs_local_mst_provinsi') }}");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "{{ Auth::user()->userid }}",
                plant: "{{ Auth::user()->def_plant }}"
            };
            $scope.h = {};

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
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
            }

            $scope.oSearch();
        }]);

    </script>
@endsection
