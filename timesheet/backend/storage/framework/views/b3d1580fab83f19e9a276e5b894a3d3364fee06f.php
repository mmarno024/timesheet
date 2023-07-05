<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Sensor <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_jn_sensor']); ?> <?php echo $__env->renderComponent(); ?>
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
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_jn_sensor','id'=>'h.rowid']); ?>  <?php echo $__env->renderComponent(); ?> </span>
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
                        <td title="'Id Sensor'" filter="{id_sensor: 'text'}" sortable="'id_sensor'">{{v.id_sensor}}</td>
                        <td title="'Nm Sensor'" filter="{nm_sensor: 'text'}" sortable="'nm_sensor'">{{v.nm_sensor}}</td>
                        <td title="'Satuan'" filter="{satuan: 'text'}" sortable="'satuan'">{{v.satuan}}</td>
                        <td title="'Alt Id'" filter="{alt_id: 'text'}" sortable="'alt_id'">{{v.alt_id}}</td>
                        <td title="'Harian'" filter="{harian: 'text'}" sortable="'harian'">{{v.harian}}</td>
                        <td title="'Alias'" filter="{alias: 'text'}" sortable="'alias'">{{v.alias}}</td>
                        <td title="'Nomor'" filter="{nomor: 'text'}" sortable="'nomor'">{{v.nomor}}</td>
                        <td title="'Icon'" filter="{icon: 'text'}" sortable="'icon'">{{v.icon}}</td>
                        <td title="'Hide'" filter="{hide: 'text'}" sortable="'hide'">{{v.hide}}</td>
                        <td title="'Marker'" filter="{marker: 'text'}" sortable="'marker'">{{v.marker}}</td>
                        <td title="'Del Marker'" filter="{del_marker: 'text'}" sortable="'del_marker'">{{v.del_marker}}</td>
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
                        <label title='id_sensor'>Id Sensor</label>
                        <input type="text" ng-model="h.id_sensor" id="h_id_sensor" class="form-control input-sm"    maxlength="20"  >
                        <label title='nm_sensor'>Nm Sensor</label>
                        <input type="text" ng-model="h.nm_sensor" id="h_nm_sensor" class="form-control input-sm"    maxlength="30"  >
                        <label title='satuan'>Satuan</label>
                        <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm"    maxlength="10"  >
                    </div>
                    <div class="col-sm-4">
                        <label title='alt_id'>Alt Id</label>
                        <input type="text" ng-model="h.alt_id" id="h_alt_id" class="form-control input-sm"    maxlength="20"  >
                        <label title='harian'>Harian</label>
                        <input type="text" ng-model="h.harian" id="h_harian" class="form-control input-sm"    maxlength="20"  >
                        <label title='alias'>Alias</label>
                        <input type="text" ng-model="h.alias" id="h_alias" class="form-control input-sm"    maxlength=""  >
                        <label title='nomor'>Nomor</label>
                        <input type="text" ng-model="h.nomor" id="h_nomor" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='icon'>Icon</label>
                        <input type="text" ng-model="h.icon" id="h_icon" class="form-control input-sm"    maxlength="30"  >
                        <label title='hide'>Hide</label>
                        <input type="text" ng-model="h.hide" id="h_hide" class="form-control input-sm"    maxlength=""  >
                        <label title='marker'>Marker</label>
                        <input type="text" ng-model="h.marker" id="h_marker" class="form-control input-sm"    maxlength="20"  >
                        <label title='del_marker'>Del Marker</label>
                        <input type="text" ng-model="h.del_marker" id="h_del_marker" class="form-control input-sm"    maxlength="20"  >
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_jn_sensor')); ?>");
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
            item.formData = [{ id: $scope.h.rowid, path: 'trs_local_jn_sensor', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_jn_sensor/' + $scope.h.rowid, function(jdata) {
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
        SfLog('trs_local_jn_sensor',$scope.h.rowid);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/jn_sensor/jn_sensor_frm.blade.php ENDPATH**/ ?>