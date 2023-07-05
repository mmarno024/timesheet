<?php $__env->startSection('content'); ?>

    <script type="text/javascript" src="<?php echo e(url('coloradmin')); ?>/assets/plugins/fusioncharts-suite-xt/js/fusioncharts.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('coloradmin')); ?>/assets/plugins/fusioncharts-suite-xt/integrations/angularjs/js/angular-fusioncharts.min.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('coloradmin')); ?>/assets/plugins/fusioncharts-suite-xt/js/themes/fusioncharts.theme.fusion.js">
    </script>
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
    <div class="col-md-3 p-1">
        <div class="panel panel-primary m-0">
            <div class="panel-heading text-center text-bold" style="color:#ff0">SENSOR</div>
            <div class="panel-body p-0" style="height:470px;">
                <div data-scrollbar="true" data-height="450px" class="bg-white m-0 p-0">
                    <div ng-repeat="(k,v) in logger" class="p-0 m-0">
                        <table class="table table-condensed m-0">
                            <tr ng-repeat="(k1,v1) in v.hardware" class="pointer">
                                <td>
                                    <table border="0">
                                        <tr>
                                            <td width="80%">
                                                <span class="m-t-0 m-b-5 text-bold">ID : {{ v1 . kd_hardware }}</span>
                                                <span class="label p-5 label-inverse">{{ v . nm_logger }}</span>
                                            </td>
                                            <td rowspan="2" width="20%">
                                                <button class="btn btn-danger p-3">4000 cm</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="btn-group m-t-5">
                                                    <a class="btn btn-default" style="width:30px;"></a>
                                                    <a class="btn btn-success" style="width:30px;"></a>
                                                    <a class="btn btn-info" style="width:30px;"></a>
                                                    <a class="btn btn-primary" style="width:30px;"></a>
                                                    <a class="btn btn-warning" style="width:30px;"></a>
                                                    <a class="btn btn-danger" style="width:30px;"></a>
                                                </div>
                                                <div class="btn-group m-t-5">
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">0</a>
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">100</a>
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">1500</a>
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">2200</a>
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">3000</a>
                                                    <a class="btn btn-def p-2 text-center"
                                                        style="font-size:10px;width:30px;">4000</a>
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
            <div class="panel-body" style="height:470px;">
                <div data-scrollbar="true" data-height="450px" class="bg-white m-0 p-0">
                    
                    <div id="divmyCanvas" style="overflow: scroll; border: none;">
                        <canvas style="border:none 1px grey" id="myCanvas"
                            style="background-size:contain; background-repeat: no-repeat;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 p-1">
        <div class="panel panel-primary m-0">
            <div class="panel-heading text-center text-bold" style="color:#ff0">GRAFIK</div>
            <div class="panel-body p-0" style="height:470px;">
                <div data-scrollbar="true" data-height="450px" class="bg-white m-0 p-0">
                    <div fusioncharts id="my-chart-id1" width="100%" height="150" type="msspline"
                        dataSource="{{ myDataSource1 }}"></div>
                    <div fusioncharts id="my-chart-id1" width="100%" height="180" type="msspline"
                        dataSource="{{ myDataSource2 }}"></div>
                    <div fusioncharts id="my-chart-id1" width="100%" height="210" type="msspline"
                        dataSource="{{ myDataSource3 }}"></div>
                </div>
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
    <script>
        app.requires.push('ng-fusioncharts');
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                tab: 'list',
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {
                papper_w: 550,
                papper_h: 460,
                layout_url: "uploads/trs_local_trs_mapimage/1/besai.png"
            };
            $scope.m = [];
            $scope.d1 = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";
            $scope.canvas = null;
            $scope.target = {};
            $scope.hardware = [];
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
                                    var str = item.kd_hardware;
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

            $scope.myDataSource1 = {
                chart: {
                    caption: "INFLOW",
                    showhovereffect: "1",
                    numbersuffix: "",
                    drawcrossline: "1",
                    plottooltext: "<b>$dataValue</b> of youth were on $seriesName",
                    theme: "fusion",
                    captionfontsize: "3rem",
                    subcaptionfontsize: "1vw",
                    basefontsize: "1vw",
                    outcnvbasefontsize: "1vw",
                    labelfontsize: "1rem",
                    valuefontsize: "50%",
                    xaxisnamefontsize: "2vw",
                    yaxisnamefontsize: "2vw",
                    yaxisvaluefontsize: "1vw",
                    trendvaluefontsize: 14,
                    numVDivLines: "5",
                    vDivLineColor: "#99ccff",
                    vDivLineThickness: "1",
                    vDivLineAlpha: "50",
                    showAlternateVGridColor: "1",
                    legendNumColumns: "5",
                    legendIconScale: "0.5",
                    legendvaluefontsize: 10,
                    showLegend: "0"
                },
                categories: [{
                    category: [{
                            label: "2012"
                        },
                        {
                            label: "2013"
                        },
                        {
                            label: "2014"
                        },
                        {
                            label: "2015"
                        },
                        {
                            label: "2016"
                        }
                    ]
                }],
                dataset: [{
                    seriesname: "A",
                    data: [{
                            value: "62"
                        },
                        {
                            value: "64"
                        },
                        {
                            value: "64"
                        },
                        {
                            value: "66"
                        },
                        {
                            value: "78"
                        }
                    ]
                }]
            };

            $scope.myDataSource2 = {
                chart: {
                    caption: "ARL",
                    showhovereffect: "1",
                    numbersuffix: "",
                    drawcrossline: "1",
                    plottooltext: "<b>$dataValue</b> of youth were on $seriesName",
                    theme: "fusion",
                    captionfontsize: "3rem",
                    subcaptionfontsize: "1vw",
                    basefontsize: "1vw",
                    outcnvbasefontsize: "1vw",
                    labelfontsize: "1rem",
                    valuefontsize: "50%",
                    xaxisnamefontsize: "2vw",
                    yaxisnamefontsize: "2vw",
                    yaxisvaluefontsize: "1vw",
                    trendvaluefontsize: 14,
                    numVDivLines: "5",
                    vDivLineColor: "#99ccff",
                    vDivLineThickness: "1",
                    vDivLineAlpha: "50",
                    showAlternateVGridColor: "1",
                    legendNumColumns: "5",
                    legendIconScale: "0.5",
                    legendvaluefontsize: 10
                },
                categories: [{
                    category: [{
                            label: "2012"
                        },
                        {
                            label: "2013"
                        },
                        {
                            label: "2014"
                        },
                        {
                            label: "2015"
                        },
                        {
                            label: "2016"
                        }
                    ]
                }],
                dataset: [{
                        seriesname: "A",
                        data: [{
                                value: "62"
                            },
                            {
                                value: "64"
                            },
                            {
                                value: "64"
                            },
                            {
                                value: "66"
                            },
                            {
                                value: "78"
                            }
                        ]
                    },
                    {
                        seriesname: "B",
                        data: [{
                                value: "16"
                            },
                            {
                                value: "28"
                            },
                            {
                                value: "34"
                            },
                            {
                                value: "42"
                            },
                            {
                                value: "54"
                            }
                        ]
                    },
                    {
                        seriesname: "C",
                        data: [{
                                value: "18"
                            },
                            {
                                value: "19"
                            },
                            {
                                value: "21"
                            },
                            {
                                value: "21"
                            },
                            {
                                value: "24"
                            }
                        ]
                    }
                ]
            };

            $scope.myDataSource3 = {
                chart: {
                    caption: "AWLL",
                    showhovereffect: "1",
                    numbersuffix: "",
                    drawcrossline: "1",
                    plottooltext: "<b>$dataValue</b> of youth were on $seriesName",
                    theme: "fusion",
                    captionfontsize: "3rem",
                    subcaptionfontsize: "1vw",
                    basefontsize: "1vw",
                    outcnvbasefontsize: "1vw",
                    labelfontsize: "1rem",
                    valuefontsize: "50%",
                    xaxisnamefontsize: "2vw",
                    yaxisnamefontsize: "2vw",
                    yaxisvaluefontsize: "1vw",
                    trendvaluefontsize: 14,
                    numVDivLines: "5",
                    vDivLineColor: "#99ccff",
                    vDivLineThickness: "1",
                    vDivLineAlpha: "50",
                    showAlternateVGridColor: "1",
                    legendNumColumns: "5",
                    legendIconScale: "0.5",
                    legendvaluefontsize: 10
                },
                categories: [{
                    category: [{
                            label: "2012"
                        },
                        {
                            label: "2013"
                        },
                        {
                            label: "2014"
                        },
                        {
                            label: "2015"
                        },
                        {
                            label: "2016"
                        }
                    ]
                }],
                dataset: [{
                        seriesname: "A",
                        data: [{
                                value: "62"
                            },
                            {
                                value: "64"
                            },
                            {
                                value: "64"
                            },
                            {
                                value: "66"
                            },
                            {
                                value: "78"
                            }
                        ]
                    },
                    {
                        seriesname: "B",
                        data: [{
                                value: "16"
                            },
                            {
                                value: "28"
                            },
                            {
                                value: "34"
                            },
                            {
                                value: "42"
                            },
                            {
                                value: "54"
                            }
                        ]
                    },
                    {
                        seriesname: "C",
                        data: [{
                                value: "18"
                            },
                            {
                                value: "19"
                            },
                            {
                                value: "21"
                            },
                            {
                                value: "21"
                            },
                            {
                                value: "24"
                            }
                        ]
                    },
                    {
                        seriesname: "D",
                        data: [{
                                value: "20"
                            },
                            {
                                value: "10"
                            },
                            {
                                value: "25"
                            },
                            {
                                value: "27"
                            },
                            {
                                value: "14"
                            }
                        ]
                    },
                    {
                        seriesname: "E",
                        data: [{
                                value: "10"
                            },
                            {
                                value: "20"
                            },
                            {
                                value: "17"
                            },
                            {
                                value: "23"
                            },
                            {
                                value: "27"
                            }
                        ]
                    }
                ]
            };
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/welcome.blade.php ENDPATH**/ ?>