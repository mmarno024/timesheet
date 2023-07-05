<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Perjam <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List Perjam</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_trs_raw']); ?> <?php echo $__env->renderComponent(); ?>
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
                                    <button type="button" class="btn btn-success btn-sm"
                                        ng-click="oPdf(kd_logger,kd_hardware)"><i class="fa fa fa-file-pdf-o"></i></button>
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
                    </div>
                </div>
                <div class="container">
                    <div class="col-sm-12">
                        <div class="row" ng-show="f.tab=='list'">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Mulai dari tanggal</label>
                                    <input type="date" class="form-control input-sm" ng-model="q.date1">
                                </div>
                                <div class="col-sm-2">
                                    <label>Sampai dengan</label>
                                    <input type="date" class="form-control input-sm" ng-model="q.date2">
                                </div>
                                <div class="col-sm-2">
                                    <label style="margin-top: -5px">&nbsp;</label>
                                    <button class="btn btn-sm btn-success btn-block" ng-click="oSearch()">Load Data</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                            ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                            Back</button>
                    </div>
                </div>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is
                            deleted item<br>Trashed</div>
                        <div class="alert alert-info text-bold text-center">
                            LOGGER : {{ data_arr . nm_logger }} | LOCATION : {{ data_arr . nm_lokasi }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="div1" class="table-responsive">
                            <table class="table table-condensed table-bordered" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Time (Hour)</th>
                                        <th class="text-center">Value (Avg)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="v in data_arr.data">
                                        <td class="text-right">{{ $index + 1 }}</td>
                                        <td>{{ v . jam }}</td>
                                        <td class="text-right">{{ v . data_perjam }} {{ v . satuan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="col-sm-12">
                        <canvas id="grafik" height="310" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/fabric/fabric.min.js?ver=2019.07.17')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs/Chart.bundle.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_raw_perjam')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {
                date1: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>"),
                date2: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>")
            };
            $scope.limit = '';
            $scope.order = 'desc';
            $scope.kd_logger = "<?php echo e($request->lg); ?>";
            $scope.kd_hardware = "<?php echo e($request->hw); ?>";
            $scope.data_arr = [];

            $scope.oSearch = function() {
                SfService.httpGet(SfService.getUrl("_list"), {
                    plant: $scope.f.plant,
                    lg: $scope.kd_logger,
                    hw: $scope.kd_hardware,
                    date1: moment($scope.q.date1).format(
                        'YYYY-MM-DD 00:00:00'),
                    date2: moment($scope.q.date2).format(
                        'YYYY-MM-DD 23:59:59'),
                }, function(jdata) {
                    $scope.data_arr = jdata.data.data_arr;
                    $scope.data_arr_graph = jdata.data.data_arr_graph;

                    $scope.label_graph = [];
                    $scope.data_graph = [];
                    angular.forEach($scope.data_arr_graph, function(item_graph, key_graph) {
                        $scope.data_graph.push(item_graph.data_perjam);
                        $scope.label_graph.push(moment(item_graph.jam).format(
                            'YYYY-MM-DD HH:00'));
                    });

                    $scope.ctx = document.getElementById('grafik');
                    $scope.myChart = new Chart($scope.ctx, {
                        type: 'line',
                        data: {
                            labels: $scope.label_graph,
                            datasets: [{
                                backgroundColor: window.chartColors.red,
                                borderColor: window.chartColors.red,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: $scope.data_arr.nm_lokasi,
                                data: $scope.data_graph,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: $scope.data_arr.nm_logger,
                                fontSize: 12
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        suggestedMin: 0,
                                        // stepSize: 200,
                                        fontSize: 8
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontSize: 8
                                    }
                                }]
                            },
                            legend: {
                                labels: {
                                    boxWidth: 10,
                                    fontSize: 10
                                }
                            }
                        },
                    });

                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_logger':
                        SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.f.kd_logger = jsondata.kd_logger;
                                $scope.f.nm_logger = jsondata.nm_logger;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup2')); ?>?plant=" + $scope.f.plant +
                            "&logger=" + $scope.f.kd_logger,
                            function(id, name, jsondata) {
                                $scope.f.kd_hardware = jsondata.kd_hardware;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oPdf = function(kd_logger, kd_hardware) {
                window.open('trs_local_trs_raw_perjam_pdf?lg=' + kd_logger + '&hw=' + kd_hardware +
                    '&time1=' + moment($scope.q.date1).format(
                        'YYYY-MM-DD 00:00:00') + '&time2=' + moment($scope.q.date2).format(
                        'YYYY-MM-DD 23:59:59'));
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_raw', $scope.h.id);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin_minified', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\pln\updk\backend\resources\views/trs/local/trs_raw/trs_raw_frm_perjam.blade.php ENDPATH**/ ?>