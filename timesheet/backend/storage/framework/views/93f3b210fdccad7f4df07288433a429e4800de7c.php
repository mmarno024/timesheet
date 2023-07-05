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

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            
            $scope.oCekPlant();
            
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\timesheet\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>