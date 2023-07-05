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

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-black">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                <div class="stats-title">USER ACCESS</div>
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
                <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-tint"></i></div>
                <div class="stats-title">TOTAL WATER LEVEL</div>
                <div class="stats-number">{{ total_hardware }}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width:100%;"></div>
                </div>
                <div class="stats-link">
                    <a href="<?php echo e(url('/trs_local_mst_hardware')); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-th-large fa-volume-up"></i></div>
                <div class="stats-title">TOTAL EWS</div>
                <div class="stats-number">{{ total_ews }}</div>
                
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width:100%;"></div>
                </div>
                <div class="stats-link">
                    
                    <a href="<?php echo e(url('/trs_local_mst_ews')); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="map_ews" class="p-0 m-0" style="height:350px;border-radius:5px;"></div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-black">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-desktop fa-fw"></i></div>
                <div class="stats-title">Monitoring View</div>
                <div class="stats-number">All Water Level</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 70.1%;"></div>
                </div>
                <div ng-click="oDisplayAll(f.plant)" style="cursor: pointer" class="stats-desc text-right">Click here to display <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
        <div ng-repeat="vview in data_hardware" class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-desktop fa-fw"></i></div>
                
                <div class="stats-title">Single display Water Level {{ vview.kd_hardware }}</div>
                <div class="stats-number">{{ vview.location.substr(0, 15) }}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 70.1%;"></div>
                </div>
                <div ng-click="oDisplaySingle(vview.kd_hardware)" style="cursor: pointer" class="stats-desc text-right">Click here to display <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
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

            $scope.satl = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/satellite-v9'
            });
            document.getElementById('map_ews').innerHTML = "<div id='map' style='width: 100%; height: 100%; border-radius: 5px;'></div>";
            $scope.map = L.map('map', {
                center: [-2.863018, 115.628291],
                zoom: 7,
                layers: [$scope.satl],
                scrollWheelZoom: false
            });

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
            // $scope.oSensor = function() {
            //     SfService.httpGet("trs_local_mst_sensor_list2", {
            //         plant: $scope.f.plant
            //     }, function(jdata) {
            //         $scope.data_sensor = jdata.data.data_sensor;
            //     });
            // }
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
                    $scope.total_ews = jdata.data.data_total_ews;
                    $scope.data_hardware = jdata.data.data_hardware;
                    $scope.data_device = jdata.data.data_device;
                    angular.forEach($scope.data_device, function(item, i) {
                        var header_content;
                        if(item.type == 'gpa') {
                            header_content = 'WATEL LEVEL - ' + item.device;
                        } else {
                            header_content = 'EWS - ' + item.device;
                        }
                        $scope.content = "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" + header_content + "</b></div>";
                        $scope.content += "<table class='table table-condensed m-b-3'>";
                        $scope.content += "<tr><td colspan='6' class='p-3'>";
                        $scope.content += "<table width='100%'>";
                        $scope.content += "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " + item.location + "</i></td></tr>";
                        $scope.content += "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " + item.latitude + ", " + item.longitude + "</i></td></tr>";
                        $scope.content += "</table>";
                        $scope.content += "</td></tr></table>";
                        if(item.type == 'gpa') {
                            $scope.dataIcon = L.icon({
                                iconUrl: "coloradmin/assets/plugins/leaflet/images/icon_wl.png",
                                iconSize: [30, 30]
                            });
                        } else {
                            $scope.dataIcon = L.icon({
                                iconUrl: "coloradmin/assets/plugins/leaflet/images/icon_ews.png",
                                iconSize: [30, 30]
                            });
                        }
                        $scope.customOptions = {
                            'className': 'another-popup'
                        }                        
                        $scope.mark = L.marker([parseFloat(item.latitude), parseFloat(item.longitude)], {
                            icon: $scope.dataIcon
                        }).addTo($scope.map);
                        $scope.pop = L.popup({
                            closeOnClick: true
                        }).setContent($scope.content);
                        $scope.mark.bindPopup($scope.pop, {
                            'className': 'another-popup'
                        })
                    });
                });
            }
            
            $scope.oCekPlant();
            $scope.oTotalPlant();
            // $scope.oSensor();
            $scope.oApi();
            $scope.oTotalHardware();

            $scope.oDisplayAll = function(idx) {
                if($scope.f.plant == '002'){
                    window.open(SfService.getUrl('/trs_local_trs_view_ap?id='+idx));
                } else {
                    window.open(SfService.getUrl('/trs_local_trs_view_ak?id='+idx));
                }
            }

            $scope.oDisplaySingle = function(idx) {                
                if($scope.f.plant == '002'){
                    window.open(SfService.getUrl('/trs_local_trs_view_sp?id='+idx));
                } else {
                    window.open(SfService.getUrl('/trs_local_trs_view_sk?id='+idx));
                }
            }
            
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\psda\admin\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>