<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Map Image <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <style type="text/css">
        @import  url('https://fonts.googleapis.com/css?family=Orbitron');
        @import  url('https://fontlibrary.org//face/segment7');

        .xxx {
            font-family: 'segment7'
        }

    </style>
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_trs_mapimage']); ?> <?php echo $__env->renderComponent(); ?>
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
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
                        <div ng-show="f.tab=='frm'">
                            <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                                ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                            <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                    class="fa fa-clock-o"></i> Log</button>
                            <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{ v . id }}</td>
                            <td title="'Nama'" filter="{name: 'text'}" sortable="'name'">{{ v . name }}</td>
                            <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{ v . plant }}</td>
                            <td title="'Categori'" filter="{ctg: 'text'}" sortable="'ctg'">{{ v . ctg }}</td>
                            <td title="'Layout Map'" filter="{layout_url: 'text'}" sortable="'layout_url'">
                                {{ v . layout_url }}</td>
                            <td title="'Dimension'" filter="{paper_w: 'text'}" sortable="'paper_w'">{{ v . paper_w }} x
                                {{ v . paper_h }}</td>
                            <td title="'Note'" filter="{note: 'text'}" sortable="'note'">{{ v . note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='id'>ID</label>
                            <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength=""
                                ng-readonly="f.crud!='c' || true " placeholder="auto">
                        </div>
                        <div class="col-sm-3">
                            <label title='name'>Nama</label>
                            <input type="text" ng-model="h.name" id="h_name" class="form-control input-sm" maxlength="100">
                        </div>
                        <div class="col-sm-3">
                            <label title='ctg'>Categori</label>
                            <select type="text" ng-model="h.ctg" id="h_ctg" class="form-control input-sm">
                                <option ng-repeat="v in ['Map']" ng-value="v">{{ v }}</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label title='note'>Note</label>
                            <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm" maxlength="100">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label title='layout_url'>Layout Map</label>
                            <select type="text" ng-model="h.layout_url" id="h_layout_url" class="form-control input-sm"
                                ng-change="oCanvas();">
                                <option ng-repeat="v in m" ng-value="v.name">{{ v . name }}</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <ul class="nav nav-pills">
                            <li class="nav-items active"><a href="#tab-1" data-toggle="tab">Structure</a></li>
                            <li class="nav-items" ng-click="oCanvas();"><a href="#tab-2" data-toggle="tab">Layout</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-1">
                            <div class="pull-right">
                                <input type="text" ng-model="q_filter" class="form-control input-sm" placeholder="Search..">
                            </div>
                            <h3 class="text-success">Map Setting</h3>
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Hardware</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="v in d1 | filter:q_filter">
                                            <td class="text-right">{{ $index + 1 }}</td>
                                            <td ng-click="oLookup('kd_hardware',v)" class="pointer">
                                                <span class="" ng-if="v.kd_hardware!=null">{{ v . kd_hardware }}</span>
                                                <span class="text-danger" ng-if="v.kd_hardware==null">Click Here</span>
                                            </td>
                                            <td class="p-0">
                                                <select class="form-control input-sm no-border-text" ng-model="v.icon">
                                                    <option ng-repeat="va in ['hardware','seven_segmen','lokasi']"
                                                        ng-value="va">
                                                        {{ va }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="p-0">
                                                <select class="form-control input-sm no-border-text" ng-model="v.status">
                                                    <option ng-repeat="va in [0,1]" ng-value="va">{{ va }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="p-0">
                                                <input type="text" ng-model="v.note" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <span class="text-danger pointer" ng-click="oDelrow(v)">Delete</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-sm btn-primary" ng-click="oAddrow()">Add Row</button>
                        </div>
                        <div class="tab-pane fade" id="tab-2">
                            <h3 class="text-success">Layout Setting</h3>
                            <div class="form-inline m-b-10">
                                Dimension : <input type="text" ng-model="h.papper_w" id="h_papper_w"
                                    class="form-control input-sm" maxlength="30" awnum="default" size="10"> X
                                <input type="text" ng-model="h.papper_h" id="h_papper_h" class="form-control input-sm"
                                    maxlength="30" awnum="default" size="10">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oCanvas();"><i
                                        class="fa fa-refresh"></i> Refresh Layout</button>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div id="divmyCanvas" style="border:solid 1px gray;overflow: scroll; height: 460px;">
                                        <canvas style="border:solid 1px red" id="myCanvas" width="4000" height="2000"
                                            style="background-size:contain; background-repeat: no-repeat;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/fabric/fabric.min.js?ver=2019.07.17')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_mapimage')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {
                papper_w: 600,
                papper_h: 460
            };
            $scope.m = [];
            $scope.d1 = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";
            $scope.canvas = null;
            $scope.target = {};

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.id,
                        path: 'trs_local_trs_mapimage',
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
                SfGetMediaList('trs_local_trs_mapimage/' + $scope.h.id, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                $scope.d1 = [];
                SfFormNew("#frm");
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
                    f: $scope.f,
                    d1: $scope.d1,
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.f.crud = 'u';
                    $scope.h = jdata.data.h;
                    $scope.d1 = $scope.h.rel_d1;
                    $scope.oCanvas();
                    $scope.oGallery();
                });
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                var idx = $scope.d1.indexOf(selector);
                                $scope.d1[idx].kd_hardware = jsondata.kd_hardware;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_mapimage', $scope.h.id);
            }

            $scope.oAddrow = function(id) {
                $scope.d1.push({});
            }

            $scope.oDelrow = function(v) {
                var idx = $scope.d1.indexOf(v);
                $scope.d1.splice(idx, 1);
            }

            $scope.oCanvas = function() {
                $scope.h.papper_w = $scope.h.papper_w == null ? 4000 : $scope.h.papper_w;
                $scope.h.papper_h = $scope.h.papper_h == null ? 2000 : $scope.h.papper_h;
                document.getElementById('myCanvas').width = $scope.h.papper_w;
                document.getElementById('myCanvas').height = $scope.h.papper_h;
                if ($scope.canvas != null) {
                    $scope.canvas.dispose();
                }
                $scope.canvas = new fabric.Canvas('myCanvas');
                $scope.canvas.selection = true;
                $scope.canvas.on('mouse:up', function(options) {
                    if (options.target) {
                        console.log(options.target);
                        $scope.target = options.target;
                        $scope.setPoint();
                        $scope.$apply();
                    }
                });
                // fabric.Image.fromURL($scope.path + $scope.h.layout_url, function(img) {
                fabric.Image.fromURL("<?php echo e(url('colorparalax/assets/img/besai.png')); ?>", function(img) {
                    $scope.canvas.setBackgroundImage(img, $scope.canvas.renderAll.bind($scope
                        .canvas), {
                        scaleX: $scope.canvas.width / img.width,
                        scaleY: $scope.canvas.height / img.height
                    });
                });

                angular.forEach($scope.d1, function(item, i) {
                    // if (item.kd_hardware != null) {
                    if (item.id != null) {
                        if (item.config == null || item.config == undefined) {
                            item.config = {};
                        }

                        $scope.yyy = item.config;
                        switch (item.icon) {
                            case 'hardware':
                            case 'seven_segmen':
                            case 'lokasi':
                                if (item.icon == 'hardware') {
                                    var str = item.kd_hardware;
                                } else if (item.icon == 'seven_segmen') {
                                    var str = item.nm_lokasi;
                                } else if (item.icon == 'lokasi') {
                                    var str = item.nm_lokasi;
                                } else {
                                    var str = item.kd_hardware;
                                }

                                var obj = new fabric.Text(str);
                                // obj.set({
                                //     fontFamily: 'segment7'
                                // });

                                break;
                            default:
                                var obj = null;
                                break;
                        }
                        if (obj != null) {
                            obj.set({
                                transparentCorners: false,
                                cornerColor: 'blue',
                                cornerStrokeColor: 'red',
                                borderColor: 'red',
                                cornerSize: 12,
                                padding: 10,
                                cornerStyle: 'circle',
                                borderDashArray: [3, 3]
                            });

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
                            // obj.textBackgroundColor = 'rgb(0,0,0)';
                            obj.data = item;
                            $scope.canvas.add(obj);
                        }

                    }
                });
            }

            $scope.setPoint = function(fn) {
                angular.forEach($scope.d1, function(item, i) {
                    if (item.id == $scope.target.data.id) {
                        // if (item.kd_hardware == $scope.target.data.kd_hardware) {
                        $scope.d1[i].config = {
                            x: $scope.target.aCoords.tl.x,
                            y: $scope.target.aCoords.tl.y,
                            angle: $scope.target.angle,
                            scaleX: $scope.target.scaleX,
                            scaleY: $scope.target.scaleY,
                            fontSize: $scope.target.fontSize,
                            fontWeight: $scope.target.fontWeight,
                            fill: $scope.target.fill,
                            textBackgroundColor: $scope.target.textBackgroundColor
                        }
                        console.log($scope.d1[i]);
                    }
                });
                if (fn) fn();
            }

            $scope.moment = function(dt) {
                return moment(dt);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\pln\updk\backend\resources\views/trs/local/trs_mapimage/trs_mapimage_frm.blade.php ENDPATH**/ ?>