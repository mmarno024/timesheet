<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Mobile Application <?php $__env->stopSection(); ?>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_nmobapp']); ?> <?php echo $__env->renderComponent(); ?>
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
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i class="fa fa-copy"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()" ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i class="fa fa-clock-o"></i> Log</button>
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_nmobapp','id'=>'h.appid']); ?> <?php echo $__env->renderComponent(); ?> </span>
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
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.appid)">
                        <td title="'Application ID'" filter="{appid: 'text'}" sortable="'appid'">{{v.appid}}</td>
                        <td title="'Application Name'" filter="{app_name: 'text'}" sortable="'app_name'">{{v.app_name}}</td>
                        <td title="'Device'" filter="{is_android: 'text'}" sortable="'is_android'">
                            <i class="fa fa-android" ng-if="v.is_android==1"></i>
                            <i class="fa fa-apple" ng-if="v.is_ios==1"></i>
                            <i class="fa fa-windows" ng-if="v.is_windows==1"></i>
                        </td>
                        <td title="'Version'" filter="{ver: 'text'}" sortable="'ver'">Current : {{v.ver}} , Min : {{v.min_ver}}</td>
                        <td title="'Homepage'" filter="{app_link: 'text'}" sortable="'app_link'">{{v.app_link}}</td>
                        <td title="'Description'" filter="{note: 'text'}" sortable="'note'">{{v.note}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='appid'>Application ID</label>
                        <input type="text" ng-model="h.appid" id="h_appid" class="form-control input-sm" required maxlength="15" ng-readonly="f.crud!='c'  ">
                        <label title='app_name'>Application Name</label>
                        <input type="text" ng-model="h.app_name" id="h_app_name" class="form-control input-sm" required maxlength="30">
                        <label title='ver'>Current Version</label>
                        <input type="text" ng-model="h.ver" id="h_ver" class="form-control input-sm" maxlength="30" awnum="default">
                        <label title='min_ver'>Minimum Version</label>
                        <input type="text" ng-model="h.min_ver" id="h_min_ver" class="form-control input-sm" awnum="default">
                    </div>
                    <div class="col-sm-4">
                        <label title='is_android'>Support Android</label>
                        <select ng-model="h.is_android" id="h_is_android" class="form-control input-sm">
                            <option ng-repeat="v in [[1,'Yes'],[0,'No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label title='is_ios'>Support IOS</label>
                        <select ng-model="h.is_ios" id="h_is_ios" class="form-control input-sm">
                            <option ng-repeat="v in [[1,'Yes'],[0,'No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label title='is_windows'>Support Windows</label>
                        <select ng-model="h.is_windows" id="h_is_windows" class="form-control input-sm">
                            <option ng-repeat="v in [[1,'Yes'],[0,'No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label title='is_multi_login'>Multi Login</label>
                        <select ng-model="h.is_multi_login" id="h_is_multi_login" class="form-control input-sm">
                            <option ng-repeat="v in [[1,'Yes'],[0,'No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label title='app_link'>URL Homepage</label>
                        <input type="text" ng-model="h.app_link" id="h_app_link" class="form-control input-sm" maxlength="50">
                        <label title='note'>Description</label>
                        <textarea ng-model="h.note" id="h_note" class="form-control input-sm"></textarea>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_nmobapp')); ?>");
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
            item.formData = [{ id: $scope.h.appid, path: 'trs_local_nmobapp', s: 'x', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_nmobapp/' + $scope.h.appid, function(jdata) {
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
        $scope.h.appid = null;
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
            var id = $scope.h.appid;
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
        SfLog('trs_local_nmobapp', $scope.h.appid);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/trs/local/nmobapp/nmobapp_frm.blade.php ENDPATH**/ ?>