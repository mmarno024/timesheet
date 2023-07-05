<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Sensor <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
    <span ng-show="f.tab=='frm'">Form Entry</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                placeholder="Search">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div ng-show="f.tab=='frm'">
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div ng-if="f.plant=='002'" id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="oShow(v.kd_sensor)">
                            <td style="padding:6px;" title="'Kode Sensor'" filter="{kd_sensor: 'text'}" sortable="">
                                {{ v . kd_sensor }}</td>
                            <td style="padding:6px;" title="'Nama Sensor'" filter="{nm_sensor: 'text'}" sortable="">
                                {{ v . nm_sensor }}</td>
                            <td style="padding:6px;" title="'Satuan'" filter="{satuan: 'text'}" sortable="">
                                {{ v . satuan }}</td>
                            <td style="padding:6px;" title="'Type'" filter="{type: 'text'}" sortable="">
                                <label
                                    ng-class="{'label label-md label-primary':v.type=='Water','label label-md label-success':v.type=='Rain','label label-md label-warning':v.type=='Climatology' || v.type=='Factory','label label-md label-danger':v.type=='Other','label label-md label-inverse':v.type=='Device'}">{{ v . type }}</label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div ng-if="f.plant!='002'" id="div1" class="table-responsive">
                    <table class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr>
                            <th>Kode Sensor</th>
                            <th>Nama Sensor</th>
                            <th>Satuan</th>
                        </tr>
                        <tr ng-repeat="(k,v) in data" class="pointer">
                            <td style="padding:6px;" title="'Kode Sensor'" filter="{kd_sensor: 'text'}" sortable="">
                                {{ v . kd_sensor }}</td>
                            <td style="padding:6px;" title="'Nama Sensor'" filter="{nm_sensor: 'text'}" sortable="">
                                {{ v . nm_sensor }}</td>
                            <td style="padding:6px;" title="'Satuan'" filter="{satuan: 'text'}" sortable="">
                                {{ v . satuan }}</td>
                            <td style="padding:6px;" title="'Type'" filter="{type: 'text'}" sortable="">
                                <label
                                    ng-class="{'label label-md label-primary':v.type=='Water','label label-md label-success':v.type=='Rain','label label-md label-warning':v.type=='Climatology' || v.type=='Factory','label label-md label-danger':v.type=='Other','label label-md label-inverse':v.type=='Device'}">{{ v . type }}</label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_type'>Type</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_type" id="h_kd_type" class="form-control input-sm"
                                    readonly maxlength="15" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('kd_type','h_kd_type')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_sensor'>Kode Sensor</label>&nbsp;<code>Tanpa tanda baca</code>
                            <input type="text" ng-model="h.kd_sensor" id="h_kd_sensor" class="form-control input-sm"
                                maxlength="25" ng-readonly="f.crud!='c'" required>
                        </div>
                        <div class="col-sm-3">
                            <label title='nm_sensor'>Nama Sensor</label>
                            <input type="text" ng-model="h.nm_sensor" id="h_nm_sensor" class="form-control input-sm"
                                maxlength="50">
                        </div>
                        <div class="col-sm-3">
                            <label title='satuan'>Satuan</label>
                            <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm"
                                maxlength="50">
                        </div>
                    </div>
                    <hr />
                    <div class="row" ng-show="f.crud=='c'">
                        <div class="col-sm-12">
                            <h4 class="text-primary">Daftar Sensor yang ada</h4>
                            <table width="100%">
                                <tr ng-repeat="v2a in sensor">
                                    <td width="10%" align="right">
                                        <h5
                                            ng-class="{'text-primary':v2a.type=='Water','text-success':v2a.type=='Rain','text-warning':v2a.type=='Climatology' || v2a.type=='Factory','text-danger':v2a.type=='Other','text-inverse':v2a.type=='Device'}">
                                            {{ v2a . type }}
                                        </h5>
                                    </td>
                                    <td width="2%" align="center">:</td>
                                    <td width="88%" align="left">
                                        <span ng-repeat="v2b in v2a.rel_d1">
                                            <button type="button"
                                                ng-class="{'btn btn-xs btn-primary m-b-5':v2a.type=='Water','btn btn-xs btn-success m-b-5':v2a.type=='Rain','btn btn-xs btn-warning m-b-5':v2a.type=='Climatology' || v2a.type=='Factory','btn btn-xs btn-danger m-b-5':v2a.type=='Other','btn btn-xs btn-inverse m-b-5':v2a.type=='Device'}">{{ v2b . kd_sensor }}</button>&nbsp;
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_sensor')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.sensor = [];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_sensor,
                        path: 'trs_local_mst_sensor',
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
                SfGetMediaList('trs_local_mst_sensor/' + $scope.h.kd_sensor, function(jdata) {
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
                $scope.h.kd_sensor = null;
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                if ($scope.f.plant == '002') {
                    $scope.tableList = new NgTableParams({
                        count: 25
                    }, {
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
                } else {
                    SfService.httpGet("trs_local_mst_sensor_list", {
                        plant: $scope.f.plant
                    }, function(jdata) {
                        $scope.data = jdata.data.data;
                    });
                }
            }

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oSensor = function() {
                SfService.httpGet("trs_local_mst_sensor_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.sensor = jdata.data.data_sensor;
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_type':
                        SfLookup("<?php echo e(url('trs_local_mst_sensor_type_lookup')); ?>",
                            function(id, name, jsondata) {
                                $scope.h.kd_type = jsondata.kd_type;
                                $scope.h.type = jsondata.type;
                                $scope.$apply();
                            });
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_sensor', $scope.h.kd_sensor);
            }

            $scope.oSearch();
            $scope.oSensor();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\webadm\backend\resources\views/trs/local/mst_sensor/mst_sensor_frm.blade.php ENDPATH**/ ?>