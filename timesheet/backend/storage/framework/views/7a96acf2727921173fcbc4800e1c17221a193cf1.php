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

    </style>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1800; URL=$url");
    ?>
    <div class="col-md-12 p-1">
        <div class="neonbox p-t-5 p-r-5 p-l-5 m-0">
            <marquee class="neonrun p-0 m-0" style="font-size:16px;" behavior="scroll" direction="left" scrollamount="2">
                RUNNING TEXT . . .
            </marquee>
        </div>
    </div>
    <div class="col-md-3 p-1">
        <div class="panel panel-birupln m-0">
            <div class="panel-heading text-center text-bold" style="color:#fff">DEVICE</div>
            <div class="panel-body p-0" style="height:555px;">
                <div data-scrollbar="true" data-height="535px" class="bg-white m-0 p-0">

                    <div class="panel-group m-0" style="border-bottom:1px solid #ddd;" id="accordion"
                        ng-repeat="(k,v) in hardware">
                        <div class="panel panel-default overflow-hidden" style="border-radius: 0;">
                            <div class="panel-heading" style="border-radius: 0;">
                                <h3 class="panel-title" style="color:#666;">
                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                        data-parent="#accordion" href="#menu{{ k }}">
                                        <i class="fa fa-plus-circle pull-right"></i>
                                        {{ v . logger }} {{ v . kd_hardware }}
                                    </a>
                                </h3>
                            </div>
                            <div id="menu{{ k }}" class="panel-collapse collapse">
                                <div class="panel-body m-5 p-5">
                                    Diisi Grafik<p>
                                        <code class="m-b-0">Detail</code>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="col-md-9 p-1">
        <div class="panel panel-birupln m-0">
            <div class="panel-heading text-center text-bold" style="color:#fff">MAP</div>
            <div class="panel-body p-1" style="height:555px;">
                <div data-scrollbar="true" data-height="555px" class="bg-white m-0 p-0">
                    <div class="p-0 m-0" id="map" style="width: 100%; height: 554px;"></div>
                </div>
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
            $scope.hardware = [];

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
                "Grayscale": $scope.peta1,
                "Satellite": $scope.peta2,
                "Streets": $scope.peta3,
                "Dark": $scope.peta4
            };

            L.control.layers($scope.baseMaps).addTo($scope.map);

            $scope.oHardware = function() {
                SfService.httpGet("trs_local_mst_hardware_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.hardware = jdata.data.hardwareData;

                    angular.forEach($scope.hardware, function(item, i) {
                        $scope.content =
                            "<table class='table'><tr><td align='center'><b>SENSOR</b></td><td colspan='2' align='center'><b>VALUE</b></</td></tr>";
                        angular.forEach(item.sensor, function(item1, i1) {
                            $scope.content +=
                                "<tr><td>" + item1.rel_sensor.nm_sensor +
                                "</td><td>:</td><td>" + item1.value +
                                " <i>" + item1.rel_sensor.satuan +
                                "</i></td></tr></tr>";
                        });
                        $scope.content += '</table>';
                        $scope.dataIcon = L.icon({
                            iconUrl: "<?php echo e(url('colorparalax/assets/img/storm.png')); ?>",
                            iconSize: [58, 65]
                        });
                        L.marker([
                            parseFloat(item.latitude),
                            parseFloat(item.longitude)
                        ], {
                            icon: $scope.dataIcon
                        }).addTo($scope.map).bindPopup(String($scope.content))

                    });
                });
            }

            $scope.oHardware();

            $scope.moment = function(dt) {
                return moment(dt);
            }
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorfront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\psda\psda2\backend\resources\views/welcome.blade.php ENDPATH**/ ?>