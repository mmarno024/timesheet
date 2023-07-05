<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Sensor <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
    <span ng-show="f.tab=='frm'">Form Entry</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_sensor']); ?> <?php echo $__env->renderComponent(); ?>
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-success btn-sm" ng-click="oSearch(1)"><i
                                        class="fa fa fa-recycle"></i></button>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                placeholder="Search">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div ng-show="f.tab=='frm'">
                        <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                            ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_sensor)">
                            <td title="'Kode Sensor'" filter="{kd_sensor: 'text'}" sortable="'kd_sensor'">
                                {{ v . kd_sensor }}</td>
                            <td title="'Nama Sensor'" filter="{nm_sensor: 'text'}" sortable="'nm_sensor'">
                                {{ v . nm_sensor }}</td>
                            <td title="'Satuan'" filter="{satuan: 'text'}" sortable="'satuan'">
                                {{ v . satuan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='kd_sensor'>Kode Sensor</label>&nbsp;<code>Tanpa tanda baca</code>
                            <input type="text" ng-model="h.kd_sensor" id="h_kd_sensor" class="form-control input-sm"
                                maxlength="25" ng-readonly="f.crud!='c'" required>
                        </div>
                        <div class="col-sm-4">
                            <label title='nm_sensor'>Nama Sensor</label>
                            <input type="text" ng-model="h.nm_sensor" id="h_nm_sensor" class="form-control input-sm"
                                maxlength="50">
                        </div>
                        <div class="col-sm-4">
                            <label title='satuan'>Satuan</label>
                            <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm"
                                maxlength="50">
                        </div>
                    </div>
                    <hr />
                    <div class="row" ng-show="f.crud=='c'">
                        <div class="col-sm-12">
                            <h3 class="text-success">Daftar Sensor</h3>
                            <span ng-repeat="v2 in sensor">
                                <button type="button" class="btn btn-primary m-b-5">{{ v2 }}</button>&nbsp;
                            </span>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_sensor')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.sensor = [];
            // $scope.zz = ['bagus', 'andy', 'rendra', 'dika', 'bilal', 'mala', 'dani', 'andri'];

            // angular.element(document).ready(function() {
            //     var multipleCancelButton = new Choices('#choices_multiple', {
            //         removeItemButton: true,
            //         // maxItemCount: 5,
            //         searchResultLimit: 5,
            //         renderChoiceLimit: 5
            //     });
            // });

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_sensor,
                        path: 'trs_local_mst_sensor',
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
                SfGetMediaList('trs_local_mst_sensor/' + $scope.h.kd_sensor, function(jdata) {
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
                $scope.tableList = new NgTableParams({}, {
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

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oSensor = function() {
                SfService.httpGet("trs_local_mst_sensor_data", {
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

            // $scope.addField = function() {
            //     SfService.httpGet("trs_local_mst_sensor_addField", {
            //         plant: $scope.f.plant
            //     }, function(jdata) {
            //         $scope.sensor2 = jdata.data.data_sensor2;
            //     });
            // }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    // case 'kd_logger':
                    //     SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                    //         function(id, name, jsondata) {
                    //             $scope.h.kd_logger = jsondata.kd_logger;
                    //             $scope.h.nm_logger = jsondata.nm_logger;
                    //             $scope.$apply();
                    //         });
                    //     break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_sensor', $scope.h.kd_sensor);
            }

            $scope.oSearch();
            $scope.oSensor();
            // $scope.addField();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\psda\psda\backend\resources\views/trs/local/mst_sensor/mst_sensor_frm.blade.php ENDPATH**/ ?>