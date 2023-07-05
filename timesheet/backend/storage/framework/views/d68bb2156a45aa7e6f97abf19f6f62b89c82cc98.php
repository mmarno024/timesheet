<?php $__env->startSection('title'); ?>Dasboard <?php $__env->stopSection(); ?>
<?php $__env->startSection('title-small'); ?>Home <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Detail</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/sparkline/jquery.sparkline.js"></script>
    <div class="">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-black">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                    <div class="stats-title">USER</div>
                    <div class="stats-number"><?php echo e(Auth::user()->userid); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width:100%;"></div>
                    </div>
                    <div class="stats-desc"><?php echo e(Auth::user()->username); ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-fw"></i></div>
                    <div class="stats-title">DEFAULT USER PROJECT</div>
                    <div class="stats-number">{{ cek_plant . plant }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width:100%;"></div>
                    </div>
                    <div class="stats-desc">{{ cek_plant . plantname }}</div>
                </div>
            </div>
            <div ng-if="f.plant=='002'" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-fw"></i></div>
                    <div class="stats-title">TOTAL PROJECT</div>
                    <div class="stats-number">{{ total_plant }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width:100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/sys_syplant')); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div ng-if="total_hardware.total_wl!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL WATER LEVEL (WL)</h4>
                        <p>{{ total_hardware . total_wl }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="total_hardware.total_rf!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL RAINFALL (RF)</h4>
                        <p>{{ total_hardware . total_rf }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="total_hardware.total_extenso!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-black">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL EXTENSO (ETC)</h4>
                        <p>{{ total_hardware . total_extenso }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="total_hardware.total_suhu!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-black">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL SUHU (ETC)</h4>
                        <p>{{ total_hardware . total_suhu }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="total_hardware.total_cam!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL CAMERA (CAM)</h4>
                        <p>{{ total_hardware . total_cam }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="total_hardware.total_gpa!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-orange">
                    <div class="stats-icon"><i class="fa fa-server"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL GENERAL PURPOSE AGENT (GPA)</h4>
                        <p>{{ total_hardware . total_gpa }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse" data-sortable-id="index-6">
                    <div class="panel-heading">
                        <h4 class="panel-title">SENSOR USED</h4>
                    </div>
                    <div class="panel-body p-10">
                        <label ng-repeat="v in data_sensor" class="m-r-2"
                            ng-class="{'label label-primary':v.kd_logger=='1','label label-success':v.kd_logger=='2','label label-inverse':v.kd_logger=='3' || v.kd_logger=='4','label label-danger':v.kd_logger=='5','label label-warning':v.kd_logger=='8' || v.kd_logger=='9'}"
                            style="font-size:13px;font-weight:normal; float:left">{{ v . nm_sensor }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" ng-if="f.plant=='002'">
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fa fa-database"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL SHARE API</h4>
                        <p>{{ data_total_api[0] . total_all }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_trs_api')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon"><i class="fa fa-database"></i></div>
                    <div class="stats-info">
                        <h4>API AKTIF</h4>
                        <p>{{ data_total_api[0] . total_aktif }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_trs_api')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-database"></i></div>
                    <div class="stats-info">
                        <h4>API NON AKTIF</h4>
                        <p>{{ data_total_api[0] . total_nonaktif }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_trs_api')); ?>">View Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_desa')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
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
            $scope.oTotalPlant = function() {
                SfService.httpGet("sys_syplant_total_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.total_plant = jdata.data.data_total_plant;
                });
            }
            $scope.oTotalHardware = function() {
                SfService.httpGet("trs_local_mst_hardware_total_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.total_hardware = jdata.data.data_total_hardware[0];
                });
            }
            $scope.oSensor = function() {
                SfService.httpGet("trs_local_mst_sensor_list2", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.data_sensor = jdata.data.data_sensor;
                });
            }
            $scope.oApi = function() {
                SfService.httpGet("trs_local_trs_api_total_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.data_total_api = jdata.data.data_total_api;
                });
            }
            $scope.oCekPlant();
            $scope.oTotalPlant();
            $scope.oTotalHardware();
            $scope.oSensor();
            $scope.oApi();

        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\bpbd\admin\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>