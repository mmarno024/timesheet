<?php $__env->startSection('content'); ?>

    <style type="text/css">
        @import  url('https://fonts.googleapis.com/css?family=Orbitron');
        @import  url('https://fontlibrary.org//face/segment7');

        .xxx {
            font-family: 'segment7'
        }

    </style>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 300; URL=$url");
    ?>
    <div class="col-md-2 p-1">
        <div class="panel panel-primary m-0">
            <div class="panel-heading text-center text-bold" style="color:#ff0">LOGGER</div>
            <div class="panel-body p-0" style="height:530px;">
                <div data-scrollbar="true" data-height="510px" class="bg-white m-0 p-10">
                    <div ng-repeat="(k,v) in logger" class="p-0 m-0">
                        <table border="0" class="table table-condensed m-0 p-0">
                            <tr ng-repeat="(k1,v1) in v.hardware" class="pointer">
                                <td class="m-0 p-0">
                                    <table border="0" class="m-t-5">
                                        <tr>
                                            <td width="70%">
                                                <span class="m-t-0 m-b-5 text-bold">{{ $index + 1 }} :
                                                    {{ v1 . kd_hardware }}</span>
                                            </td>
                                            <td width="30%" align="right">
                                                <span class="label p-5 label-success">{{ v1 . nilai_perjam }} CM</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="btn-group m-t-5">
                                                    <a class="btn btn-xs btn-default" style="width:32px;"></a>
                                                    <a class="btn btn-xs btn-success" style="width:32px;"></a>
                                                    <a class="btn btn-xs btn-info" style="width:32px;"></a>
                                                    <a class="btn btn-xs btn-primary" style="width:32px;"></a>
                                                    <a class="btn btn-xs btn-warning" style="width:32px;"></a>
                                                    <a class="btn btn-xs btn-danger" style="width:32px;"></a>
                                                </div>
                                                <div class="btn-group m-t-0">
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">0</a>
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">100</a>
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">1500</a>
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">2200</a>
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">3000</a>
                                                    <a class="btn btn-xs btn-def p-2 text-right"
                                                        style="font-size:10px;width:32px;">4000</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-1">
        <div class="panel panel-primary m-0">
            <div class="panel-heading text-center text-bold" style="color:#ff0">MAP</div>
            <div class="panel-body" style="height:530px;">
                <div data-scrollbar="true" data-height="510px" class="bg-white m-0 p-0">
                    <div id="divmyCanvas" style="overflow: scroll; border: none;">
                        <canvas style="border:none 1px grey" id="myCanvas"
                            style="background-size:contain; background-repeat: no-repeat;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-1">
        <div class="panel panel-primary m-0">
            <div class="panel-heading text-center text-bold" style="color:#ff0">GRAFIK</div>
            <div class="panel-body p-0" style="height:530px;">
                <canvas id="grafik1" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12 p-1">
        <div class="panel panel-inverse m-0">
            <div class="panel-heading text-center text-bold" style="border-radius:2px;">
                <marquee style="color:greenyellow;font-weight:bold;font-size:14px" behavior="scroll" direction="left"
                    scrollamount="2">NOTE OF UPDK LAMPUNG RUNNING TEXT ...
                </marquee>
            </div>
        </div>
    </div>

    <script src="<?php echo e(url('coloradmin/assets/plugins/fabric/fabric.min.js?ver=2019.07.17')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs/Chart.bundle.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                tab: 'list',
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {
                papper_w: 570,
                papper_h: 500,
                layout_url: "uploads/trs_local_trs_mapimage/1/besai.png"
            };
            $scope.m = [];
            $scope.d1 = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";
            $scope.canvas = null;
            $scope.target = {};
            $scope.hardware = [];
            $scope.mapimage = [];

            $scope.years = ['1992', '1993', '1994', '1995', '1996'];
            $scope.labels = ['label1', 'label2', 'label3', 'label4', 'label5', 'label6'];
            $scope.prices = ['200', '250', '170', '500', '75'];

            $scope.ctx = document.getElementById("grafik1").getContext("2d");
            $scope.myChart = new Chart($scope.ctx, {
                type: 'line',
                data: {
                    labels: $scope.years,
                    datasets: [{
                        label: 'Sample Grapic',
                        data: $scope.prices,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            $scope.oGallery = function() {
                SfGetMediaList('trs_local_trs_mapimage/1/', function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oHardware = function() {
                SfService.httpGet("trs_local_mst_hardware_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.logger = jdata.data.dataHardware;
                });
            }

            $scope.oMap = function() {
                SfService.httpGet("trs_local_trs_mapimage_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.mapimage = jdata.data.dataMapImage;
                    $scope.d1 = $scope.mapimage.rel_d1;
                    $scope.oCanvas();
                });
            }

            $scope.oAll = function() {
                $scope.oGallery();
                $scope.oHardware();
                $scope.oMap();
            }

            $scope.oAll();

            $scope.oCanvas = function() {
                $scope.h.papper_w = $scope.h.papper_w == null ? 4000 : $scope.h
                    .papper_w;
                $scope.h.papper_h = $scope.h.papper_h == null ? 2000 : $scope.h
                    .papper_h;
                document.getElementById('myCanvas').width = $scope.h.papper_w;
                document.getElementById('myCanvas').height = $scope.h.papper_h;

                if ($scope.canvas != null) {
                    $scope.canvas.dispose();
                }
                $scope.canvas = new fabric.StaticCanvas('myCanvas');
                $scope.canvas.selection = false;
                $scope.canvas.on('mouse:up', function(options) {
                    if (options.target) {
                        $scope.target = options.target;
                        $scope.setPoint();
                        $scope.$apply();
                    }
                });
                fabric.Image.fromURL($scope.path + $scope.h.layout_url, function(img) {
                    $scope.canvas.setBackgroundImage(img, $scope.canvas.renderAll.bind($scope
                        .canvas), {
                        scaleX: $scope.canvas.width / img.width,
                        scaleY: $scope.canvas.height / img.height
                    });
                });

                angular.forEach($scope.d1, function(item, i) {
                    if (item.kd_hardware != null) {
                        if (item.config == null || item.config == undefined) {
                            item.config = {};
                        }
                        $scope.yyy = item;
                        item.icon = 'seven_segmen';

                        switch (item.icon) {
                            case 'npk':
                            case 'seven_segmen':
                                if (item.icon == 'npk') {
                                    var str = item.kd_hardware;
                                } else if (item.icon == 'seven_segmen') {
                                    // var str = item.kd_hardware;
                                    var str = '' + item.nilai_aktual;
                                    // var str = item.kd_hardware + '\n ' + item.nilai_terkini;
                                } else {
                                    var str = item.kd_hardware + '\n ' + item.nama;
                                }

                                var obj = new fabric.Text(str);
                                obj.set({
                                    fontFamily: 'segment7'
                                });
                                obj = $scope.makeObj(obj, item);
                                $scope.canvas.add(obj);
                                break;
                            default:
                                var obj = null;
                                break;
                        }

                    }
                });
            }

            $scope.makeObj = function(obj, item) {
                obj.left = item.config == undefined || item.config.x == undefined ?
                    100 :
                    item.config.x;
                obj.top = item.config == undefined || item.config.y == undefined ? 100 :
                    item.config.y;
                obj.angle = item.config == undefined || item.config.angle == undefined ?
                    0 :
                    item.config.angle;
                obj.scaleX = item.config == undefined || item.config.scaleX ==
                    undefined ?
                    1 : item.config.scaleX;
                obj.scaleY = item.config == undefined || item.config.scaleY ==
                    undefined ?
                    1 : item.config.scaleY;
                obj.fontSize = item.config == undefined || item.config.fontSize ==
                    undefined ? 12 : item.config.fontSize;
                obj.fontWeight = item.config == undefined || item.config.scaleY ==
                    undefined ? 'bold' : item.config.scaleY;
                obj.fill = item.config == undefined || item.config.fill == undefined ?
                    'rgb(255,0,0)' : item.config.fill;
                obj.textBackgroundColor = item.config == undefined || item.config
                    .textBackgroundColor == undefined ? 'rgb(255,255,255,0.5)' : item
                    .config.textBackgroundColor;
                obj.overline = false;
                obj.textBackgroundColor = 'rgb(0,0,0)';
                obj.data = item;
                return obj;
            }
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\besai\backend\resources\views/welcome.blade.php ENDPATH**/ ?>