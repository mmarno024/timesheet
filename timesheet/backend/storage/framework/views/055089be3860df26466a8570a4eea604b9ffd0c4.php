<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Detail <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="container">
                    <div class="col-sm-11">
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
                                    <label>Jenis Sensor Device</label>
                                    <select class="form-control input-sm" style="background:aquamarine" ng-model="q.sensor">
                                        <option ng-repeat="x in sensor_data" ng-value="x.kd_sensor">{{ x . nm_sensor }}
                                        </option>
                                    </select>
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
            <hr>
            <div ng-show="f.tab=='list'">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <span class="text-warning p-0 m-0">
                            <h5 ng-show="arr_raw.nm_sensor!=undefined" class="text-warning m-b-0"><span
                                    class="label label-primary">{{ arr_raw . nm_logger }} -
                                    {{ arr_raw . uid }}</span>
                            </h5>
                            <h1 class="text-warning m-t-0">{{ arr_raw . nm_sensor }}</h1>
                        </span>
                    </div>
                    <div class="col-sm-4">

                        <div class="col-sm-12 m-0 p-0">
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
                                        <tr ng-repeat="v in arr_raw.data">
                                            <td class="text-right">{{ $index + 1 }}</td>
                                            <td>{{ v . jam }}</td>
                                            <td class="text-right">{{ v . value }} {{ v . satuan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12 m-0 p-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-block btn-success btn-sm"
                                        onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i>&nbsp;Excel</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-block btn-danger btn-sm"
                                        ng-click="oPdf(arr_raw.kd_logger,arr_raw.kd_hardware,arr_raw.kd_sensor)"><i
                                            class="fa fa fa-file-pdf-o"></i>&nbsp;Pdf</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 p-0 m-0">
                        <div class="col-sm-12 p-0 m-0">
                            <canvas id="grafik" height="310" width="600"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs/Chart.bundle.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_raw_detail')); ?>");
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
            $scope.arr_raw = [];

            $scope.oSensor = function() {
                SfService.httpGet("trs_local_trs_raw_sensor", {
                    plant: $scope.f.plant,
                    lg: $scope.kd_logger,
                    hw: $scope.kd_hardware,
                }, function(jdata) {
                    $scope.sensor_data = jdata.data.sensorData;
                });
            }

            $scope.oSearch = function() {
                SfService.httpGet(SfService.getUrl("_list"), {
                    plant: $scope.f.plant,
                    lg: $scope.kd_logger,
                    hw: $scope.kd_hardware,
                    date1: moment($scope.q.date1).format(
                        'YYYY-MM-DD 00:00:00'),
                    date2: moment($scope.q.date2).format(
                        'YYYY-MM-DD 23:59:59'),
                    sensor: $scope.q.sensor,
                }, function(jdata) {
                    $scope.arr_raw = jdata.data.arr_raw;
                    $scope.arr_graph = jdata.data.arr_graph;

                    $scope.label_graph = [];
                    $scope.data_graph = [];
                    angular.forEach($scope.arr_graph, function(item_graph, key_graph) {
                        $scope.data_graph.push(item_graph.value);
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
                                label: $scope.arr_raw.nm_sensor,
                                data: $scope.data_graph,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: false,
                                text: $scope.arr_raw.nm_logger,
                                fontSize: 12
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: false,
                                        min: $scope.arr_raw.min_value,
                                        max: $scope.arr_raw.max_value,
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

            // $scope.oPdf = function(kd_logger, kd_hardware, kd_sensor) {
            //     window.open('trs_local_trs_raw_detail_pdf?lg=' + kd_logger + '&hw=' + kd_hardware + '&ss=' +
            //         kd_sensor +
            //         '&t1=' + moment($scope.q.date1).format(
            //             'YYYY-MM-DD 00:00:00') + '&t2=' + moment($scope.q.date2).format(
            //             'YYYY-MM-DD 23:59:59'));
            // }
            $scope.oPdf = function(kd_logger, kd_hardware, kd_sensor) {
                window.open('trs_local_trs_raw_detail_pdf?lg=' + kd_logger + '&hw=' + kd_hardware + '&ss=' +
                    kd_sensor +
                    '&t1=' + moment($scope.q.date1).format(
                        '2021-08-10 00:00:00') + '&t2=' + moment($scope.q.date2).format(
                        '2021-08-10 23:59:59'));
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_raw', $scope.h.id);
            }

            $scope.oSearch();
            $scope.oSensor();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin_minified', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\psda\psda\backend\resources\views/trs/local/trs_raw/trs_raw_frm_detail.blade.php ENDPATH**/ ?>