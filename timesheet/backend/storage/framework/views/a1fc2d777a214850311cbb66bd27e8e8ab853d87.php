<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data hardware <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_hardware']); ?> <?php echo $__env->renderComponent(); ?>
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
                                ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                            <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                                ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                            <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                                ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                            <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                    class="fa fa-clock-o"></i> Log</button>
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_hardware)">
                            <td title="'Kode Logger'" filter="{kd_logger: 'text'}" sortable="'kd_logger'">
                                {{ v . kd_logger }}
                            </td>
                            <td title="'Kode Hardware'" filter="{kd_hardware: 'text'}" sortable="'kd_hardware'">
                                {{ v . kd_hardware }}</td>
                            <td title="'Versi Data Logger'" filter="{versi_data_logger: 'text'}"
                                sortable="'versi_data_logger'">
                                {{ v . versi_data_logger }}</td>
                            <td title="'Nama Lokasi'" filter="{nm_lokasi: 'text'}" sortable="'nm_lokasi'">
                                {{ v . nm_lokasi }}</td>
                            <td title="'Satuan'" filter="{satuan: 'text'}" sortable="'satuan'">
                                {{ v . satuan }}</td>
                            <td title="'Sensor'" filter="{kd_sensor: 'text'}" sortable="'kd_sensor'">
                                {{ v . kd_sensor }}</td>
                            <td title="'Perkalian'" filter="{perkalian: 'text'}" sortable="'perkalian'">
                                {{ v . perkalian }}</td>
                            <td title="'Penjumlahan'" filter="{penjumlahan: 'text'}" sortable="'penjumlahan'">
                                {{ v . penjumlahan }}</td>
                            <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{ v . plant }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_hardware'>Kode Hardware</label>
                            <input type="text" ng-model="h.kd_hardware" id="h_kd_hardware" class="form-control input-sm"
                                maxlength="6" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_logger'>Kode Logger</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_logger+' | '+h.nm_logger" id="h_kd_logger"
                                    class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_logger','h_kd_logger')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='satuan'>Satuan</label>
                            <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm" ng-readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='nm_lokasi'>Nama Lokasi</label>
                            <input type="text" ng-model="h.nm_lokasi" id="h_nm_lokasi" class="form-control input-sm"
                                ng-readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='sensor'>Sensor</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_sensor" id="h_kd_sensor" class="form-control input-sm"
                                    readonly maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_sensor','h_kd_sensor')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='perkalian'>Perkalian</label>
                            <input type="number" ng-model="h.perkalian" id="h_perkalian" class="form-control input-sm"
                                placeholder="1">
                        </div>
                        <div class="col-sm-3">
                            <label title='penjumlahan'>Penjumlahan</label>
                            <input type="number" ng-model="h.penjumlahan" id="h_penjumlahan" class="form-control input-sm"
                                placeholder="0">
                        </div>
                        <div class="col-sm-3">
                            <label title='plant'>Plant</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.plant" id="h_plant" class="form-control input-sm" readonly
                                    maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('plant','h_plant')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h3 class="text-success">Detail Label</h3>
                    <div>
                        <div class="list-group">
                            <div class="col-sm-12">
                                <div class="col-sm-7 m-0 p-0">
                                    <label>Input Value with sparated by comma (,) <code>Example :
                                            0,10,20,30,40</code></label>
                                    <textarea ng-model="d2.val_step" id="d2_val_step" class="form-control input-sm"
                                        rows="3"></textarea>
                                    <p>&nbsp;</p>
                                    <label>Input Color with sparated by comma (,) <code>Available color :
                                            merah,oranye,kuning,hijau_muda,hijau</code></label>
                                    <textarea ng-model="d2.color_step" id="d2_color_step" class="form-control input-sm"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_hardware')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.d = [];
            $scope.d2 = [];

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_hardware,
                        path: 'trs_local_mst_hardware',
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
                SfGetMediaList('trs_local_mst_hardware/' + $scope.h.kd_hardware, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                $scope.d2 = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.kd_hardware = null;
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
                    d2: $scope.d2
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.d = jdata.data.d;
                    $scope.d2 = jdata.data.d2;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_logger':
                        SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.kd_logger = jsondata.kd_logger;
                                $scope.h.nm_logger = jsondata.nm_logger;
                                $scope.$apply();
                            });
                        break;
                    case 'plant':
                        SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.plant = jsondata.plant;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_sensor':
                        SfLookup("<?php echo e(url('trs_local_mst_sensor_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.kd_sensor = jsondata.kd_sensor;
                                $scope.h.nm_sensor = jsondata.nm_sensor;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_hardware', $scope.h.kd_hardware);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\pln\updk\backend\resources\views/trs/local/mst_hardware/mst_hardware_frm.blade.php ENDPATH**/ ?>