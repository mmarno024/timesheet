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
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="col-sm-12 m-b-10">
                    <div class="row" ng-show="f.tab=='list'">
                        <div class="row">
                            <div ng-show="kd_logger != '5'" class="col-sm-2">
                                <label>Jenis Tampilan</label>
                                <select name="vmodes" class="form-control input-sm" style="background:aquamarine"
                                    ng-options="vmode.vname for vmode in arrView" ng-change="oViewmode()"
                                    ng-model="vmodeselected">
                                    <option value="">- Pilihan Tampilan -</option>
                                </select>
                            </div>
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
                                <button class="btn btn-sm btn-primary btn-block" ng-click="oSearch()">Load Data</button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <hr>
            <div ng-show="f.tab=='list'">
                <div class="col-sm-12 m-b-20" ng-if="result=='2'">
                    <div class="col-sm-2" ng-if="result=='2'" style="float: right">
                        <button type="button" class="btn btn-sm btn-danger btn-block"
                            ng-click="oPdf(arr_raw.kd_logger,arr_raw.kd_hardware,arr_raw.kd_sensor)"><i
                                class="fa fa-download"></i>&nbsp;Pdf</button>
                    </div>
                    <div class="col-sm-2" ng-if="result=='2'" style="float: right">
                        <button type="button" class="btn btn-sm btn-success btn-block" onclick="SfExportExcel('div1')"><i
                                class="fa fa-download"></i>&nbsp;Excel</button>
                    </div>
                </div>
                <div class="col-sm-12">

                    <div ng-show="result!=2 && result!=3" ng-if="kd_logger != '5'" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="div1" class="table-responsive">
                                <canvas id="grafik" height="210" width="600"></canvas>
                            </div>
                        </div>
                    </div>

                    <div ng-show="result==2" ng-if="kd_logger != '5'" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="div1" class="table-responsive">
                                <table class="table table-condensed table-bordered" style="white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th wi class="text-center">No.</th>
                                            <th wi class="text-center">Tanggal Masuk</th>
                                            <th class="text-center">Tanggal Aktual</th>
                                            <th class="text-center">Nilai Sensor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="(k,v) in data_table">
                                            <td width="3%">{{ $index + 1 }}</td>
                                            <td width="11%">{{ v . date_in }}</td>
                                            <td width="11%">{{ v . date_act }}</td>
                                            <td width="75%">
                                                <span ng-repeat="(k1,v1) in v.sensor" class="label label-warning m-r-5 p-2"
                                                    style="font-size: 12px;font-weight: normal">
                                                    {{ v1 . sensor }} : <strong>{{ v1 . value }}</strong>
                                                    <i style="font-size: 10px;">{{ v1 . satuan }}</i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div ng-show="result==3" ng-if="kd_logger != '5'" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="gallery" class="gallery">
                                <div class="col-sm-4" ng-repeat="v in data_img">
                                    <div class="image gallery-group-1" style="width: 100%;">
                                        <div ng-if="v.kd_logger=='1'" class="image-inner">
                                            <a href="<?php echo e(url('device_img')); ?>/awll/{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="<?php echo e(url('device_img')); ?>/awll/{{ v . img_name }}" alt="" />
                                            </a>
                                            <p class="image-caption">{{ v . kd_hardware }}</p>
                                        </div>
                                        <div ng-if="v.kd_logger=='2'" class="image-inner">
                                            <a href="<?php echo e(url('device_img')); ?>/arl/{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="<?php echo e(url('device_img')); ?>/arl/{{ v . img_name }}" alt="" />
                                            </a>
                                            <p class="image-caption">{{ v . kd_hardware }}</p>
                                        </div>
                                        <div ng-if="v.kd_logger=='3'" class="image-inner">
                                            <a href="<?php echo e(url('device_img')); ?>/gsm/{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="<?php echo e(url('device_img')); ?>/gsm/{{ v . img_name }}" alt="" />
                                            </a>
                                            <p class="image-caption">{{ v . kd_hardware }}</p>
                                        </div>
                                        <div ng-if="v.kd_logger=='9'" class="image-inner">
                                            <a href="<?php echo e(url('device_img')); ?>/gpa/{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="<?php echo e(url('device_img')); ?>/gpa/{{ v . img_name }}" alt="" />
                                            </a>
                                            <p class="image-caption">{{ v . kd_hardware }}</p>
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

                    <div ng-if="kd_logger == '5'" class="col-sm-12 m-b-10">
                        <div class="col-sm-12 m-0 p-0">
                            <div id="gallery" class="gallery">
                                <div class="col-sm-4" ng-repeat="v in data_img">
                                    <div class="image gallery-group-1" style="width: 100%;">
                                        <div ng-if="v.kd_logger=='5'" class="image-inner">
                                            <a href="<?php echo e(url('device_img')); ?>/telecam/{{ v . img_name }}"
                                                data-lightbox="gallery-group-1">
                                                <img src="<?php echo e(url('device_img')); ?>/telecam/{{ v . img_name }}"
                                                    alt="" />
                                            </a>
                                            <p class="image-caption">{{ v . kd_hardware }}</p>
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
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {
                date1: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>"),
                date2: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>")
            };
            $scope.kd_logger = "<?php echo e($request->lg); ?>";
            $scope.kd_hardware = "<?php echo e($request->hw); ?>";
            $scope.view_mode = "";
            $scope.kd_hardware = "<?php echo e($request->hw); ?>";

            $scope.arrView = [{
                    "vid": 1,
                    "vname": "Tampil Grafik"
                },
                {
                    "vid": 2,
                    "vname": "Tampil Tabel"
                },
                {
                    "vid": 3,
                    "vname": "Tampil Gambar"
                }
            ];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            $scope.oViewmode = function() {
                if ($scope.vmodeselected.vid == "3") {
                    $scope.result = 3;
                } else if ($scope.vmodeselected.vid == "2") {
                    $scope.result = 2;
                } else {
                    $scope.result = 1;
                }
            }


            $scope.oSearch = function() {
                SfService.httpGet(SfService.getUrl("_list"), {
                    plant: $scope.f.plant,
                    lg: $scope.kd_logger,
                    hw: $scope.kd_hardware,
                    t1: moment($scope.q.date1).format('YYYY-MM-DD 00:00:01'),
                    t2: moment($scope.q.date2).format('YYYY-MM-DD 23:59:59'),
                }, function(jdata) {
                    $scope.uid = jdata.data.uid;
                    $scope.location = jdata.data.location;
                    $scope.data_graph = jdata.data.data_graph;
                    $scope.data_table = jdata.data.data_table;
                    $scope.data_img = jdata.data.data_img;

                    if ($scope.kd_logger != '5') {
                        if ($scope.data_table == '' || $scope.data_table == null) {
                            swal('', 'Data pada tanggal terpilih tidak ada', 'error');
                            return false;
                        }
                    } else {
                        if ($scope.data_img == '' || $scope.data_img == null) {
                            swal('', 'Data pada tanggal terpilih tidak ada', 'error');
                            return false;
                        }
                    }

                    if ($scope.kd_logger != '5') {
                        $scope.dataset = [];
                        angular.forEach($scope.data_graph.data, function(item, i) {
                            $scope.arr_dataset = {
                                backgroundColor: item.prop.color,
                                borderColor: item.prop.color,
                                borderWidth: 1.5,
                                pointRadius: 1.5,
                                fill: false,
                                label: item.prop.sensor,
                                data: item.nilai,
                            }
                            $scope.dataset.push($scope.arr_dataset);
                        });
                        $scope.dataset = {
                            labels: $scope.data_graph.label,
                            datasets: $scope.dataset
                        };

                        $scope.ctx = document.getElementById('grafik');
                        $scope.myChart = new Chart($scope.ctx, {
                            type: 'line',
                            data: $scope.dataset,
                            options: {
                                animation: false,
                                responsive: true,
                                title: {
                                    display: false,
                                    text: '-',
                                    fontSize: 12,
                                    padding: 2
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            fontSize: 8
                                        },
                                    }],
                                    xAxes: [{
                                        // type: 'time',
                                        // autoSkip: false,
                                        // time: {
                                        //     parser: 'YYYY-MM-DD HH:mm:ss',
                                        //     unit: 'hour',
                                        //     unitStepSize: 1,
                                        //     displayFormats: {
                                        //         millisecond: 'HH:mm:ss.SSS',
                                        //         second: 'HH:mm:ss',
                                        //         minute: 'HH:mm',
                                        //         hour: 'DD-MM-YYYY HH:00'
                                        //     },
                                        //     // min: $scope.time.min_time,
                                        //     // max: $scope.time.max_time,
                                        // },
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

                    }

                });
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_raw_detail', $scope.h.id);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/web_admin/backend/resources/views/trs/local/trs_raw/trs_raw_frm_detail.blade.php ENDPATH**/ ?>