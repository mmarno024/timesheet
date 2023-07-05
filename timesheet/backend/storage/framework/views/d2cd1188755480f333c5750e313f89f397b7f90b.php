<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <link rel="stylesheet"
        href="<?php echo e(url('coloradmin/assets/plugins/leaflet/locatecontrol/dist/L.Control.Locate.min.css')); ?>" />
    <script src="<?php echo e(url('coloradmin/assets/plugins/leaflet/locatecontrol/src/L.Control.Locate.js')); ?>"></script>
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
        }

        .neonrun {
            font-family: "Vibur", sans-serif;
            color: #f00;
            text-shadow: 0 0 2px #FF0000, 0 0 5px #fd5353;
            background-color: #1b1b1b;
            opacity: 1;
            background-image: linear-gradient(-45deg, #1b1b1b, #1b1b1b 50%, #020209 50%, #020209);
            background-size: 4px 4px;
        }

        .another-tooltip {
            border-radius: 0px;
            color: #FFF;
            background: rgba(255, 0, 0, 0.65);
            padding: 1px;
            font-family: 'segment7';
        }

        .another-tooltip1 {
            border-radius: 0px;
            color: #FFF;
            background: rgba(0, 153, 255, 0.65);
            padding: 1px;
            font-family: 'segment7';
        }

        .another-tooltip2 {
            border-radius: 0px;
            color: #FFF;
            background: rgba(0, 204, 153, 0.65);
            padding: 1px;
            font-family: 'segment7';
        }

        .another-tooltip9 {
            border-radius: 0px;
            color: #FFF;
            background: rgba(230, 57, 0, 0.65);
            padding: 1px;
            font-family: 'segment7';
        }

        .another-popup .leaflet-popup-content-wrapper {
            border-radius: 0px;
        }

        .another-popup .leaflet-popup-tip-container {
            width: 100px;
            height: 15px;
        }

        .another-popup .leaflet-popup-tip {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .item_li {

            border-top: 1px solid #ccc;
            border-right: 0;
            border-bottom: 1px solid #ccc;
            border-left: 0;
            cursor: pointer;
        }

        .val_7s {
            font-family: 'segment7'
        }

    </style>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1800; URL=$url");
    ?>

    <div class="col-md-2 p-1">
        <div class="panel panel-primary m-0" style="border-radius:0">
            <div class="panel-heading text-center text-bold" style="color:#fff;border-radius:0">DEVICE</div>
            <div class="panel-body p-0" style="height:555px;">
                <div data-scrollbar="true" data-height="535px" class="bg-white m-0 p-0">

                    <div class="panel-group" id="accordion" style="border-radius:0">

                        <div class="panel panel-inverse overflow-hidden" ng-repeat="(k,v) in loggerData"
                            style="border-radius:0">
                            <div class=" panel-heading" style="border-radius:0;background:#2d353c;">
                                <h3 class="panel-title" style="border-radius:0">
                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                        data-parent="#accordion" href="#coll{{ v . kd_logger }}" style="border-radius:0">
                                        <i class="fa fa-plus-circle pull-right"></i>
                                        <img ng-show="v.kd_logger=='1'"
                                            src="<?php echo e(url('colorparalax/assets/img/device_blue.png')); ?>" width="15"
                                            height="15"></img>
                                        <img ng-show="v.kd_logger=='2'"
                                            src="<?php echo e(url('colorparalax/assets/img/device_green.png')); ?>" width="15"
                                            height="15"></img>
                                        <img ng-show="v.kd_logger=='9'"
                                            src="<?php echo e(url('colorparalax/assets/img/device_yellow.png')); ?>" width="15"
                                            height="15"></img>
                                        {{ v . nm_logger }}
                                    </a>
                                </h3>
                            </div>
                            <div id="coll{{ v . kd_logger }}" class="panel-collapse collapse" style="border-radius:0">
                                <div class="panel-body">
                                    <div class="list-group" style="border-radius: 0">
                                        <a style="font-size: 11px;border-radius: 0;" ng-repeat="(k1,v1) in v.hardware"
                                            class="list-group-item item_li p-l-0 p-r-0" style="border-radius: 0;"
                                            ng-click="oView(k,k1)">
                                            

                                            

                                            <table width='100%' border='0'>
                                                <tr>
                                                    <td class="val_7s">
                                                        <span
                                                            ng-class="{'val_7s text-warning':v.kd_logger=='1','val_7s text-danger':v.kd_logger=='2','val_7s text-success':v.kd_logger=='9'}">{{ v1 . kd_hardware }}</span>-{{ v1 . uid }}
                                                    </td>
                                                    
                                                    <td rowspan="3" align="right">
                                                        <span class="badge text-info m-0 p-0"
                                                            style="background: rgba(76, 175, 80, 0);">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i
                                                            ng-class="{'fa fa-map-marker text-primary':v.kd_logger=='1','fa fa-map-marker text-success':v.kd_logger=='2','fa fa-map-marker text-warning':v.kd_logger=='9'}"></i>&nbsp;<span
                                                            ng-class="{'text-primary':v.kd_logger=='1','text-success':v.kd_logger=='2','text-warning':v.kd_logger=='9'}"
                                                            style="font-size:10px;">{{ (v1 . location) | lowercase }}</span>
                                                    </td>
                                                </tr>
                                                <tr ng-show="v.kd_logger!='9'">
                                                    
                                                    <td>
                                                        <div class="btn-group"
                                                            style="width:100%;margin:-10px 0 0 0;padding:0">
                                                            <a ng-repeat="v2 in v1.sensor[0].color_step"
                                                                class="btn btn-xs btn-{{ v2 }}"
                                                                style="width:{{ 100 / v1 . sensor[0] . count_step }}%;"></a>
                                                        </div>
                                                        <div class="btn-group val_7s"
                                                            style="width:100%;margin:-20px 0 0 0;padding:0">
                                                            <a ng-repeat="v2 in v1.sensor[0].val_step"
                                                                class="btn btn-xs btn-def"
                                                                style="width:{{ 100 / v1 . sensor[0] . count_step }}%;font-size:10px;">{{ v2 }}</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-10 p-1">
        <div class="panel panel-primary m-0" style="border-radius:0">
            <div class="panel-heading text-center text-bold" style="color:#fff;border-radius:0">MAP
                <?php echo e(Auth::user()->def_plant); ?></div>
            <div class="panel-body p-0" style="height:555px;">
                <div data-scrollbar="true" data-height="555px" class="bg-white m-0 p-0">
                    <div class="p-0 m-0" id="map" style="width: 100%; height: 553px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', '$interval', 'NgTableParams', 'SfService', 'FileUploader',
            function(
                $scope, $http, $interval, NgTableParams, SfService, FileUploader) {
                SfService.setUrl("<?php echo e(url('/')); ?>");
                $scope.f = {
                    tab: 'list',
                    plant: "<?php echo e(Session::get('plant')); ?>"
                };
                $scope.h = {};
                $scope.m = [];
                $scope.d1 = [];
                $scope.loggerData = [];
                $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";

                // navigator.geolocation.getCurrentPosition(function(location) {
                //     $scope.latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

                $scope.peta1 = L.tileLayer(
                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/streets-v11'
                    });
                $scope.peta2 = L.tileLayer(
                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/satellite-v9'
                    });
                $scope.peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                });
                $scope.peta4 = L.tileLayer(
                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/dark-v10'
                    });

                $scope.map = L.map('map', {
                    center: [-0.846939, 119.857221],
                    zoom: 6,
                    layers: [$scope.peta1]
                });

                $scope.baseMaps = {
                    "&nbsp;<i style='color:orange' class='fa fa-sun-o'></i>&nbsp;Grayscale": $scope
                        .peta1,
                    "&nbsp;<i style='color:green' class='fa fa-globe'></i>&nbsp;Satellite": $scope
                        .peta2,
                    "&nbsp;<i style='color:black' class='fa fa-road'></i>&nbsp;Streets": $scope
                        .peta3,
                    "&nbsp;<i style='color:blue' class='fa fa-moon-o'></i>&nbsp;Dark": $scope.peta4
                };

                L.control.layers(null, $scope.baseMaps, {
                    collapsed: false
                }).addTo($scope.map);

                $scope.oLogger = function() {
                    SfService.httpGet("trs_local_mst_logger_data", {
                        plant: $scope.f.plant
                    }, function(jdata) {
                        $scope.loggerData = jdata.data.loggerData;

                        angular.forEach($scope.loggerData, function(item, i) {
                            angular.forEach(item.hardware, function(item1, i1) {

                                $scope.content =
                                    "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" +
                                    item.nm_logger + " " +
                                    item1.kd_hardware + " : " + item1.uid +
                                    "</b></div>";
                                $scope.content +=
                                    "<table class='table table-condensed'>";
                                $scope.content += "<tr><td colspan='6'>";
                                $scope.content += "<table width='100%'>";
                                $scope.content +=
                                    "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " +
                                    item1.location +
                                    "</i></td></tr>";
                                $scope.content +=
                                    "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " +
                                    item1.latitude + ", " + item1
                                    .longitude +
                                    "</i></td></tr>";
                                $scope.content += "</table>";
                                $scope.content += "</td></tr>";
                                $scope.content += "<tr>";
                                $scope.content +=
                                    "<td style='font-size:10px' class='bg-green text-white' align='center'><b>SENSOR</b></td>";
                                $scope.content +=
                                    "<td style='font-size:10px' class='bg-green text-white' align='center'><b>VALUE</b></td>";
                                $scope.content +=
                                    "<td style='font-size:10px' class='bg-green text-white' align='center'><b>MIN</b></td>";
                                $scope.content +=
                                    "<td style='font-size:10px' class='bg-green text-white' align='center'><b>MAX</b></td>";
                                $scope.content += "</tr>";

                                angular.forEach(item1.sensor, function(
                                    item2, i2) {
                                    $scope.content += "<tr>";
                                    $scope.satuan = item1.satuan ==
                                        null ||
                                        item1.satuan == '' ? item2
                                        .rel_sensor
                                        .satuan : item1.satuan;
                                    $scope.content +=
                                        "<td style='font-size:10px'><b>" +
                                        item2.rel_sensor.nm_sensor +
                                        "</b><i> (" + $scope
                                        .satuan +
                                        ")</i></td>";
                                    $scope.content +=
                                        "<td align='right' style='font-size:10px'><b>" +
                                        item2.value +
                                        "</b></td>";
                                    $scope.content +=
                                        "<td style='font-size:10px' class='bg-orange text-white text-right'>" +
                                        item2.cek_val.min_val +
                                        "</td>";
                                    $scope.content +=
                                        "<td style='font-size:10px' class='bg-red text-white text-right'>" +
                                        item2.cek_val.max_val +
                                        "</td>";
                                    $scope.content += "</tr>";
                                });

                                $scope.content += '</table>';
                                $scope.content +=
                                    "<table width='100%' class='m-t-0 m-b-10'><tr><td style='font-size:10px' class='text-danger' align='left'><i class='fa fa-calendar'></i>&nbsp;" +
                                    item1.updated_at +
                                    "</td></tr></table>";
                                $scope.dev_img = item1.device_img == null ?
                                    null : item1
                                    .device_img.img_name;
                                if ($scope.dev_img != null) {
                                    if (item.kd_logger == 1) {
                                        $scope.content +=
                                            "<img width='300px;' src='<?php echo url('device_img/awll/" +
                                            $scope.dev_img +
                                            "'); ?>'/>";
                                    } else if (item.kd_logger == 2) {
                                        $scope.content +=
                                            "<img width='300px;' src='<?php echo url('device_img/arl/" +
                                            $scope.dev_img +
                                            "'); ?>'/>";
                                    } else if (item.kd_logger == 9) {
                                        $scope.content +=
                                            "<img width='300px;' src='<?php echo url('device_img/gpa/" +
                                            $scope.dev_img +
                                            "'); ?>'/>";
                                    } else {
                                        $scope.content +=
                                            "<img width='300px;' src='<?php echo url('device_img/gsm/" +
                                            $scope.dev_img +
                                            "'); ?>'/>";
                                    }
                                    $scope.content +=
                                        "<table width='100%'><tr><td style='font-size:10px;' class='text-success' align='left'><i class='fa fa-camera'>&nbsp;</i><i>" +
                                        item1.device_img.date_capture +
                                        "</i></td></tr></table>";
                                }
                                $scope.content +=
                                    "<table width='100%'><tr><td style='font-size:10px' class='text-primary' align='right'>";
                                $scope.content +=
                                    "<i class='fa fa-arrow-circle-right'></i>&nbsp;<a href='<?php echo url('trs_local_trs_raw_detail'); ?>?lg=" +
                                    item.kd_logger + "&hw=" + item1
                                    .kd_hardware +
                                    "&ss=" + item1.sensor[0].kd_sensor +
                                    "' target='_blank' style='cursor:pointer'>VIEW DETAIL</a>";
                                // $scope.content += "&nbsp;|&nbsp;";
                                // $scope.content +=
                                //     "<i class='fa fa-map'></i>&nbsp;<a href='https://www.google.com/maps/dir/?api=1&origin=" +
                                //     location.coords.latitude + "," +
                                //     location.coords.longitude +
                                //     "&destination=" + item1.latitude +
                                //     "," + item1.longitude +
                                //     "' target='_blank' style='cursor:pointer'>ROUTE</a>";
                                $scope.content += "</td></tr></table>";

                                if (item.kd_logger == '1') {
                                    $scope.dataIcon = L.icon({
                                        iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_blue.png')); ?>",
                                        iconSize: [40, 40]
                                    });
                                } else if (item.kd_logger == '2') {
                                    $scope.dataIcon = L.icon({
                                        iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_green.png')); ?>",
                                        iconSize: [40, 40]
                                    });
                                } else if (item.kd_logger == '9') {
                                    $scope.dataIcon = L.icon({
                                        iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_yellow.png')); ?>",
                                        iconSize: [40, 40]
                                    });
                                } else {
                                    $scope.dataIcon = L.icon({
                                        iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_yellow.png')); ?>",
                                        iconSize: [40, 40]
                                    });
                                }
                                $scope.customOptions = {
                                    'className': 'another-popup'
                                }
                                $scope.mark = L.marker([
                                    parseFloat(item1.latitude),
                                    parseFloat(item1.longitude)
                                ], {
                                    icon: $scope.dataIcon
                                }).addTo($scope.map)
                                $scope.pop = L.popup({
                                    closeOnClick: true
                                }).setContent($scope.content);
                                $scope.tool = L.tooltip({
                                    permanent: true,
                                }).setContent(item1.kd_hardware);

                                if (item.kd_logger == '1') {
                                    $scope.mark.bindPopup($scope.pop, {
                                            'className': 'another-popup'
                                        })
                                        .bindTooltip($scope.tool, {
                                            'className': 'another-tooltip1',
                                            direction: 'right'
                                        });
                                } else if (item.kd_logger == '2') {
                                    $scope.mark.bindPopup($scope.pop, {
                                            'className': 'another-popup'
                                        })
                                        .bindTooltip($scope.tool, {
                                            'className': 'another-tooltip2',
                                            direction: 'right'
                                        });
                                } else if (item.kd_logger == '9') {
                                    $scope.mark.bindPopup($scope.pop, {
                                            'className': 'another-popup'
                                        })
                                        .bindTooltip($scope.tool, {
                                            'className': 'another-tooltip9',
                                            direction: 'right'
                                        });
                                } else {
                                    $scope.mark.bindPopup($scope.pop, {
                                            'className': 'another-popup'
                                        })
                                        .bindTooltip($scope.tool, {
                                            'className': 'another-tooltip',
                                            direction: 'right'
                                        });
                                }

                            });
                        });

                    });
                }

                $scope.oView = function(lg, hw) {
                    $scope.content =
                        "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" +
                        $scope.loggerData[lg].nm_logger + "-" + $scope.loggerData[lg].hardware[hw]
                        .kd_hardware + " : " + $scope.loggerData[lg].hardware[hw].uid +
                        "</b></div>";
                    $scope.content +=
                        "<table class='table table-condensed'>";
                    $scope.content += "<tr><td colspan='6'>";
                    $scope.content += "<table width='100%'>";
                    $scope.content +=
                        "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " +
                        $scope.loggerData[lg].hardware[hw]
                        .location +
                        "</i></td></tr>";
                    $scope.content +=
                        "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " +
                        $scope.loggerData[lg].hardware[hw]
                        .latitude + ", " + $scope.loggerData[lg].hardware[hw].longitude +
                        "</i></td></tr>";
                    $scope.content += "</table>";
                    $scope.content += "</td></tr>";
                    $scope.content += "<tr>";
                    $scope.content +=
                        "<td style='font-size:10px' class='bg-green text-white' align='center'><b>SENSOR</b></td>";
                    $scope.content +=
                        "<td style='font-size:10px' class='bg-green text-white' align='center'><b>VALUE</b></td>";
                    $scope.content +=
                        "<td style='font-size:10px' class='bg-green text-white' align='center'><b>MIN</b></td>";
                    $scope.content +=
                        "<td style='font-size:10px' class='bg-green text-white' align='center'><b>MAX</b></td>";
                    $scope.content += "</tr>";

                    angular.forEach($scope.loggerData[lg].hardware[hw].sensor, function(item1, i1) {
                        $scope.content += "<tr>";
                        $scope.satuan = $scope.loggerData[lg].hardware[hw].satuan == null ||
                            $scope
                            .loggerData[lg].hardware[hw].satuan == '' ? item1.rel_sensor
                            .satuan :
                            $scope.loggerData[lg].hardware[hw].satuan;
                        $scope.content +=
                            "<td style='font-size:10px'><b>" +
                            item1
                            .rel_sensor
                            .nm_sensor +
                            "</b><i> (" + $scope.satuan +
                            ")</i></td>";
                        $scope.content +=
                            "<td align='right' style='font-size:10px'><b>" +
                            item1.value +
                            "</b></td>";
                        $scope.content +=
                            "<td style='font-size:10px' class='bg-orange text-white text-right'>" +
                            item1.cek_val.min_val + "</td>";
                        $scope.content +=
                            "<td style='font-size:10px' class='bg-red text-white text-right'>" +
                            item1.cek_val.max_val + "</td>";
                        $scope.content += "</tr>";
                    });

                    $scope.content += '</table>';
                    $scope.content +=
                        "<table width='100%' class='m-t-0 m-b-10'><tr><td style='font-size:10px' class='text-danger' align='left'><i class='fa fa-calendar'></i>&nbsp;" +
                        $scope.loggerData[lg].hardware[hw].updated_at +
                        "</td></tr></table>";
                    $scope.dev_img = $scope.loggerData[lg].hardware[hw].device_img == null ? null :
                        $scope
                        .loggerData[lg].hardware[hw]
                        .device_img.img_name;
                    if ($scope.dev_img != null) {
                        if ($scope.loggerData[lg].kd_logger == 1) {
                            $scope.content +=
                                "<img width='300px;' src='<?php echo url('device_img/awll/" +
                                $scope.dev_img +
                                "'); ?>'/>";
                        } else if ($scope.loggerData[lg].kd_logger == 2) {
                            $scope.content +=
                                "<img width='300px;' src='<?php echo url('device_img/arl/" +
                                $scope.dev_img +
                                "'); ?>'/>";
                        } else if ($scope.loggerData[lg].kd_logger == 9) {
                            $scope.content +=
                                "<img width='300px;' src='<?php echo url('device_img/gpa/" +
                                $scope.dev_img +
                                "'); ?>'/>";
                        } else {
                            $scope.content +=
                                "<img width='300px;' src='<?php echo url('device_img/gsm/" +
                                $scope.dev_img +
                                "'); ?>'/>";
                        }
                        $scope.content +=
                            "<table width='100%'><tr><td style='font-size:10px;' class='text-success' align='left'><i class='fa fa-camera'>&nbsp;</i><i>" +
                            $scope.loggerData[lg].hardware[hw].device_img.date_capture +
                            "</i></td></tr></table>";
                    }
                    $scope.content +=
                        "<table width='100%'><tr><td style='font-size:10px' class='text-primary' align='right'>";
                    $scope.content +=
                        "<i class='fa fa-arrow-circle-right'></i>&nbsp;<a href='<?php echo url('trs_local_trs_raw_detail'); ?>?lg=" +
                        $scope.loggerData[lg].kd_logger + "&hw=" + $scope.loggerData[
                            lg]
                        .hardware[hw].kd_hardware +
                        "&ss=" + $scope.loggerData[lg].hardware[hw].sensor[0].kd_sensor +
                        "' target='_blank' style='cursor:pointer'>VIEW DETAIL</a>";
                    // $scope.content += "&nbsp;|&nbsp;";
                    // $scope.content +=
                    //     "<i class='fa fa-map'></i>&nbsp;<a href='https://www.google.com/maps/dir/?api=1&origin=" +
                    //     location.coords.latitude + "," +
                    //     location.coords.longitude +
                    //     "&destination=" + $scope.loggerData[lg].hardware[hw].latitude + "," + $scope
                    //     .loggerData[lg].hardware[hw].longitude +
                    //     "' target='_blank' style='cursor:pointer'>ROUTE</a>";
                    $scope.content += "</td></tr></table>";

                    if (lg == '1') {
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_blue.png')); ?>",
                            iconSize: [40, 40]
                        });
                    } else if (lg == '2') {
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_green.png')); ?>",
                            iconSize: [40, 40]
                        });
                    } else if (lg == '9') {
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_yellow.png')); ?>",
                            iconSize: [40, 40]
                        });
                    } else {
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/marker_yellow.png')); ?>",
                            iconSize: [40, 40]
                        });
                    }
                    $scope.customOptions = {
                        'className': 'another-popup'
                    }
                    $scope.mark = L.marker([
                        parseFloat($scope.loggerData[lg].hardware[hw].latitude),
                        parseFloat($scope.loggerData[lg].hardware[hw].longitude)
                    ], {
                        icon: $scope.dataIcon
                    }, {
                        closeOnClick: true
                    }).addTo($scope.map)

                    $scope.pop = L.popup({
                        closeOnClick: true
                    }).setContent($scope.content);
                    $scope.tool = L.tooltip({
                        permanent: false,
                    }).setContent($scope.loggerData[lg].hardware[hw].kd_hardware);
                    if (lg == '1') {
                        $scope.mark.bindPopup($scope.pop, {
                                'className': 'another-popup'
                            })
                            .openPopup()
                            .on($scope.map.flyTo([parseFloat($scope.loggerData[lg].hardware[hw]
                                    .latitude),
                                parseFloat(
                                    $scope.loggerData[lg].hardware[hw].longitude)
                            ], 13))
                            .bindTooltip($scope.tool, {
                                'className': 'another-tooltip1',
                                direction: 'right'
                            });
                    } else if (lg == '2') {
                        $scope.mark.bindPopup($scope.pop, {
                                'className': 'another-popup'
                            })
                            .openPopup()
                            .on($scope.map.flyTo([parseFloat($scope.loggerData[lg].hardware[hw]
                                    .latitude),
                                parseFloat(
                                    $scope.loggerData[lg].hardware[hw].longitude)
                            ], 13))
                            .bindTooltip($scope.tool, {
                                'className': 'another-tooltip2',
                                direction: 'right'
                            });
                    } else if (lg == '9') {
                        $scope.mark.bindPopup($scope.pop, {
                                'className': 'another-popup'
                            })
                            .openPopup()
                            .on($scope.map.flyTo([parseFloat($scope.loggerData[lg].hardware[hw]
                                    .latitude),
                                parseFloat(
                                    $scope.loggerData[lg].hardware[hw].longitude)
                            ], 13))
                            .bindTooltip($scope.tool, {
                                'className': 'another-tooltip9',
                                direction: 'right'
                            });
                    } else {
                        $scope.mark.bindPopup($scope.pop, {
                                'className': 'another-popup'
                            })
                            .openPopup()
                            .on($scope.map.flyTo([parseFloat($scope.loggerData[lg].hardware[hw]
                                    .latitude),
                                parseFloat(
                                    $scope.loggerData[lg].hardware[hw].longitude)
                            ], 13))
                            .bindTooltip($scope.tool, {
                                'className': 'another-tooltip',
                                direction: 'right'
                            });
                    }
                }

                $scope.oLogger();

                // });

                $scope.moment = function(dt) {
                    return moment(dt);
                }

            }
        ]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/sys/system/sfclient.blade.php ENDPATH**/ ?>