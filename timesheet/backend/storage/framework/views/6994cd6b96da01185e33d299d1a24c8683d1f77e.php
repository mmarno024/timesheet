<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Image <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label>Mulai dari</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date1">
                        </div>
                        <div class="col-sm-2">
                            <label>Sampai dengan</label>
                            <input type="date" class="form-control input-sm" ng-model="q.date2">
                        </div>
                        <div ng-if="f.plant=='002'" class="col-sm-2">
                            <label>Project</label>
                            <div class="input-group">
                                <input type="text" ng-value="q.plantx + ' - ' + q.plantnamex"
                                    class="form-control input-sm m-b-5" placeholder="Choose project ...">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm m-b-5" type="button"
                                        ng-click="oLookup('plant')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Logger</label>
                            <div class="input-group">
                                <input type="text" ng-value="f.kd_logger + '' + f.nm_logger"
                                    class="form-control input-sm m-b-5" placeholder="Choose logger ...">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm m-b-5" type="button"
                                        ng-click="oLookup('kd_logger')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Hardware</label>
                            <div class="input-group">
                                <input type="text" ng-value="f.kd_hardware" class="form-control input-sm m-b-5"
                                    placeholder="Choose hardware ...">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm m-b-5" type="button"
                                        ng-click="oLookup('kd_hardware')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label style="margin-top: -5px">&nbsp;</label>
                            <button class="btn btn-sm btn-primary btn-block" ng-click="oImg()">Load Image</button>
                        </div>
                    </div>
                </div>
                <hr />

                <div class="row">

                    <div class="col-sm-12">
                        <div id="gallery" class="gallery">

                            <div class="col-sm-3" ng-repeat="v in img_data">
                                <div class="image gallery-group-1" style="width: 100%;">
                                    <div ng-if="v.kd_logger=='1'" class="image-inner">
                                        <a href="<?php echo e(url('device_img')); ?>/awll/{{ v . img_name }}"
                                            data-lightbox="gallery-group-1">
                                            <img src="<?php echo e(url('device_img')); ?>/awll/{{ v . img_name }}" alt="" />
                                        </a>
                                        <p class="image-caption">{{ v . nm_logger }} -
                                            {{ v . kd_hardware }}</p>
                                    </div>
                                    <div ng-if="v.kd_logger=='2'" class="image-inner">
                                        <a href="<?php echo e(url('device_img')); ?>/arl/{{ v . img_name }}"
                                            data-lightbox="gallery-group-1">
                                            <img src="<?php echo e(url('device_img')); ?>/arl/{{ v . img_name }}" alt="" />
                                        </a>
                                        <p class="image-caption">{{ v . nm_logger }} -
                                            {{ v . kd_hardware }}</p>
                                    </div>
                                    <div ng-if="v.kd_logger=='3'" class="image-inner">
                                        <a href="<?php echo e(url('device_img')); ?>/gsm/{{ v . img_name }}"
                                            data-lightbox="gallery-group-1">
                                            <img src="<?php echo e(url('device_img')); ?>/gsm/{{ v . img_name }}" alt="" />
                                        </a>
                                        <p class="image-caption">{{ v . nm_logger }} -
                                            {{ v . kd_hardware }}</p>
                                    </div>
                                    <div ng-if="v.kd_logger=='5'" class="image-inner">
                                        <a href="<?php echo e(url('device_img')); ?>/telecam/{{ v . img_name }}"
                                            data-lightbox="gallery-group-1">
                                            <img src="<?php echo e(url('device_img')); ?>/telecam/{{ v . img_name }}" alt="" />
                                        </a>
                                        <p class="image-caption">{{ v . nm_logger }} -
                                            {{ v . kd_hardware }}</p>
                                    </div>
                                    <div ng-if="v.kd_logger=='9'" class="image-inner">
                                        <a href="<?php echo e(url('device_img')); ?>/gpa/{{ v . img_name }}"
                                            data-lightbox="gallery-group-1">
                                            <img src="<?php echo e(url('device_img')); ?>/gpa/{{ v . img_name }}" alt="" />
                                        </a>
                                        <p class="image-caption">{{ v . nm_logger }} -
                                            {{ v . kd_hardware }}</p>
                                    </div>
                                    <div class="image-info m-0 p-0">
                                        <div class="desc m-0 p-0" style="min-height: 150px; font-size: 10px;">
                                            <table class="table table-condensed table-bordered">
                                                <tr>
                                                    <td>Filename</td>
                                                    <td>{{ v . img_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Lat, Long</td>
                                                    <td>{{ v . latitude }}, {{ v . longitude }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Location</td>
                                                    <td>{{ v . location }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Capture</td>
                                                    <td>{{ v . date_capture }}</td>
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
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_img')); ?>");
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
                date1: jsDate("<?php echo e(date('Y-m-d 00:00:01')); ?>"),
                date2: jsDate("<?php echo e(date('Y-m-d 23:59:59')); ?>"),
            };
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

            $scope.oImg = function() {
                SfService.httpGet(SfService.getUrl("_list"), {
                    plant: $scope.f.plant,
                    lg: $scope.q.kd_logger,
                    hw: $scope.q.kd_hardware,
                    order_by: $scope.order,
                    t1: moment($scope.q.date1).format(
                        'YYYY-MM-DD 00:00:01'),
                    t2: moment($scope.q.date2).format(
                        'YYYY-MM-DD 23:59:59'),
                    qplant: $scope.q.plantx,
                }, function(jdata) {
                    $scope.img_data = jdata.data.imgData;
                });
            }


            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
                    // $scope.oGallery();
                });
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'plant':
                        SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.plantx = jsondata.plant;
                                $scope.q.plantnamex = jsondata.plantname;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_logger':
                        SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.kd_logger = jsondata.kd_logger;
                                $scope.q.nm_logger = jsondata.nm_logger;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup2')); ?>?plant=" + $scope.f.plant +
                            "&logger=" + $scope.f.kd_logger,
                            function(id, name, jsondata) {
                                $scope.q.kd_hardware = jsondata.kd_hardware;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_img', $scope.h.id);
            }

            $scope.oImg();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/trs/local/trs_img/trs_img_frm.blade.php ENDPATH**/ ?>