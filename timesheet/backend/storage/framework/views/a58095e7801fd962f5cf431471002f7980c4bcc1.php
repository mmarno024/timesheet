<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>State <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_tr_state']); ?> <?php echo $__env->renderComponent(); ?>
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
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_tr_state','id'=>'h.rowid']); ?>  <?php echo $__env->renderComponent(); ?> </span>
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
                        <td title="'Id Instansi'" filter="{id_instansi: 'text'}" sortable="'id_instansi'">{{v.id_instansi}}</td>
                        <td title="'Id Analisa'" filter="{id_analisa: 'text'}" sortable="'id_analisa'">{{v.id_analisa}}</td>
                        <td title="'Channel Ch'" filter="{channel_ch: 'text'}" sortable="'channel_ch'">{{v.channel_ch}}</td>
                        <td title="'Channel Rt'" filter="{channel_rt: 'text'}" sortable="'channel_rt'">{{v.channel_rt}}</td>
                        <td title="'Tgl Update'" filter="{tgl_update: 'text'}" sortable="'tgl_update'">{{v.tgl_update}}</td>
                        <td title="'Tgl Mulai'" filter="{tgl_mulai: 'text'}" sortable="'tgl_mulai'">{{v.tgl_mulai}}</td>
                        <td title="'Tgl Sampai'" filter="{tgl_sampai: 'text'}" sortable="'tgl_sampai'">{{v.tgl_sampai}}</td>
                        <td title="'Ch Cacah'" filter="{ch_cacah: 'text'}" sortable="'ch_cacah'">{{v.ch_cacah}}</td>
                        <td title="'Ch Total'" filter="{ch_total: 'text'}" sortable="'ch_total'">{{v.ch_total}}</td>
                        <td title="'Rt Cacah'" filter="{rt_cacah: 'text'}" sortable="'rt_cacah'">{{v.rt_cacah}}</td>
                        <td title="'Rt Awal'" filter="{rt_awal: 'text'}" sortable="'rt_awal'">{{v.rt_awal}}</td>
                        <td title="'Rt Akhir'" filter="{rt_akhir: 'text'}" sortable="'rt_akhir'">{{v.rt_akhir}}</td>
                        <td title="'Status'" filter="{status: 'text'}" sortable="'status'">{{v.status}}</td>
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
                        <label title='id_instansi'>Id Instansi</label>
                        <input type="text" ng-model="h.id_instansi" id="h_id_instansi" class="form-control input-sm"    maxlength="10"  >
                        <label title='id_analisa'>Id Analisa</label>
                        <input type="text" ng-model="h.id_analisa" id="h_id_analisa" class="form-control input-sm"    maxlength=""  >
                        <label title='channel_ch'>Channel Ch</label>
                        <input type="text" ng-model="h.channel_ch" id="h_channel_ch" class="form-control input-sm"    maxlength="10"  >
                        <label title='channel_rt'>Channel Rt</label>
                        <input type="text" ng-model="h.channel_rt" id="h_channel_rt" class="form-control input-sm"    maxlength="10"  >
                    </div>
                    <div class="col-sm-4">
                        <label title='tgl_update'>Tgl Update</label>
                        <input type="text" ng-model="h.tgl_update" id="h_tgl_update" class="form-control input-sm"    maxlength=""  >
                        <label title='tgl_mulai'>Tgl Mulai</label>
                        <input type="text" ng-model="h.tgl_mulai" id="h_tgl_mulai" class="form-control input-sm"    maxlength=""  >
                        <label title='tgl_sampai'>Tgl Sampai</label>
                        <input type="text" ng-model="h.tgl_sampai" id="h_tgl_sampai" class="form-control input-sm"    maxlength=""  >
                        <label title='ch_cacah'>Ch Cacah</label>
                        <input type="text" ng-model="h.ch_cacah" id="h_ch_cacah" class="form-control input-sm"    maxlength=""  >
                        <label title='ch_total'>Ch Total</label>
                        <input type="text" ng-model="h.ch_total" id="h_ch_total" class="form-control input-sm"    maxlength=""  >
                    </div>
                    <div class="col-sm-4">
                        <label title='rt_cacah'>Rt Cacah</label>
                        <input type="text" ng-model="h.rt_cacah" id="h_rt_cacah" class="form-control input-sm"    maxlength=""  >
                        <label title='rt_awal'>Rt Awal</label>
                        <input type="text" ng-model="h.rt_awal" id="h_rt_awal" class="form-control input-sm"    maxlength=""  >
                        <label title='rt_akhir'>Rt Akhir</label>
                        <input type="text" ng-model="h.rt_akhir" id="h_rt_akhir" class="form-control input-sm"    maxlength=""  >
                        <label title='status'>Status</label>
                        <input type="text" ng-model="h.status" id="h_status" class="form-control input-sm"    maxlength=""  >
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_tr_state')); ?>");
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
            item.formData = [{ id: $scope.h.rowid, path: 'trs_local_tr_state', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_tr_state/' + $scope.h.rowid, function(jdata) {
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
        SfLog('trs_local_tr_state',$scope.h.rowid);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/tr_state/tr_state_frm.blade.php ENDPATH**/ ?>