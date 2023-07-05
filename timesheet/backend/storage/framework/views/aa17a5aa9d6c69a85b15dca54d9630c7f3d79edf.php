<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Master Chanel <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_ms_channel']); ?> <?php echo $__env->renderComponent(); ?>
                    <div class="input-group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i class="fa fa fa-file-excel-o"></i></button>
                            <button type="button" class="btn btn-success btn-sm" ng-click="oPrint()"><i class="fa fa fa-print"></i></button>
                            <button type="button" class="btn btn-success btn-sm"  ng-click="oSearch(1)"><i class="fa fa fa-recycle"></i></button>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div ng-show="f.tab=='frm'">
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i class="fa fa-copy"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()" ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i class="fa fa-clock-o"></i> Log</button>
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_ms_channel','id'=>'h.rowid']); ?>  <?php echo $__env->renderComponent(); ?> </span>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.rowid)">
                        <td title="'Rowid'" filter="{rowid: 'text'}" sortable="'rowid'">{{v.rowid}}</td>
                        <td title="'Id Channel'" filter="{id_channel: 'text'}" sortable="'id_channel'">{{v.id_channel}}</td>
                        <td title="'Id Sensor'" filter="{id_sensor: 'text'}" sortable="'id_sensor'">{{v.id_sensor}}</td>
                        <td title="'Id Logger'" filter="{id_logger: 'text'}" sortable="'id_logger'">{{v.id_logger}}</td>
                        <td title="'Id Port'" filter="{id_port: 'text'}" sortable="'id_port'">{{v.id_port}}</td>
                        <td title="'Nm Channel'" filter="{nm_channel: 'text'}" sortable="'nm_channel'">{{v.nm_channel}}</td>
                        <td title="'Nm Display'" filter="{nm_display: 'text'}" sortable="'nm_display'">{{v.nm_display}}</td>
                        <td title="'Faktor'" filter="{faktor: 'text'}" sortable="'faktor'">{{v.faktor}}</td>
                        <td title="'Offset'" filter="{offset: 'text'}" sortable="'offset'">{{v.offset}}</td>
                        <td title="'Decs'" filter="{decs: 'text'}" sortable="'decs'">{{v.decs}}</td>
                        <td title="'Satuan'" filter="{satuan: 'text'}" sortable="'satuan'">{{v.satuan}}</td>
                        <td title="'F Aktif'" filter="{f_aktif: 'text'}" sortable="'f_aktif'">{{v.f_aktif}}</td>
                        <td title="'Marker'" filter="{marker: 'text'}" sortable="'marker'">{{v.marker}}</td>
                        <td title="'Lvl Alarm0'" filter="{lvl_alarm0: 'text'}" sortable="'lvl_alarm0'">{{v.lvl_alarm0}}</td>
                        <td title="'Lvl Alarm1'" filter="{lvl_alarm1: 'text'}" sortable="'lvl_alarm1'">{{v.lvl_alarm1}}</td>
                        <td title="'Lvl Alarm2'" filter="{lvl_alarm2: 'text'}" sortable="'lvl_alarm2'">{{v.lvl_alarm2}}</td>
                        <td title="'Lvl Alarm3'" filter="{lvl_alarm3: 'text'}" sortable="'lvl_alarm3'">{{v.lvl_alarm3}}</td>
                        <td title="'Lvl Alarm4'" filter="{lvl_alarm4: 'text'}" sortable="'lvl_alarm4'">{{v.lvl_alarm4}}</td>
                        <td title="'Debit C1'" filter="{debit_c1: 'text'}" sortable="'debit_c1'">{{v.debit_c1}}</td>
                        <td title="'Debit C2'" filter="{debit_c2: 'text'}" sortable="'debit_c2'">{{v.debit_c2}}</td>
                        <td title="'Debit H0'" filter="{debit_h0: 'text'}" sortable="'debit_h0'">{{v.debit_h0}}</td>
                        <td title="'Label X'" filter="{label_x: 'text'}" sortable="'label_x'">{{v.label_x}}</td>
                        <td title="'Label Y'" filter="{label_y: 'text'}" sortable="'label_y'">{{v.label_y}}</td>
                        <td title="'Image'" filter="{image: 'text'}" sortable="'image'">{{v.image}}</td>
                        <td title="'Interval Wkt'" filter="{interval_wkt: 'text'}" sortable="'interval_wkt'">{{v.interval_wkt}}</td>
                        <td title="'Level Awal'" filter="{level_awal: 'text'}" sortable="'level_awal'">{{v.level_awal}}</td>
                        <td title="'Jml Sampel'" filter="{jml_sampel: 'text'}" sortable="'jml_sampel'">{{v.jml_sampel}}</td>
                        <td title="'Simpan Awal'" filter="{simpan_awal: 'text'}" sortable="'simpan_awal'">{{v.simpan_awal}}</td>
                        <td title="'Simpan Akhir'" filter="{simpan_akhir: 'text'}" sortable="'simpan_akhir'">{{v.simpan_akhir}}</td>
                        <td title="'Mem Terpakai'" filter="{mem_terpakai: 'text'}" sortable="'mem_terpakai'">{{v.mem_terpakai}}</td>
                        <td title="'F Tindih Mem'" filter="{f_tindih_mem: 'text'}" sortable="'f_tindih_mem'">{{v.f_tindih_mem}}</td>
                        <td title="'Total Data'" filter="{total_data: 'text'}" sortable="'total_data'">{{v.total_data}}</td>
                        <td title="'Tgl Update'" filter="{tgl_update: 'text'}" sortable="'tgl_update'">{{v.tgl_update}}</td>
                        <td title="'Level Skrg'" filter="{level_skrg: 'text'}" sortable="'level_skrg'">{{v.level_skrg}}</td>
                        <td title="'Debit Skrg'" filter="{debit_skrg: 'text'}" sortable="'debit_skrg'">{{v.debit_skrg}}</td>
                        <td title="'Alarm Enbl'" filter="{alarm_enbl: 'text'}" sortable="'alarm_enbl'">{{v.alarm_enbl}}</td>
                        <td title="'Last Alarm'" filter="{last_alarm: 'text'}" sortable="'last_alarm'">{{v.last_alarm}}</td>
                        <td title="'Last Alarm Aman'" filter="{last_alarm_aman: 'text'}" sortable="'last_alarm_aman'">{{v.last_alarm_aman}}</td>
                        <td title="'Del Id Analisa'" filter="{del_id_analisa: 'text'}" sortable="'del_id_analisa'">{{v.del_id_analisa}}</td>
                        <td title="'Last Row'" filter="{last_row: 'text'}" sortable="'last_row'">{{v.last_row}}</td>
                        <td title="'Last Upd'" filter="{last_upd: 'text'}" sortable="'last_upd'">{{v.last_upd}}</td>
                        <td title="'Sinbad Id'" filter="{sinbad_id: 'text'}" sortable="'sinbad_id'">{{v.sinbad_id}}</td>
                        <td title="'Sinbad Mode'" filter="{sinbad_mode: 'text'}" sortable="'sinbad_mode'">{{v.sinbad_mode}}</td>
                        <td title="'Volume Efektif'" filter="{volume_efektif: 'text'}" sortable="'volume_efektif'">{{v.volume_efektif}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='rowid'>Rowid</label>
                        <input type="text" ng-model="h.rowid" id="h_rowid" class="form-control input-sm"  readonly  maxlength=""   ng-readonly="f.crud!='c' || true " placeholder="auto">
                        <label title='id_channel'>Id Channel</label>
                        <input type="text" ng-model="h.id_channel" id="h_id_channel" class="form-control input-sm"    maxlength="10"  >
                        <label title='id_sensor'>Id Sensor</label>
                        <input type="text" ng-model="h.id_sensor" id="h_id_sensor" class="form-control input-sm"    maxlength="20"  >
                        <label title='id_logger'>Id Logger</label>
                        <input type="text" ng-model="h.id_logger" id="h_id_logger" class="form-control input-sm"    maxlength="10"  >
                        <label title='id_port'>Id Port</label>
                        <input type="text" ng-model="h.id_port" id="h_id_port" class="form-control input-sm"    maxlength=""  >
                        <label title='nm_channel'>Nm Channel</label>
                        <input type="text" ng-model="h.nm_channel" id="h_nm_channel" class="form-control input-sm"    maxlength="30"  >
                        <label title='nm_display'>Nm Display</label>
                        <input type="text" ng-model="h.nm_display" id="h_nm_display" class="form-control input-sm"    maxlength="30"  >
                        <label title='faktor'>Faktor</label>
                        <input type="text" ng-model="h.faktor" id="h_faktor" class="form-control input-sm"    maxlength=""  >
                        <label title='offset'>Offset</label>
                        <input type="text" ng-model="h.offset" id="h_offset" class="form-control input-sm"    maxlength=""  >
                        <label title='decs'>Decs</label>
                        <input type="text" ng-model="h.decs" id="h_decs" class="form-control input-sm"    maxlength=""  >
                        <label title='satuan'>Satuan</label>
                        <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm"    maxlength="10"  >
                        <label title='f_aktif'>F Aktif</label>
                        <input type="text" ng-model="h.f_aktif" id="h_f_aktif" class="form-control input-sm"    maxlength=""  >
                        <label title='marker'>Marker</label>
                        <input type="text" ng-model="h.marker" id="h_marker" class="form-control input-sm"    maxlength="20"  >
                        <label title='lvl_alarm0'>Lvl Alarm0</label>
                        <input type="text" ng-model="h.lvl_alarm0" id="h_lvl_alarm0" class="form-control input-sm"    maxlength=""  >
                        <label title='lvl_alarm1'>Lvl Alarm1</label>
                        <input type="text" ng-model="h.lvl_alarm1" id="h_lvl_alarm1" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='lvl_alarm2'>Lvl Alarm2</label>
                        <input type="text" ng-model="h.lvl_alarm2" id="h_lvl_alarm2" class="form-control input-sm"    maxlength=""  >
                        <label title='lvl_alarm3'>Lvl Alarm3</label>
                        <input type="text" ng-model="h.lvl_alarm3" id="h_lvl_alarm3" class="form-control input-sm"    maxlength=""  >
                        <label title='lvl_alarm4'>Lvl Alarm4</label>
                        <input type="text" ng-model="h.lvl_alarm4" id="h_lvl_alarm4" class="form-control input-sm"    maxlength=""  >
                        <label title='debit_c1'>Debit C1</label>
                        <input type="text" ng-model="h.debit_c1" id="h_debit_c1" class="form-control input-sm"    maxlength=""  >
                        <label title='debit_c2'>Debit C2</label>
                        <input type="text" ng-model="h.debit_c2" id="h_debit_c2" class="form-control input-sm"    maxlength=""  >
                        <label title='debit_h0'>Debit H0</label>
                        <input type="text" ng-model="h.debit_h0" id="h_debit_h0" class="form-control input-sm"    maxlength=""  >
                        <label title='label_x'>Label X</label>
                        <input type="text" ng-model="h.label_x" id="h_label_x" class="form-control input-sm"    maxlength=""  >
                        <label title='label_y'>Label Y</label>
                        <input type="text" ng-model="h.label_y" id="h_label_y" class="form-control input-sm"    maxlength=""  >
                        <label title='image'>Image</label>
                        <input type="text" ng-model="h.image" id="h_image" class="form-control input-sm"    maxlength="120"  >
                        <label title='interval_wkt'>Interval Wkt</label>
                        <input type="text" ng-model="h.interval_wkt" id="h_interval_wkt" class="form-control input-sm"    maxlength=""  >
                        <label title='level_awal'>Level Awal</label>
                        <input type="text" ng-model="h.level_awal" id="h_level_awal" class="form-control input-sm"    maxlength=""  >
                        <label title='jml_sampel'>Jml Sampel</label>
                        <input type="text" ng-model="h.jml_sampel" id="h_jml_sampel" class="form-control input-sm"    maxlength=""  >
                        <label title='simpan_awal'>Simpan Awal</label>
                        <input type="text" ng-model="h.simpan_awal" id="h_simpan_awal" class="form-control input-sm"    maxlength=""  >
                        <label title='simpan_akhir'>Simpan Akhir</label>
                        <input type="text" ng-model="h.simpan_akhir" id="h_simpan_akhir" class="form-control input-sm"    maxlength=""  >
                        <label title='mem_terpakai'>Mem Terpakai</label>
                        <input type="text" ng-model="h.mem_terpakai" id="h_mem_terpakai" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='f_tindih_mem'>F Tindih Mem</label>
                        <input type="text" ng-model="h.f_tindih_mem" id="h_f_tindih_mem" class="form-control input-sm"    maxlength=""  >
                        <label title='total_data'>Total Data</label>
                        <input type="text" ng-model="h.total_data" id="h_total_data" class="form-control input-sm"    maxlength=""  >
                        <label title='tgl_update'>Tgl Update</label>
                        <input type="text" ng-model="h.tgl_update" id="h_tgl_update" class="form-control input-sm"    maxlength=""  >
                        <label title='level_skrg'>Level Skrg</label>
                        <input type="text" ng-model="h.level_skrg" id="h_level_skrg" class="form-control input-sm"    maxlength=""  >
                        <label title='debit_skrg'>Debit Skrg</label>
                        <input type="text" ng-model="h.debit_skrg" id="h_debit_skrg" class="form-control input-sm"    maxlength=""  >
                        <label title='alarm_enbl'>Alarm Enbl</label>
                        <input type="text" ng-model="h.alarm_enbl" id="h_alarm_enbl" class="form-control input-sm"    maxlength=""  >
                        <label title='last_alarm'>Last Alarm</label>
                        <input type="text" ng-model="h.last_alarm" id="h_last_alarm" class="form-control input-sm"    maxlength=""  >
                        <label title='last_alarm_aman'>Last Alarm Aman</label>
                        <input type="text" ng-model="h.last_alarm_aman" id="h_last_alarm_aman" class="form-control input-sm"    maxlength=""  >
                        <label title='del_id_analisa'>Del Id Analisa</label>
                        <input type="text" ng-model="h.del_id_analisa" id="h_del_id_analisa" class="form-control input-sm"    maxlength=""  >
                        <label title='last_row'>Last Row</label>
                        <input type="text" ng-model="h.last_row" id="h_last_row" class="form-control input-sm"    maxlength=""  >
                        <label title='last_upd'>Last Upd</label>
                        <input type="text" ng-model="h.last_upd" id="h_last_upd" class="form-control input-sm"    maxlength=""  >
                        <label title='sinbad_id'>Sinbad Id</label>
                        <input type="text" ng-model="h.sinbad_id" id="h_sinbad_id" class="form-control input-sm"    maxlength="10"  >
                        <label title='sinbad_mode'>Sinbad Mode</label>
                        <input type="text" ng-model="h.sinbad_mode" id="h_sinbad_mode" class="form-control input-sm"    maxlength=""  >
                        <label title='volume_efektif'>Volume Efektif</label>
                        <input type="text" ng-model="h.volume_efektif" id="h_volume_efektif" class="form-control input-sm"    maxlength=""  >
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_ms_channel')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.m = [];

     var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
            item.formData = [{ id: $scope.h.rowid, path: 'trs_local_ms_channel', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_ms_channel/' + $scope.h.rowid, function(jdata) {
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
        $scope.h.rowid=null;
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
                        trash:$scope.f.trash,
                        plant: $scope.f.plant,
                        userid : $scope.f.userid
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
            if(chatCtrl() != undefined){
                chatCtrl().listChat();
            }
        });
    }

    $scope.oDel = function(id,isRestore) {
        if (id == undefined) {
            var id = $scope.h.rowid;
        }
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), {restore:isRestore}, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oRestore = function(id) {
       $scope.oDel(id,1);
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

     $scope.oLog=function(){
        SfLog('trs_local_ms_channel',$scope.h.rowid);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/trs/local/ms_channel/ms_channel_frm.blade.php ENDPATH**/ ?>