<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Database Manager <?php $__env->stopSection(); ?>
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
                    <div class="input-group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i class="fa fa fa-file-excel-o"></i></button>
                            <button type="button" class="btn btn-success btn-sm" ng-click="oPrint()"><i class="fa fa fa-print"></i></button>
                            <button type="button" class="btn btn-success btn-sm" ng-click="oSearch(1)"><i class="fa fa fa-recycle"></i></button>
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
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oRunBackup()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-play"></i> Run Backup</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i class="fa fa-copy"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()" ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i class="fa fa-clock-o"></i> Log</button>
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                        <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                        <td title="'Database Host'" filter="{db_host: 'text'}" sortable="'db_host'">{{v.db_host}}</td>
                        <td title="'Database Name'" filter="{db_name: 'text'}" sortable="'db_name'">{{v.db_name}}</td>
                        <td title="'Database User'" filter="{db_user: 'text'}" sortable="'db_user'">{{v.db_user}}</td>
                        <td title="'Schedule Type'" filter="{schedule_type: 'text'}" sortable="'schedule_type'">{{v.schedule_type}}</td>
                        <td title="'Schedule Time'" filter="{schedule_time: 'text'}" sortable="'schedule_time'">{{v.schedule_time}}</td>
                        <td title="'Output Type'" filter="{output_type: 'text'}" sortable="'output_type'">{{v.output_type}}</td>
                        <td title="'Output Path'" filter="{output_path: 'text'}" sortable="'output_path'">{{v.output_path}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Id</label>
                        <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength="">
                        <label>Database Host</label>
                        <input type="text" ng-model="h.db_host" id="h_db_host" class="form-control input-sm" required maxlength="30">
                        <label>Database Name</label>
                        <input type="text" ng-model="h.db_name" id="h_db_name" class="form-control input-sm" required maxlength="30">
                        <label>Database User</label>
                        <input type="text" ng-model="h.db_user" id="h_db_user" class="form-control input-sm" required maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Database Password</label>
                        <input type="password" ng-model="h.db_pass" id="h_db_pass" class="form-control input-sm" maxlength="64">
                        <label>Config</label>
                        <input type="text" ng-model="h.config" id="h_config" class="form-control input-sm" maxlength="150">
                        <label>Schedule Type</label>
                        <select ng-model="h.schedule_type" id="h_schedule_type" class="form-control input-sm">
                            <option ng-repeat="v in [['none','None','hourly','Hourly'],['dailyAt','DailyAt'],['monthly','Monthly']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label>Schedule Time</label>
                        <input type="text" ng-model="h.schedule_time" id="h_schedule_time" class="form-control input-sm" maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Output Type</label>
                        <select ng-model="h.output_type" id="h_output_type" class="form-control input-sm" required>
                            <option ng-repeat="v in [['local','Local'],['ftp','FTP']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label>Output Path</label>
                        <input type="text" ng-model="h.output_path" id="h_output_path" class="form-control input-sm" maxlength="100">
                        <label>Note</label>
                        <textarea ng-model="h.note" id="h_note" class="form-control input-sm" rows="4"></textarea>
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('sys_sydump')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.m = [];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            item.formData = [{ id: $scope.h.group_id, path: 'sys_sydump', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('sys_sydump/' + $scope.h.group_id, function(jdata) {
            $scope.m = jdata.files;
            $scope.$apply();
        });
    }

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
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
                        trash: $scope.f.trash
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
        });
    }

    $scope.oDel = function(id, isRestore) {
        if (id == undefined) {
            var id = $scope.h.id;
        }
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), { restore: isRestore }, function(jdata) {
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
        SfLog('sys_sydump', $scope.h.id);
    }

    $scope.oRunBackup = function() {
        swal({
            title: "Are you sure?",
            text: "Backup needs a long time , id= " + $scope.h.id,
            type: "warning",
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                var $btn = $("#btn-dump").button('loading');
                SfService.httpPost(SfService.getUrl('_backup'), { id: $scope.h.id }, function(jdata) {
                    swal("", jdata.data, "success");
                });
            }
        });
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/sydump/sydump_frm.blade.php ENDPATH**/ ?>