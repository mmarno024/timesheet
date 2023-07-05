<?php $__env->startSection('content'); ?>

    <style type="text/css">
        @import  url('https://fonts.googleapis.com/css?family=Orbitron');
        @import  url('https://fontlibrary.org//face/segment7');

        #watermark {
            color: red;
            font-size: 15px;
            position: fixed;
            top: 200px;
            right: 60%;
            opacity: 0.5;
            z-index: 99;
        }

        .xxx {
            font-family: 'segment7'
        }

        .menu1:hover {
            background-color: #f2f2f2;
            max-height: 20px;
        }

        .button_alarm {
            background-color: #004A7F;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: none;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: Arial;
            font-size: 10px;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            -webkit-animation: glowing 1500ms infinite;
            -moz-animation: glowing 1500ms infinite;
            -o-animation: glowing 1500ms infinite;
            animation: glowing 1500ms infinite;
        }

        @-webkit-keyframes glowing {
            0% {
                background-color: #FF3B3F;
                -webkit-box-shadow: 0 0 3px #FF3B3F;
            }

            50% {
                background-color: #FF6669;
                -webkit-box-shadow: 0 0 40px #FF6669;
            }

            100% {
                background-color: #FF3B3F;
                -webkit-box-shadow: 0 0 3px #FF3B3F;
            }
        }

        @-moz-keyframes glowing {
            0% {
                background-color: #FF3B3F;
                -moz-box-shadow: 0 0 3px #FF3B3F;
            }

            50% {
                background-color: #FF6669;
                -moz-box-shadow: 0 0 40px #FF6669;
            }

            100% {
                background-color: #FF3B3F;
                -moz-box-shadow: 0 0 3px #FF3B3F;
            }
        }

        @-o-keyframes glowing {
            0% {
                background-color: #FF3B3F;
                box-shadow: 0 0 3px #FF3B3F;
            }

            50% {
                background-color: #FF6669;
                box-shadow: 0 0 40px #FF6669;
            }

            100% {
                background-color: #FF3B3F;
                box-shadow: 0 0 3px #FF3B3F;
            }
        }

        @keyframes  glowing {
            0% {
                background-color: #FF3B3F;
                box-shadow: 0 0 3px #FF3B3F;
            }

            50% {
                background-color: #FF6669;
                box-shadow: 0 0 40px #FF6669;
            }

            100% {
                background-color: #FF3B3F;
                box-shadow: 0 0 3px #FF3B3F;
            }
        }

        .neonbox {
            border-radius: 2px;
            background-color: #1b1b1b;
            opacity: 1;
            background-image: linear-gradient(-45deg, #1b1b1b, #1b1b1b 50%, #020209 50%, #020209);
            background-size: 4px 4px;
            /* background: radial-gradient(ellipse at bottom, #5091DD 0%, #030617 100%) */
        }

        .neonrun {
            font-family: "Vibur", sans-serif;
            color: #f00;
            text-shadow: 0 0 2px #FF0000, 0 0 5px #fd5353;
            /* font-weight: bold; */
            background-color: #1b1b1b;
            opacity: 1;
            background-image: linear-gradient(-45deg, #1b1b1b, #1b1b1b 50%, #020209 50%, #020209);
            background-size: 4px 4px;
        }

    </style>
    <?php
$url = $_SERVER['REQUEST_URI'];
header("Refresh: 1800; URL=$url");
?>
    <div class="col-md-12 p-1">
        
        
        <div class="neonbox p-t-5 p-r-5 p-l-5 m-0">
            <marquee class="neonrun p-0 m-0" style="font-size:16px;" behavior="scroll" direction="left" scrollamount="2">
                <span ng-repeat="v in runtext">{{ (v . nm_lokasi) | uppercase }} :
                    {{ (v . nilai_aktual) | uppercase }}
                    {{ v . satuan }}, </span>
            </marquee>
        </div>
        
        
    </div>
    <div class="col-md-2 p-1">
        <div class="panel panel-birupln m-0">
            <div class="panel-heading text-center text-bold" style="color:#fff">LOGGER</div>
            <div class="panel-body p-0" style="height:530px;">
                <div data-scrollbar="true" data-height="510px" class="bg-white m-0 p-l-5 p-r-10">
                    <div ng-repeat=" (k,v) in hardware" class="col-sm-12 p-0 m-0 pointer menu1"
                        ng-click="oRawPerjam(v.kd_logger,v.kd_hardware)"
                        style="border-bottom:1px solid #ccc;max-height:57px;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td width="60%">
                                    <span class="m-0 p-0 text-bold">{{ v . nm_lokasi }}</span>
                                    <p class="m-0">
                                        <span ng-show="v.logger_aktual==NULL || v.logger_aktual==''"
                                            class="m-0 text-warning" style="font-size:10px">Undefined date</span>
                                        <span ng-show="v.logger_aktual!=NULL && v.logger_aktual!=''"
                                            class="m-0 text-warning" style="font-size:10px">
                                            {{ moment(v . logger_aktual) . format('DD-MM-YYYY | HH:mm') }}</span>
                                </td>
                                <td ng-if="v.kd_logger == 1 && (v.nilai_aktual > 740)" width="40%"
                                    align="right" class="m-0 p-0">
                                    <span style="font-size:10px;font-weight:none;"
                                        class="button_alarm">{{ v . nilai_aktual }}
                                        {{ v . satuan }}</span>
                                </td>
                                <td ng-if="v.kd_logger == 9 && (v.nilai_aktual < 15)" width="40%"
                                    align="right" class="m-0 p-0">
                                    <span style="font-size:10px;font-weight:none;"
                                        class="button_alarm">{{ v . nilai_aktual }}
                                        {{ v . satuan }}</span>
                                </td>
                                <td ng-if="v.kd_logger == 1 && (v.nilai_aktual <= 740)" width="40%"
                                    align="right" class="m-0 p-0">
                                    <span style="font-size:10px;font-weight:none;"
                                        ng-class="{'btn btn-{{ v . color_step[0] }} btn-xs':v.nilai_aktual <= {{ v . val_step[0] }},'btn btn-{{ v . color_step[1] }} btn-xs':v.nilai_aktual > {{ v . val_step[0] }} && v.nilai_aktual <= {{ v . val_step[1] }},'btn btn-{{ v . color_step[2] }} btn-xs':v.nilai_aktual > {{ v . val_step[1] }} && v.nilai_aktual <= {{ v . val_step[2] }},'btn btn-{{ v . color_step[3] }} btn-xs':v.nilai_aktual > {{ v . val_step[2] }} && v.nilai_aktual <= {{ v . val_step[3] }},'btn btn-{{ v . color_step[4] }} btn-xs':v.nilai_aktual >= {{ v . val_step[3] }}}">{{ v . nilai_aktual }}
                                        {{ v . satuan }}
                                    </span>
                                </td>
                                <td ng-if="v.kd_logger == 9 && (v.nilai_aktual >= 15)" width="40%"
                                    align="right" class="m-0 p-0">
                                    <span style="font-size:10px;font-weight:none;"
                                        ng-class="{'btn btn-{{ v . color_step[0] }} btn-xs':v.nilai_aktual <= {{ v . val_step[0] }},'btn btn-{{ v . color_step[1] }} btn-xs':v.nilai_aktual > {{ v . val_step[0] }} && v.nilai_aktual <= {{ v . val_step[1] }},'btn btn-{{ v . color_step[2] }} btn-xs':v.nilai_aktual > {{ v . val_step[1] }} && v.nilai_aktual <= {{ v . val_step[2] }},'btn btn-{{ v . color_step[3] }} btn-xs':v.nilai_aktual > {{ v . val_step[2] }} && v.nilai_aktual <= {{ v . val_step[3] }},'btn btn-{{ v . color_step[4] }} btn-xs':v.nilai_aktual >= {{ v . val_step[3] }}}">{{ v . nilai_aktual }}
                                        {{ v . satuan }}
                                    </span>
                                </td>
                                <td ng-if="v.kd_logger == 2 && (v.nilai_aktual > 50)" width="40%" align="right">
                                    <span style="font-size:10px;font-weight:none;"
                                        class="button_alarm">{{ v . nilai_aktual }}
                                        {{ v . satuan }}</span>
                                </td>
                                <td ng-if="v.kd_logger == 2 && (v.nilai_aktual <= 50)" width="40%" align="right">
                                    <span style="font-size:10px;font-weight:none;"
                                        ng-class="{'btn btn-{{ v . color_step[0] }} btn-xs':v.nilai_aktual <= {{ v . val_step[0] }},'btn btn-{{ v . color_step[1] }} btn-xs':v.nilai_aktual > {{ v . val_step[0] }} && v.nilai_aktual <= {{ v . val_step[1] }},'btn btn-{{ v . color_step[2] }} btn-xs':v.nilai_aktual > {{ v . val_step[1] }} && v.nilai_aktual <= {{ v . val_step[2] }},'btn btn-{{ v . color_step[3] }} btn-xs':v.nilai_aktual > {{ v . val_step[2] }}}">{{ v . nilai_aktual }}
                                        {{ v . satuan }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td ng-if="v.kd_logger==1 || v.kd_logger==9" colspan=" 2" style="width:100%;padding:0">
                                    <div class="btn-group" style="width:100%;margin:-15px 0 0 0;padding:0">
                                        <a ng-repeat="(key,col) in v . color_step"
                                            class="btn btn-xs btn-{{ col }}" style="width:20%;"></a>
                                    </div>
                                    <div class=" btn-group" style="width:100%;margin:-30px 0 0 0;padding:0">
                                        <a ng-repeat=" v1 in v.val_step" class="btn btn-xs btn-def p-2 text-right"
                                            style="font-size:10px;width:20%;">{{ v1 }}</a>
                                    </div>
                                </td>
                                <td ng-if="v.kd_logger==2" colspan=" 2" style="width:100%;padding:0">
                                    <div class="btn-group" style="width:100%;margin:-15px 0 0 0;padding:0">
                                        <a ng-repeat="(key,col) in v . color_step"
                                            class="btn btn-xs btn-{{ col }}" style="width:25%;"></a>
                                    </div>
                                    <div class="btn-group" style="width:100%;margin:-30px 0 0 0;padding:0">
                                        <a ng-repeat="v1 in v.val_step" class="btn btn-xs btn-def p-2 text-right"
                                            style="font-size:10px;width:25%;">{{ v1 }}</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-1">
        <div class="panel panel-birupln m-0">
            <div class="panel-heading text-center text-bold" style="color:#fff">MAP</div>
            <div class="panel-body" style="height:530px;">
                <div data-scrollbar="true" data-height="510px" class="bg-white m-0 p-0">
                    <div id="divmyCanvas" style="border: none;">
                        <canvas style="border:none 1px grey;" id="myCanvas"
                            style="background-size:contain; background-repeat: no-repeat;">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-1">
        <div class="panel panel-birupln m-0">
            <div class="panel-heading text-center text-bold" style="color:#fff">GRAFIK</div>
            <div class="panel-body p-0" style="height:530px;">
                <div data-scrollbar="true" data-height="510px" class="bg-white m-0 p-0">
                    <canvas id="grafikVir" height="210" width="600"></canvas>
                    <canvas id="grafikAwll" height="230" width="600"></canvas>
                    <canvas id="grafikArl" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/fabric/fabric.min.js?ver=2019.07.17')); ?>"></script>
    
    <script>
        app.controller('mainCtrl', ['$scope', '$http', '$interval', 'NgTableParams', 'SfService', 'FileUploader', function(
            $scope, $http, $interval, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                tab: 'list',
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {
                papper_w: 600,
                papper_h: 500,
                layout_url: "uploads/trs_local_trs_mapimage/1/besai.png"
            };
            $scope.m = [];
            $scope.d1 = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";
            $scope.canvas = null;
            $scope.target = {};
            $scope.hardware = [];
            $scope.runtext = [];
            $scope.mapimage = [];

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
                    $scope.hardware = jdata.data.dataHardware;
                });
            }

            $scope.oRuntext = function() {
                SfService.httpGet("trs_local_mst_hardware_runtext", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.runtext = jdata.data.runtext;
                });
            }

            $scope.oRawPerjam = function(kd_logger, kd_hardware) {
                window.open('trs_local_trs_raw_perjam?lg=' + kd_logger + '&hw=' + kd_hardware);
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
                $scope.oRuntext();
                $scope.oMap();
            }

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
                fabric.Image.fromURL("<?php echo e(url('colorparalax/assets/img/besai.png')); ?>", function(img) {
                    $scope.canvas.setBackgroundImage(img, $scope.canvas.renderAll.bind(
                        $scope
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
                        switch (item.icon) {
                            case 'hardware':
                            case 'seven_segmen':
                            case 'lokasi':
                                if (item.icon == 'hardware') {
                                    var str = item.kd_hardware;
                                } else if (item.icon == 'seven_segmen') {
                                    if (item.kd_logger == '1' && item.nilai_aktual != null) {
                                        var str = item.nilai_aktual.toPrecision(5) + '';
                                    } else if (item.kd_logger == '9' && item.nilai_aktual != null) {
                                        var str = item.nilai_aktual.toPrecision(5) + '';
                                    } else if (item.kd_logger == '2' && item.nilai_aktual != null) {
                                        var str = item.nilai_aktual.toPrecision(3) + '';
                                    } else {
                                        var str = item.nilai_aktual + '';
                                    }
                                    var obj = new fabric.Text(str);
                                    obj.set({
                                        fontFamily: 'segment7'
                                    });
                                } else if (item.icon == 'lokasi') {
                                    var str = '' + item.nm_lokasi + ' (' + item.satuan + ')';
                                    var obj = new fabric.Text(str);
                                    obj.set({
                                        fontFamily: 'Tahoma'
                                    });
                                } else {
                                    var str = item.kd_hardware + '\n ' + item.nilai_aktual;
                                }
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
                obj.data = item;
                return obj;
            }

            $scope.oGraphVir = function() {
                SfService.httpGet("trs_local_trs_raw_graphVir", {
                    plant: $scope.f.plant
                }, function(jsondata) {
                    $scope.data_arr_vir = jsondata.data.data_arr_vir;
                    $scope.label_vir = [];
                    $scope.data_vir = [];
                    angular.forEach($scope.data_arr_vir, function(item_vir, key_vir) {
                        $scope.data_vir.push(item_vir.log8549);
                        $scope.label_vir.push(moment(item_vir.jam_vir).format(
                            'HH:00'));
                    });
                    $scope.ctxVir = document.getElementById('grafikVir');
                    $scope.myChart = new Chart($scope.ctxVir, {
                        type: 'line',
                        data: {
                            labels: $scope.label_vir,
                            datasets: [{
                                backgroundColor: window.chartColors.red,
                                borderColor: window.chartColors.red,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Inflow',
                                data: $scope.data_vir,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'INFLOW',
                                fontSize: 12,
                                padding: 2
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        suggestedMin: 0,
                                        stepSize: 50,
                                        min: 0,
                                        max: 200,
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

            $scope.oGraphAwll = function() {
                SfService.httpGet("trs_local_trs_raw_graphAwll", {
                    plant: $scope.f.plant
                }, function(jsondata) {
                    $scope.data_arr_awll = jsondata.data.data_arr_awll;
                    $scope.label_awll = [];
                    $scope.data_awll8495 = [];
                    $scope.data_awll8515 = [];
                    $scope.data_awll8548 = [];
                    angular.forEach($scope.data_arr_awll, function(item_awll, key_awll) {
                        $scope.data_awll8495.push(item_awll.data.data8495);
                        $scope.data_awll8515.push(item_awll.data.data8515);
                        $scope.data_awll8548.push(item_awll.data.data8548);
                        $scope.label_awll.push(moment(item_awll.jam_awll).format(
                            'HH:00'));
                    });
                    $scope.ctxAwll = document.getElementById('grafikAwll');
                    $scope.myChart = new Chart($scope.ctxAwll, {
                        type: 'line',
                        data: {
                            labels: $scope.label_awll,
                            datasets: [{
                                backgroundColor: window.chartColors.red,
                                borderColor: window.chartColors.red,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Sukapura',
                                data: $scope.data_awll8495,
                            }, {
                                backgroundColor: window.chartColors.blue,
                                borderColor: window.chartColors.blue,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Petai',
                                data: $scope.data_awll8515,
                            }, {
                                backgroundColor: window.chartColors.orange,
                                borderColor: window.chartColors.orange,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Inflow',
                                data: $scope.data_awll8548,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'AWLL',
                                fontSize: 12,
                                padding: 2
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        suggestedMin: 0,
                                        stepSize: 100,
                                        min: 710,
                                        max: 750,
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

            $scope.oGraphArl = function() {
                SfService.httpGet("trs_local_trs_raw_graphArl", {
                    plant: $scope.f.plant
                }, function(jsondata) {
                    $scope.data_arr_arl = jsondata.data.data_arr_arl;
                    $scope.label_arl = [];
                    $scope.data_arl3829 = [];
                    $scope.data_arl3832 = [];
                    $scope.data_arl3837 = [];
                    $scope.data_arl3838 = [];
                    $scope.data_arl3840 = [];
                    angular.forEach($scope.data_arr_arl, function(item_arl, key_arl) {
                        $scope.data_arl3829.push(item_arl.data.data3829);
                        $scope.data_arl3832.push(item_arl.data.data3832);
                        $scope.data_arl3837.push(item_arl.data.data3837);
                        $scope.data_arl3838.push(item_arl.data.data3838);
                        $scope.data_arl3840.push(item_arl.data.data3840);
                        $scope.label_arl.push(moment(item_arl.jam_arl).format(
                            'HH:00'));
                    });
                    $scope.ctxArl = document.getElementById('grafikArl');
                    $scope.myChart = new Chart($scope.ctxArl, {
                        type: 'line',
                        data: {
                            labels: $scope.label_arl,
                            datasets: [{
                                backgroundColor: window.chartColors.red,
                                borderColor: window.chartColors.red,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Sb. Jaya',
                                data: $scope.data_arl3829,
                            }, {
                                backgroundColor: window.chartColors.blue,
                                borderColor: window.chartColors.blue,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Purajaya',
                                data: $scope.data_arl3832,
                            }, {
                                backgroundColor: window.chartColors.orange,
                                borderColor: window.chartColors.orange,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Rw. Bebek',
                                data: $scope.data_arl3837,
                            }, {
                                backgroundColor: window.chartColors.purple,
                                borderColor: window.chartColors.purple,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Gn. Terang',
                                data: $scope.data_arl3838,
                            }, {
                                backgroundColor: window.chartColors.green,
                                borderColor: window.chartColors.green,
                                borderWidth: 1,
                                pointRadius: 2,
                                lineTension: 0,
                                fill: false,
                                label: 'Mutaralam',
                                data: $scope.data_arl3840,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'ARL',
                                fontSize: 12,
                                padding: 2
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        suggestedMin: 0,
                                        // stepSize: 5,
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

            $scope.moment = function(dt) {
                return moment(dt);
            }

            $scope.oAll();
            $scope.oGraphVir();
            $scope.oGraphAwll();
            $scope.oGraphArl();
            $scope.oCanvas();

            $interval(function() {
                $scope.oAll();
            }, 50000);
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\pln\updk\backend\resources\views/welcome.blade.php ENDPATH**/ ?>