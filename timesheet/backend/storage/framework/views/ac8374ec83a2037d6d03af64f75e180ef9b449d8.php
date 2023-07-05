<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data <?php $__env->stopSection(); ?>
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
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_tr_data']); ?> <?php echo $__env->renderComponent(); ?>
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-success btn-sm" ng-click="oPrint()"><i
                                        class="fa fa fa-print"></i></button>
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
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i
                                class="fa fa-copy"></i> Copy</button>
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()"
                            ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
                        <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                        <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat', ['route' =>
                            'trs_local_tr_data', 'id' => 'h.rowid']); ?> <?php echo $__env->renderComponent(); ?> </span>
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
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.rowid)">
                            <td title="'Rowid'" filter="{rowid: 'text'}" sortable="'rowid'">{{ v . rowid }}</td>
                            <td title="'Id Hardware'" filter="{id_hardware: 'text'}" sortable="'id_hardware'">
                                {{ v . id_hardware }}</td>
                            <td title="'Id Channel'" filter="{id_channel: 'text'}" sortable="'id_channel'">
                                {{ v . id_channel }}</td>
                            <td title="'Id Logger'" filter="{id_logger: 'text'}" sortable="'id_logger'">{{ v . id_logger }}
                            </td>
                            <td title="'Id Sensor'" filter="{id_sensor: 'text'}" sortable="'id_sensor'">{{ v . id_sensor }}
                            </td>
                            <td title="'Wkt Terima'" filter="{wkt_terima: 'text'}" sortable="'wkt_terima'">
                                {{ v . wkt_terima }}</td>
                            <td title="'Wkt Sampel'" filter="{wkt_sampel: 'text'}" sortable="'wkt_sampel'">
                                {{ v . wkt_sampel }}</td>
                            <td title="'Level'" filter="{level: 'text'}" sortable="'level'">{{ v . level }}</td>
                            <td title="'Capture'" filter="{capture: 'text'}" sortable="'capture'">{{ v . capture }}</td>
                            <td title="'Satuan'" filter="{satuan: 'text'}" sortable="'satuan'">{{ v . satuan }}</td>
                            <td title="'Debit C1'" filter="{debit_c1: 'text'}" sortable="'debit_c1'">{{ v . debit_c1 }}
                            </td>
                            <td title="'Debit C2'" filter="{debit_c2: 'text'}" sortable="'debit_c2'">{{ v . debit_c2 }}
                            </td>
                            <td title="'Debit H0'" filter="{debit_h0: 'text'}" sortable="'debit_h0'">{{ v . debit_h0 }}
                            </td>
                            <td title="'Media'" filter="{media: 'text'}" sortable="'media'">{{ v . media }}</td>
                            <td title="'Sender'" filter="{sender: 'text'}" sortable="'sender'">{{ v . sender }}</td>
                            <td title="'Stt Level'" filter="{stt_level: 'text'}" sortable="'stt_level'">
                                {{ v . stt_level }}</td>
                            <td title="'F Aktual'" filter="{f_aktual: 'text'}" sortable="'f_aktual'">{{ v . f_aktual }}
                            </td>
                            <td title="'F Simulasi'" filter="{f_simulasi: 'text'}" sortable="'f_simulasi'">
                                {{ v . f_simulasi }}</td>
                            <td title="'F Sync'" filter="{f_sync: 'text'}" sortable="'f_sync'">{{ v . f_sync }}</td>
                            <td title="'Data Awal'" filter="{data_awal: 'text'}" sortable="'data_awal'">
                                {{ v . data_awal }}</td>
                            <td title="'Data Sampel'" filter="{data_sampel: 'text'}" sortable="'data_sampel'">
                                {{ v . data_sampel }}</td>
                            <td title="'Data Aktual'" filter="{data_aktual: 'text'}" sortable="'data_aktual'">
                                {{ v . data_aktual }}</td>
                            <td title="'Data Harian'" filter="{data_harian: 'text'}" sortable="'data_harian'">
                                {{ v . data_harian }}</td>
                            <td title="'Raw'" filter="{raw: 'text'}" sortable="'raw'">{{ v . raw }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='rowid'>Rowid</label>
                            <input type="text" ng-model="h.rowid" id="h_rowid" class="form-control input-sm" readonly
                                maxlength="" ng-readonly="f.crud!='c' || true " placeholder="auto">
                            <label title='id_hardware'>Id Hardware</label>
                            <input type="text" ng-model="h.id_hardware" id="h_id_hardware" class="form-control input-sm"
                                maxlength="10">
                            <label title='id_channel'>Id Channel</label>
                            <input type="text" ng-model="h.id_channel" id="h_id_channel" class="form-control input-sm"
                                maxlength="10">
                            <label title='id_logger'>Id Logger</label>
                            <input type="text" ng-model="h.id_logger" id="h_id_logger" class="form-control input-sm"
                                maxlength="10">
                            <label title='id_sensor'>Id Sensor</label>
                            <input type="text" ng-model="h.id_sensor" id="h_id_sensor" class="form-control input-sm"
                                maxlength="20">
                            <label title='wkt_terima'>Wkt Terima</label>
                            <input type="text" ng-model="h.wkt_terima" id="h_wkt_terima" class="form-control input-sm"
                                maxlength="">
                            <label title='wkt_sampel'>Wkt Sampel</label>
                            <input type="text" ng-model="h.wkt_sampel" id="h_wkt_sampel" class="form-control input-sm"
                                maxlength="">
                            <label title='level'>Level</label>
                            <input type="text" ng-model="h.level" id="h_level" class="form-control input-sm" maxlength="">
                        </div>
                        <div class="col-sm-4">
                            <label title='capture'>Capture</label>
                            <input type="text" ng-model="h.capture" id="h_capture" class="form-control input-sm"
                                maxlength="65535">
                            <label title='satuan'>Satuan</label>
                            <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm"
                                maxlength="10">
                            <label title='debit_c1'>Debit C1</label>
                            <input type="text" ng-model="h.debit_c1" id="h_debit_c1" class="form-control input-sm"
                                maxlength="">
                            <label title='debit_c2'>Debit C2</label>
                            <input type="text" ng-model="h.debit_c2" id="h_debit_c2" class="form-control input-sm"
                                maxlength="">
                            <label title='debit_h0'>Debit H0</label>
                            <input type="text" ng-model="h.debit_h0" id="h_debit_h0" class="form-control input-sm"
                                maxlength="">
                            <label title='media'>Media</label>
                            <input type="text" ng-model="h.media" id="h_media" class="form-control input-sm" maxlength="30">
                            <label title='sender'>Sender</label>
                            <input type="text" ng-model="h.sender" id="h_sender" class="form-control input-sm"
                                maxlength="20">
                            <label title='stt_level'>Stt Level</label>
                            <input type="text" ng-model="h.stt_level" id="h_stt_level" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-4">
                            <label title='f_aktual'>F Aktual</label>
                            <input type="text" ng-model="h.f_aktual" id="h_f_aktual" class="form-control input-sm"
                                maxlength="">
                            <label title='f_simulasi'>F Simulasi</label>
                            <input type="text" ng-model="h.f_simulasi" id="h_f_simulasi" class="form-control input-sm"
                                maxlength="">
                            <label title='f_sync'>F Sync</label>
                            <input type="text" ng-model="h.f_sync" id="h_f_sync" class="form-control input-sm" maxlength="">
                            <label title='data_awal'>Data Awal</label>
                            <input type="text" ng-model="h.data_awal" id="h_data_awal" class="form-control input-sm"
                                maxlength="">
                            <label title='data_sampel'>Data Sampel</label>
                            <input type="text" ng-model="h.data_sampel" id="h_data_sampel" class="form-control input-sm"
                                maxlength="">
                            <label title='data_aktual'>Data Aktual</label>
                            <input type="text" ng-model="h.data_aktual" id="h_data_aktual" class="form-control input-sm"
                                maxlength="">
                            <label title='data_harian'>Data Harian</label>
                            <input type="text" ng-model="h.data_harian" id="h_data_harian" class="form-control input-sm"
                                maxlength="">
                            <label title='raw'>Raw</label>
                            <input type="text" ng-model="h.raw" id="h_raw" class="form-control input-sm" maxlength="">
                        </div>
                    </div>
                    <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_tr_data')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.rowid,
                        path: 'trs_local_tr_data',
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
                SfGetMediaList('trs_local_tr_data/' + $scope.h.rowid, function(jdata) {
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
                $scope.h.rowid = null;
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
                    var id = $scope.h.rowid;
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
                SfLog('trs_local_tr_data', $scope.h.rowid);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/tr_data/tr_data_frm.blade.php ENDPATH**/ ?>