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
    <style type="text/css">
        @import  url('https://fonts.googleapis.com/css?family=Orbitron');
        .another-popup .leaflet-popup-content-wrapper {
            border-radius: 0px;
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/leaflet.css" />
    <link rel="stylesheet"
        href="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/locatecontrol/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet"
        href="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/markercluster-1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet"
        href="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/markercluster-1.4.1/dist/MarkerCluster.Default.css" />
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/leaflet.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/locatecontrol/src/L.Control.Locate.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/leaflet/markercluster-1.4.1/dist/leaflet.markercluster-src.js">
    </script>

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
            <div ng-if="total_hardware.total_gpa!=0" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-orange">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-fw"></i></div>
                    <div class="stats-title">TOTAL HARDWARE</div>
                    <div class="stats-number">{{ total_hardware }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width:100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <div ng-if="f.plant=='002'" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-fw"></i></div>
                    <div class="stats-title">SHARE API</div>
                    <div class="stats-number">{{ data_total_api[0] . total_all }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width:100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo e(url('/trs_local_trs_api')); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-black">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-desktop fa-fw"></i></div>
                    <div class="stats-title">Monitoring View :</div>
                    <div class="stats-number">All Hardware</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div style="cursor: pointer" class="stats-desc text-right">Click here to display <i class="fa fa-arrow-circle-right"></i>
                    </div>
                </div>
            </div>

            <div ng-repeat="vview in data_hardware" class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-desktop fa-fw"></i></div>
                    <div class="stats-title">Hardware : {{ vview.kd_hardware }}</div>
                    <div class="stats-number">{{ vview.location.substr(0, 15) }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div style="cursor: pointer" class="stats-desc text-right">Click here to display <i class="fa fa-arrow-circle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            
        </div>
    </div>

    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};

            // $scope.gray = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            //         '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            //         'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //     id: 'mapbox/streets-v11'
            // });
            // $scope.satl = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            //         '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            //         'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //     id: 'mapbox/satellite-v9'
            // });
            // $scope.map = L.map('map', {
            //     center: [-1.506745, 117.183856],
            //     zoom: 5,
            //     layers: [$scope.gray]
            // });
            // $scope.baseMaps = {
            //     "&nbsp;<i style='color:orange' class='fa fa-sun-o'></i>&nbsp;Grayscale": $scope.gray,
            //     "&nbsp;<i style='color:green' class='fa fa-globe'></i>&nbsp;Satellite": $scope.satl,
            // };
            // L.control.layers(null, $scope.baseMaps, {
            //     collapsed: false,
            //     position: 'topright',
            // }).addTo($scope.map);
            // $scope.dataIcon = L.icon({
            //     iconUrl: "coloradmin/assets/plugins/leaflet/images/icon_gpa.png",
            //     iconSize: [30, 30]
            // });
            // $scope.customOptions = {
            //     'className': 'another-popup'
            // }
            // $scope.mark = L.marker([
            //     parseFloat(-7.741757),
            //     parseFloat(110.378529)
            // ], {
            //     icon: $scope.dataIcon
            // }).addTo($scope.map);
            // $scope.content = "dkbnskdfbdksn";
            // $scope.pop = L.popup({
            //     closeOnClick: true
            // }).setContent($scope.content);

            // $scope.mark.bindPopup($scope.pop, {
            //     'className': 'another-popup'
            // })
            
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
            
            $scope.oTotalHardware = function() {
                SfService.httpGet("trs_local_mst_hardware_total_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.total_hardware = jdata.data.data_total_hardware;
                    $scope.data_hardware = jdata.data.data_hardware;
                });
            }
            
            $scope.oCekPlant();
            $scope.oTotalPlant();
            $scope.oSensor();
            $scope.oApi();
            $scope.oTotalHardware();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\psda\admin\backend\resources\views/welcome.blade.php ENDPATH**/ ?>