<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style type="text/css">
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
            padding: 2px;
            font-weight: bold;
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

    </style>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1800; URL=$url");
    ?>
    <div class="col-md-12 p-1">
        <div class="neonbox p-t-5 p-r-5 p-l-5 m-0">
            <marquee class="neonrun p-0 m-0" style="font-size:12px;" behavior="scroll" direction="left" scrollamount="2">
                RUNNING TEXT . . .
            </marquee>
        </div>
    </div>
    <div class="col-md-2 p-1">
        <div class="panel panel-birupln m-0" style="border-radius:0">
            <div class="panel-heading text-center text-bold" style="color:#fff;border-radius:0">DEVICE</div>
            <div class="panel-body p-0" style="height:555px;">
                <div data-scrollbar="true" data-height="535px" class="bg-white m-0 p-0">

                    <div class="list-group">
                        
                        <a ng-repeat="(k,v) in hardwareData" class="list-group-item item_li" style="border-radius: 0;"
                            ng-click="oView(k)">
                            <table width='100%' border='0'>
                                <tr>
                                    <td rowspan="2">
                                        <img ng-if="v.kd_logger='9'"
                                            src="<?php echo e(url('colorparalax/assets/img/gpa_marker.png')); ?>" width="20"></img>
                                    </td>
                                    <td>
                                        <b>{{ v . nm_logger }}</b> : {{ v . kd_hardware }}
                                    </td>
                                    <td rowspan="2" align="right">
                                        <span class="badge text-info m-0 p-0" style="background: rgba(76, 175, 80, 0);">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-info"
                                            style="font-size: 10px;border-radius:0;">{{ v . uid }}</span>
                                    </td>
                                </tr>
                            </table>
                            
                        </a>
                    </div>

                    

                    <div class='col-sm-12'>
                        <div ng-repeat="(kx,xx) in cobacoba">
                            <canvas id="{{ kx }}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-10 p-1">
        <div class="panel panel-birupln m-0" style="border-radius:0">
            <div class="panel-heading text-center text-bold" style="color:#fff;border-radius:0">MAP</div>
            <div class="panel-body p-1" style="height:555px;">
                
                <div class="p-0 m-0" id="map" style="width: 100%; height: 553px;"></div>
                
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', '$interval', 'NgTableParams', 'SfService', 'FileUploader', function(
            $scope, $http, $interval, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                tab: 'list',
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.d1 = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";

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
                center: [-6.2180228, 106.8341571],
                zoom: 11,
                layers: [$scope.peta1]
            });

            $scope.baseMaps = {
                "&nbsp;<i style='color:orange' class='fa fa-sun-o'></i>&nbsp;Grayscale": $scope.peta1,
                "&nbsp;<i style='color:green' class='fa fa-globe'></i>&nbsp;Satellite": $scope.peta2,
                "&nbsp;<i style='color:black' class='fa fa-road'></i>&nbsp;Streets": $scope.peta3,
                "&nbsp;<i style='color:blue' class='fa fa-moon-o'></i>&nbsp;Dark": $scope.peta4
            };

            L.control.layers(null, $scope.baseMaps, {
                collapsed: false
            }).addTo($scope.map);

            $scope.oHardware = function() {
                SfService.httpGet("trs_local_mst_hardware_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.hardwareData = jdata.data.hardwareData;

                    angular.forEach($scope.hardwareData, function(item, i) {
                        $scope.content =
                            "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" +
                            item
                            .nm_logger + " : " + item
                            .uid + "</b></div>";
                        $scope.content +=
                            "<table class='table table-condensed'>";
                        $scope.content += "<tr><td colspan='6'>";
                        $scope.content += "<table width='100%'>";
                        $scope.content +=
                            "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " +
                            item
                            .location +
                            "</i></td></tr>";
                        $scope.content +=
                            "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " +
                            item
                            .latitude + ", " + item.longitude +
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

                        angular.forEach(item.sensor, function(item1, i1) {
                            $scope.content += "<tr>";
                            $scope.content +=
                                "<td style='font-size:10px'><b>" +
                                item1
                                .rel_sensor
                                .nm_sensor +
                                "</b><i> (" + item1.rel_sensor.satuan +
                                ")</i></td>";
                            // $scope.content +=
                            //     "<td style='font-size:10px'>:</td>";
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
                            "<table width='100%'><tr><td style='font-size:10px' class='text-warning' align='left'><i class='fa fa fa-calendar'>&nbsp;</i><i>" +
                            item
                            .updated_at +
                            "</i></td><td style='font-size:10px' class='text-primary' align='right'><i class='fa fa-arrow-circle-right'>&nbsp;</i><i><a href='<?php echo url('trs_local_trs_raw_detail'); ?>?lg=" +
                            item.kd_logger + "&hw=" + item.kd_hardware +
                            "' target='_blank' style='cursor:pointer'>VIEW DETAIL</a></i></td></tr></table>";
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/gpa_marker.png')); ?>",
                            iconSize: [40, 40]
                        });
                        $scope.customOptions = {
                            'className': 'another-popup'
                        }
                        $scope.mark = L.marker([
                            parseFloat(item.latitude),
                            parseFloat(item.longitude)
                        ], {
                            icon: $scope.dataIcon
                        }).addTo($scope.map)
                        // }).addTo($scope.map).bindPopup($scope.content, {
                        //     'className': 'another-popup'
                        // })
                        $scope.pop = L.popup({
                            closeOnClick: true
                        }).setContent($scope.content);
                        $scope.tool = L.tooltip({
                            permanent: true,
                        }).setContent(item.kd_hardware);
                        $scope.mark.bindPopup($scope.pop, {
                                'className': 'another-popup'
                            })
                            // .on('click', function(){$scope.map.flyTo([53.53,  9.99], 11);})
                            //                         .on('click', function(){
                            //     $scope.map.setView([parseFloat(item.latitude), parseFloat(item.longitude)], 15);
                            // })
                            .bindTooltip($scope.tool, {
                                'className': 'another-tooltip',
                                direction: 'right'
                            });
                    });

                });
            }

            $scope.oView = function(id) {
                $scope.content =
                    "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" +
                    $scope.hardwareData[id]
                    .nm_logger + " : " + $scope.hardwareData[id]
                    .uid + "</b></div>";
                $scope.content +=
                    "<table class='table table-condensed'>";
                $scope.content += "<tr><td colspan='6'>";
                $scope.content += "<table width='100%'>";
                $scope.content +=
                    "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " +
                    $scope.hardwareData[id]
                    .location +
                    "</i></td></tr>";
                $scope.content +=
                    "<tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " +
                    $scope.hardwareData[id]
                    .latitude + ", " + $scope.hardwareData[id].longitude +
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

                angular.forEach($scope.hardwareData[id].sensor, function(item1, i1) {
                    $scope.content += "<tr>";
                    $scope.content +=
                        "<td style='font-size:10px'><b>" +
                        item1
                        .rel_sensor
                        .nm_sensor +
                        "</b><i> (" + item1.rel_sensor.satuan +
                        ")</i></td>";
                    // $scope.content +=
                    //     "<td style='font-size:10px'>:</td>";
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
                    "<table width='100%'><tr><td style='font-size:10px' class='text-warning' align='left'><i class='fa fa fa-calendar'>&nbsp;</i><i>" +
                    $scope.hardwareData[id]
                    .updated_at +
                    "</i></td><td style='font-size:10px' class='text-primary' align='right'><i class='fa fa-arrow-circle-right'>&nbsp;</i><i><a href='<?php echo url('trs_local_trs_raw_detail'); ?>?lg=" +
                    $scope.hardwareData[id].kd_logger + "&hw=" + $scope.hardwareData[id].kd_hardware +
                    "' target='_blank' style='cursor:pointer'>VIEW DETAIL</a></i></td></tr></table>";
                // $scope.content =
                //     "<div class='col-sm-12 text-center' style='font-size:12px;'><b>" +
                //     $scope.hardwareData[id]
                //     .nm_logger + " : " + $scope.hardwareData[id]
                //     .kd_hardware + "</b></div>";
                // $scope.content +=
                //     "<table class='table table-condensed'>";
                // $scope.content +=
                //     "<tr><td colspan='3'><table width='100%'><tr><td class='text-primary' style='font-size:10px' align='left'><i>Location : " +
                //     $scope.hardwareData[id]
                //     .location +
                //     "</i></td></tr><tr><td class='text-primary' style='font-size:10px' align='left'><i>Coordinate : " +
                //     $scope.hardwareData[id]
                //     .latitude + ", " + $scope.hardwareData[id].longitude +
                //     "</i></td></tr></table></td></tr>";
                // $scope.content +=
                //     "<tr><td style='font-size:10px' class='bg-green text-white' colspan='2' align='center'><b>SENSOR</b></td><td style='font-size:10px' class='bg-green text-white' align='center'><b>VALUE</b></</td></tr>";
                // angular.forEach($scope.hardwareData[id].sensor, function(item1, i1) {
                //     $scope.content +=
                //         "<tr><td style='font-size:10px'><b>" + item1
                //         .rel_sensor
                //         .nm_sensor +
                //         "</b></td><td style='font-size:10px'>:</td><td style='font-size:10px'><b>" +
                //         item1.value +
                //         "</b> <i>" + item1.rel_sensor.satuan +
                //         "</i></td></tr></tr>";
                // });
                // $scope.content += '</table>';
                // $scope.content +=
                //     "<table width='100%'><tr><td style='font-size:10px' class='text-warning' align='left'><i class='fa fa fa-calendar'>&nbsp;</i><i>" +
                //     $scope.hardwareData[id]
                //     .updated_at +
                //     "</i></td><td style='font-size:10px' class='text-primary' align='right'><i class='fa fa-arrow-circle-right'>&nbsp;</i><i><a href='<?php echo url('trs_local_trs_raw_detail'); ?>?lg=" +
                //     $scope.hardwareData[id].kd_logger + "&hw=" + $scope.hardwareData[id].kd_hardware +
                //     "' target='_blank' style='cursor:pointer'>VIEW DETAIL</a></i></td></tr></table>";

                $scope.dataIcon = L.icon({
                    iconUrl: "<?php echo e(url('colorparalax/assets/img/gpa_marker.png')); ?>",
                    iconSize: [40, 40]
                });
                $scope.customOptions = {
                    'className': 'another-popup'
                }
                $scope.mark = L.marker([
                    parseFloat($scope.hardwareData[id].latitude),
                    parseFloat($scope.hardwareData[id].longitude)
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
                }).setContent($scope.hardwareData[id].kd_hardware);
                $scope.mark.bindPopup($scope.pop, {
                        'className': 'another-popup'
                    })
                    //     on('click', function(){
                    //     $scope.map.setView([parseFloat($scope.hardwareData[id].latitude), parseFloat($scope.hardwareData[id].longitude)], 19);
                    // }).
                    .openPopup()
                    .on($scope.map.flyTo([parseFloat($scope.hardwareData[id].latitude), parseFloat($scope
                        .hardwareData[id].longitude)], 13))
                    .bindTooltip($scope.tool, {
                        'className': 'another-tooltip',
                        direction: 'right'
                    });
            }

            $scope.oHardware();

            $scope.moment = function(dt) {
                return moment(dt);
            }

        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\psda\psda\backend\resources\views/welcome.blade.php ENDPATH**/ ?>