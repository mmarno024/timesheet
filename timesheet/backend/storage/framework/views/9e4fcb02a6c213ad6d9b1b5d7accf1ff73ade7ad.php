<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


    

    <style type="text/css">
        .todolist>li.active>a .todolist-title {
            text-decoration: underline;
            font-weight: bold;
        }

    </style>
    <div class="row" style="margin-left: -80px;">
        <div class="col-sm-2">
            <div class="panel panel-inverse">
                <div class="panel-heading">Menu</div>
                <div class="panel-body p-0">
                    <ul class="todolist">
                        <li ng-repeat="v in ['Menu 1','Menu 2','Menu 3']" ng-click="oSubMenu(v,$index)"
                            ng-class="{active: v[2]==1}">
                            <a href="javascript:;" class="todolist-container">
                                <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                                <div class="todolist-title">{{ v }}</div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="todolist-container">
                                <div class=" todolist-input"><i class="fa fa-square-o"></i>
                                </div>
                                <div class="todolist-title">Security Audit</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="panel panel-inverse">
                <div class="panel-heading">MAP <b>{{ f . menuSelected[1] }}</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> View Map
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-2">
                    <label>Logger</label>
                    <div class="input-group">
                        <input type="text" ng-value="f.kd_logger + ' - ' + f.nm_logger" class="form-control input-sm m-b-5"
                            placeholder="Choose logger ...">
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm m-b-5" type="button" ng-click="oLookup('kd_logger')"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label>Hardware</label>
                    <div class="input-group">
                        <input type="text" ng-value="f.kd_hardware" class="form-control input-sm m-b-5"
                            placeholder="Choose hardware ...">
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm m-b-5" type="button" ng-click="oLookup('kd_hardware')"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">
                    <label style="margin-top: -5px">&nbsp;</label>
                    <button class="btn btn-sm btn-success btn-block" ng-click="oSearch()">Load Data</button>
                </div>
            </div>
            <hr />
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_rpt_map')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};

            // map ===================================================================================================
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
                center: [-3.167483, 120.093000],
                zoom: 5,
                layers: [$scope.peta1]
            });

            $scope.baseMaps = {
                "Grayscale": $scope.peta1,
                "Satellite": $scope.peta2,
                "Streets": $scope.peta3,
                "Dark": $scope.peta4
            };

            L.control.layers($scope.baseMaps).addTo($scope.map);
            // map ===================================================================================================

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.id,
                        path: 'trs_local_rpt_map',
                        s: 'i',
                        userid: $scope.f.userid,
                        plant: $scope.f.plant
                    }];
                },
                onSuccessItem: function(fileItem, response, status, headers) {
                    $scope.oGallery();
                }
            });

            $scope.oGallery = function() {
                SfGetMediaList('trs_local_rpt_map/' + $scope.h.id, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.id = null;
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                $scope.tableList = new NgTableParams({}, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.tableList.orderBy(),
                                q: $scope.f.q,
                                trash: $scope.f.trash,
                                plant: $scope.f.plant,
                                userid: $scope.f.userid
                            }
                        }).then(function(jdata) {
                            $btn.button('reset');
                            $scope.tableList.total(jdata.data.data.total);
                            return jdata.data.data.data;
                        }, function(error) {
                            $btn.button('reset');
                            swal('', error.data, 'error');
                        });
                    }
                });
            }

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                    if (chatCtrl() != undefined) {
                        chatCtrl().listChat();
                    }
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.id;
                }
                SfService.delete(SfService.getUrl("/" + encodeURI(id)), {
                    restore: isRestore
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    /*case 'parent':
                        SfLookup(SfService.getUrl("_lookup"), function(id, name, jsondata) {
                            $("#" + selector).val(id).trigger('input');;
                        });
                        break;*/
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_rpt_map', $scope.h.id);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin_minifiedx', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\besai\backend\resources\views/trs/local/rpt_map/rpt_map_frm.blade.php ENDPATH**/ ?>