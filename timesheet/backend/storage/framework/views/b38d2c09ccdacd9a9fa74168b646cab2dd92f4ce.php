<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Master Instansi <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_ms_instansi']); ?> <?php echo $__env->renderComponent(); ?>
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
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_ms_instansi','id'=>'h.rowid']); ?>  <?php echo $__env->renderComponent(); ?> </span>
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
                        <td title="'Id Instansi New'" filter="{id_instansi_new: 'text'}" sortable="'id_instansi_new'">{{v.id_instansi_new}}</td>
                        <td title="'Id Instansi'" filter="{id_instansi: 'text'}" sortable="'id_instansi'">{{v.id_instansi}}</td>
                        <td title="'Id Dinas'" filter="{id_dinas: 'text'}" sortable="'id_dinas'">{{v.id_dinas}}</td>
                        <td title="'Nm Instansi'" filter="{nm_instansi: 'text'}" sortable="'nm_instansi'">{{v.nm_instansi}}</td>
                        <td title="'Center Y'" filter="{center_y: 'text'}" sortable="'center_y'">{{v.center_y}}</td>
                        <td title="'Center X'" filter="{center_x: 'text'}" sortable="'center_x'">{{v.center_x}}</td>
                        <td title="'Zoom'" filter="{zoom: 'text'}" sortable="'zoom'">{{v.zoom}}</td>
                        <td title="'Header'" filter="{header: 'text'}" sortable="'header'">{{v.header}}</td>
                        <td title="'Judul 1'" filter="{judul_1: 'text'}" sortable="'judul_1'">{{v.judul_1}}</td>
                        <td title="'Judul 2'" filter="{judul_2: 'text'}" sortable="'judul_2'">{{v.judul_2}}</td>
                        <td title="'Logo 1'" filter="{logo_1: 'text'}" sortable="'logo_1'">{{v.logo_1}}</td>
                        <td title="'Logo 2'" filter="{logo_2: 'text'}" sortable="'logo_2'">{{v.logo_2}}</td>
                        <td title="'Colorize Label'" filter="{colorize_label: 'text'}" sortable="'colorize_label'">{{v.colorize_label}}</td>
                        <td title="'Rt Mode'" filter="{rt_mode: 'text'}" sortable="'rt_mode'">{{v.rt_mode}}</td>
                        <td title="'Rt Text'" filter="{rt_text: 'text'}" sortable="'rt_text'">{{v.rt_text}}</td>
                        <td title="'Enabled'" filter="{enabled: 'text'}" sortable="'enabled'">{{v.enabled}}</td>
                        <td title="'Identity'" filter="{identity: 'text'}" sortable="'identity'">{{v.identity}}</td>
                        <td title="'F Default'" filter="{f_default: 'text'}" sortable="'f_default'">{{v.f_default}}</td>
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
                        <label title='id_instansi_new'>Id Instansi New</label>
                        <input type="text" ng-model="h.id_instansi_new" id="h_id_instansi_new" class="form-control input-sm"    maxlength=""  >
                        <label title='id_instansi'>Id Instansi</label>
                        <input type="text" ng-model="h.id_instansi" id="h_id_instansi" class="form-control input-sm"    maxlength="20"  >
                        <label title='id_dinas'>Id Dinas</label>
                        <input type="text" ng-model="h.id_dinas" id="h_id_dinas" class="form-control input-sm"    maxlength=""  >
                        <label title='nm_instansi'>Nm Instansi</label>
                        <input type="text" ng-model="h.nm_instansi" id="h_nm_instansi" class="form-control input-sm"    maxlength="80"  >
                        <label title='center_y'>Center Y</label>
                        <input type="text" ng-model="h.center_y" id="h_center_y" class="form-control input-sm"    maxlength=""  >
                        <label title='center_x'>Center X</label>
                        <input type="text" ng-model="h.center_x" id="h_center_x" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='zoom'>Zoom</label>
                        <input type="text" ng-model="h.zoom" id="h_zoom" class="form-control input-sm"    maxlength=""  >
                        <label title='header'>Header</label>
                        <input type="text" ng-model="h.header" id="h_header" class="form-control input-sm"    maxlength="50"  >
                        <label title='judul_1'>Judul 1</label>
                        <input type="text" ng-model="h.judul_1" id="h_judul_1" class="form-control input-sm"    maxlength="200"  >
                        <label title='judul_2'>Judul 2</label>
                        <input type="text" ng-model="h.judul_2" id="h_judul_2" class="form-control input-sm"    maxlength="200"  >
                        <label title='logo_1'>Logo 1</label>
                        <input type="text" ng-model="h.logo_1" id="h_logo_1" class="form-control input-sm"    maxlength="50"  >
                        <label title='logo_2'>Logo 2</label>
                        <input type="text" ng-model="h.logo_2" id="h_logo_2" class="form-control input-sm"    maxlength="50"  >
                        <label title='colorize_label'>Colorize Label</label>
                        <input type="text" ng-model="h.colorize_label" id="h_colorize_label" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='rt_mode'>Rt Mode</label>
                        <input type="text" ng-model="h.rt_mode" id="h_rt_mode" class="form-control input-sm"    maxlength=""  >
                        <label title='rt_text'>Rt Text</label>
                        <input type="text" ng-model="h.rt_text" id="h_rt_text" class="form-control input-sm"    maxlength="65535"  >
                        <label title='enabled'>Enabled</label>
                        <input type="text" ng-model="h.enabled" id="h_enabled" class="form-control input-sm"    maxlength=""  >
                        <label title='identity'>Identity</label>
                        <input type="text" ng-model="h.identity" id="h_identity" class="form-control input-sm"    maxlength="30"  >
                        <label title='f_default'>F Default</label>
                        <input type="text" ng-model="h.f_default" id="h_f_default" class="form-control input-sm"    maxlength=""  >
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_ms_instansi')); ?>");
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
            item.formData = [{ id: $scope.h.rowid, path: 'trs_local_ms_instansi', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_ms_instansi/' + $scope.h.rowid, function(jdata) {
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
        SfLog('trs_local_ms_instansi',$scope.h.rowid);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/ms_instansi/ms_instansi_frm.blade.php ENDPATH**/ ?>