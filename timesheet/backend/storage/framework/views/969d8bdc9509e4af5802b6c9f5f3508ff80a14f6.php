<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Log Activity EWS <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?>
            <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
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
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <label>EWS ID</label>
                            <div class="input-group">
                                <input type="text" ng-value="q.ews_id+' - '+q.ews_location" class="form-control input-sm"
                                    placeholder="Choose ews id ..." readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('ews_id')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <label>EWS Sender</label>
                            <select ng-model="q.vqmode" class="form-control input-sm" style="background:aquamarine">
                                <option ng-repeat="vq in ['device','system','user']">{{ vq }}</option>
                            </select>
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
                        <tr ng-repeat="v in $data" class="">
                            <td align="center" style="padding:5px;" title="'Sender'" filter="{sender: 'text'}" sortable="''">
                                {{ v.sender }}</td>
                            <td align="center" style="padding:5px;" title="'EWS ID'" filter="{ews_id: 'text'}" sortable="''">
                                {{ v.ews_id }}</td>
                            <td align="left" style="padding:5px;" title="'Location'" filter="{ews_location: 'text'}" sortable="''">
                                {{ v.ews_location}}</td>
                            <td align="right" style="padding:5px;" title="'Latitude'" filter="{ews_latitude: 'text'}" sortable="''">
                                {{ v.ews_latitude}}</td>
                            <td align="right" style="padding:5px;" title="'Longitude'" filter="{ews_longitude: 'text'}" sortable="''">
                                {{ v.ews_longitude}}</td>
                            <td align="center" style="padding:5px;" title="'Type'" filter="{send_direct: 'text'}" sortable="''">
                                <span ng-if="v.send_type == 0 || v.send_type == 1">Device Response</span>
                                <span ng-if="v.send_type == 2">Manual Control</span>
                                <span ng-if="v.send_type == 3">SMS Control</span>
                                <span ng-if="v.send_type == 4">Miscall Control</span>
                            </td>
                            <td align="center" style="padding:5px;" title="'Time'" filter="{ews_tlocal: 'text'}" sortable="">{{ v.ews_tlocal}}</td>
                            <td align="center" style="padding:5px;" title="'Sirine'" filter="{ews_sirine: 'text'}" sortable="''">
                                {{ v.ews_sirine_reply == 1 ? 'On' : 'Off' }}</td>
                            <td align="center" style="padding:5px;" title="'Sirini Level'" filter="{ews_sirine_level: 'text'}" sortable="''">
                                <span ng-if="v.ews_sirine_level == 0">-</span>
                                <span ng-if="v.ews_sirine_level == 1">Kuning (Waspada)</span>
                                <span ng-if="v.ews_sirine_level == 2">Orange (Siaga)</span>
                                <span ng-if="v.ews_sirine_level == 3">Merah (Awas)</span>
                                <span ng-if="v.ews_sirine_level == 8">Uji coba</span>
                                <span ng-if="v.ews_sirine_level == 9">Aman</span>
                            </td>
                            <td align="right" style="padding:5px;" title="'Signal'" filter="{ews_gsm_signal: 'text'}" sortable="''">
                                {{ v.ews_gsm_signal}} dBm</td>
                            <td align="right" style="padding:5px;" title="'Battery'" filter="{ews_battery: 'text'}" sortable="''">
                                {{ v.ews_battery}} Volt</td>
                            <td align="right" style="padding:5px;" title="'Temp.'" filter="{ews_temperature: 'text'}" sortable="''">
                                {{ v.ews_temperature}} °C</td>
                            <td align="center" style="padding:5px;" title="'Door'" filter="{ews_door: 'text'}" sortable="''">
                                {{ v.ews_door == 1 ? 'Open' : 'Close'}}</td>
                            <td align="left" style="padding:5px;" title="'Message'" filter="{ews_message: 'text'}" sortable="''">
                                {{ v.ews_message}}</td>
                            <td align="center" style="padding:5px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="''">
                                {{ v.kd_hardware}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_log_activity_ews')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {
                date1: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>"),
                date2: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>")
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
                    count: 50
                }, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.order,
                                q: $scope.f.q,
                                vq: $scope.q.vqmode,
                                hw: $scope.q.kd_hardware,
                                t1: moment($scope.q.date1).format('YYYY-MM-DD 00:00:01'),
                                t2: moment($scope.q.date2).format('YYYY-MM-DD 23:59:59'),
                                trash: $scope.f.trash,
                                plant: $scope.f.plant,
                                ewsid: $scope.q.ews_id,
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
                        SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.plantx = jsondata.project;
                                $scope.q.plantnamex = jsondata.project_name;
                                $scope.$apply();
                            });
                        break;
                    case 'ews_id':
                        SfLookup("<?php echo e(url('trs_local_mst_ews_lookup2')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.ews_id = jsondata.ews_id;
                                $scope.q.ews_location = jsondata.ews_location;
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\kalsel_fix\admin\backend\resources\views/trs/local/trs_log_activity_ews/trs_log_activity_ews_frm.blade.php ENDPATH**/ ?>