<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Master Stasiun <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_ms_stasiun']); ?> <?php echo $__env->renderComponent(); ?>
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
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_ms_stasiun','id'=>'h.id_stasiun']); ?>  <?php echo $__env->renderComponent(); ?> </span>
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
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id_stasiun)">
                        <td title="'Id Stasiun'" filter="{id_stasiun: 'text'}" sortable="'id_stasiun'">{{v.id_stasiun}}</td>
                        <td title="'Id Instansi New'" filter="{id_instansi_new: 'text'}" sortable="'id_instansi_new'">{{v.id_instansi_new}}</td>
                        <td title="'Id Instansi'" filter="{id_instansi: 'text'}" sortable="'id_instansi'">{{v.id_instansi}}</td>
                        <td title="'Nm Stasiun'" filter="{nm_stasiun: 'text'}" sortable="'nm_stasiun'">{{v.nm_stasiun}}</td>
                        <td title="'Nm Display'" filter="{nm_display: 'text'}" sortable="'nm_display'">{{v.nm_display}}</td>
                        <td title="'Nm Lokasi'" filter="{nm_lokasi: 'text'}" sortable="'nm_lokasi'">{{v.nm_lokasi}}</td>
                        <td title="'Kd Kabupaten'" filter="{kd_kabupaten: 'text'}" sortable="'kd_kabupaten'">{{v.kd_kabupaten}}</td>
                        <td title="'Nm Kecamatan'" filter="{nm_kecamatan: 'text'}" sortable="'nm_kecamatan'">{{v.nm_kecamatan}}</td>
                        <td title="'Nm Desa'" filter="{nm_desa: 'text'}" sortable="'nm_desa'">{{v.nm_desa}}</td>
                        <td title="'No Hp'" filter="{no_hp: 'text'}" sortable="'no_hp'">{{v.no_hp}}</td>
                        <td title="'Ip Addr'" filter="{ip_addr: 'text'}" sortable="'ip_addr'">{{v.ip_addr}}</td>
                        <td title="'Utm Y'" filter="{utm_y: 'text'}" sortable="'utm_y'">{{v.utm_y}}</td>
                        <td title="'Utm X'" filter="{utm_x: 'text'}" sortable="'utm_x'">{{v.utm_x}}</td>
                        <td title="'Cek Kredit'" filter="{cek_kredit: 'text'}" sortable="'cek_kredit'">{{v.cek_kredit}}</td>
                        <td title="'Info Server'" filter="{info_server: 'text'}" sortable="'info_server'">{{v.info_server}}</td>
                        <td title="'Catatan'" filter="{catatan: 'text'}" sortable="'catatan'">{{v.catatan}}</td>
                        <td title="'Telecam'" filter="{telecam: 'text'}" sortable="'telecam'">{{v.telecam}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='id_stasiun'>Id Stasiun</label>
                        <input type="text" ng-model="h.id_stasiun" id="h_id_stasiun" class="form-control input-sm"    maxlength="10"   ng-readonly="f.crud!='c'  " >
                        <label title='id_instansi_new'>Id Instansi New</label>
                        <input type="text" ng-model="h.id_instansi_new" id="h_id_instansi_new" class="form-control input-sm"    maxlength=""  >
                        <label title='id_instansi'>Id Instansi</label>
                        <input type="text" ng-model="h.id_instansi" id="h_id_instansi" class="form-control input-sm"    maxlength="20"  >
                        <label title='nm_stasiun'>Nm Stasiun</label>
                        <input type="text" ng-model="h.nm_stasiun" id="h_nm_stasiun" class="form-control input-sm"    maxlength="30"  >
                        <label title='nm_display'>Nm Display</label>
                        <input type="text" ng-model="h.nm_display" id="h_nm_display" class="form-control input-sm"    maxlength="30"  >
                        <label title='nm_lokasi'>Nm Lokasi</label>
                        <input type="text" ng-model="h.nm_lokasi" id="h_nm_lokasi" class="form-control input-sm"    maxlength="50"  >
                    </div>
                    <div class="col-sm-4">
                        <label title='kd_kabupaten'>Kd Kabupaten</label>
                        <input type="text" ng-model="h.kd_kabupaten" id="h_kd_kabupaten" class="form-control input-sm"    maxlength=""  >
                        <label title='nm_kecamatan'>Nm Kecamatan</label>
                        <input type="text" ng-model="h.nm_kecamatan" id="h_nm_kecamatan" class="form-control input-sm"    maxlength="50"  >
                        <label title='nm_desa'>Nm Desa</label>
                        <input type="text" ng-model="h.nm_desa" id="h_nm_desa" class="form-control input-sm"    maxlength="50"  >
                        <label title='no_hp'>No Hp</label>
                        <input type="text" ng-model="h.no_hp" id="h_no_hp" class="form-control input-sm"    maxlength="15"  >
                        <label title='ip_addr'>Ip Addr</label>
                        <input type="text" ng-model="h.ip_addr" id="h_ip_addr" class="form-control input-sm"    maxlength="15"  >
                        <label title='utm_y'>Utm Y</label>
                        <input type="text" ng-model="h.utm_y" id="h_utm_y" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='utm_x'>Utm X</label>
                        <input type="text" ng-model="h.utm_x" id="h_utm_x" class="form-control input-sm"    maxlength=""  >
                        <label title='cek_kredit'>Cek Kredit</label>
                        <input type="text" ng-model="h.cek_kredit" id="h_cek_kredit" class="form-control input-sm"    maxlength="10"  >
                        <label title='info_server'>Info Server</label>
                        <input type="text" ng-model="h.info_server" id="h_info_server" class="form-control input-sm"    maxlength="65535"  >
                        <label title='catatan'>Catatan</label>
                        <input type="text" ng-model="h.catatan" id="h_catatan" class="form-control input-sm"    maxlength="65535"  >
                        <label title='telecam'>Telecam</label>
                        <input type="text" ng-model="h.telecam" id="h_telecam" class="form-control input-sm"    maxlength=""  >
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_ms_stasiun')); ?>");
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
            item.formData = [{ id: $scope.h.id_stasiun, path: 'trs_local_ms_stasiun', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_ms_stasiun/' + $scope.h.id_stasiun, function(jdata) {
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
        $scope.h.id_stasiun=null;
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
            var id = $scope.h.id_stasiun;
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
        SfLog('trs_local_ms_stasiun',$scope.h.id_stasiun);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/ms_stasiun/ms_stasiun_frm.blade.php ENDPATH**/ ?>