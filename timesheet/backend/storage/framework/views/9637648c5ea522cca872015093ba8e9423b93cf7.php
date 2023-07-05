<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>EWS <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<style type="text/css">
#remov {
    text-decoration: none;
}
</style>
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
            <button ng-show="f.plant=='002' && f.tab=='list'" type="button" class="btn btn-sm btn-inverse" ng-click="oNew()"
                ng-attr-title="Buat Baru"><i class="fa fa-plus"></i> New</button>
            <button ng-show="f.plant!='002' && f.tab=='list'" type="button" class="btn btn-sm btn-default" ng-attr-title="Buat Baru"><i class="fa fa-plus"></i> New</button>
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
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.ews_id)">
                        <td style="padding:6px;" title="'EWS ID'" filter="{ews_id: 'text'}" sortable="">{{ v . ews_id }}</td>
                        <td style="padding:6px;" title="'Location'" filter="{ews_location: 'text'}" sortable="">{{ v . ews_location }}</td>
                        <td style="padding:6px;" title="'Latitude'" filter="{ews_latitude: 'text'}" sortable="">{{ v . ews_latitude }}</td>
                        <td style="padding:6px;" title="'Longitude'" filter="{ews_longitude: 'text'}" sortable="">{{ v . ews_longitude }}</td>
                        <td style="padding:6px;" title="'GSM Number'" filter="{ews_gsm: 'text'}" sortable="">{{ v . ews_gsm }}</td>
                        <td style="padding:6px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="">{{ v . kd_hardware != NULL ? v . kd_hardware + ' | ' + v . rel_kd_hardware . pos_name: '' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-3">
                        <label title='ews_id'>EWS ID</label>
                        <input type="text" ng-model="h.ews_id" id="h_ews_id" class="form-control input-sm" maxlength="16">
                    </div>
                    <div class="col-sm-5">
                        <label title='ews_location'>Location</label>
                        <input type="text" ng-model="h.ews_location" id="h_ews_location" class="form-control input-sm" ng-readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label title='ews_latitude'>Latitude</label>
                        <input type="number" ng-model="h.ews_latitude" id="h_ews_latitude" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label title='ews_longitude'>Longitude</label>
                        <input type="number" ng-model="h.ews_longitude" id="h_ews_longitude" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label title='ews_gsm'>GSM Number</label>
                        <input type="text" ng-model="h.ews_gsm" id="h_ews_gsm" class="form-control input-sm">
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_hardware'>Hardware</label>
                        <input type="text" ng-value="h.kd_hardware != NULL ? h.kd_hardware+' | '+h.hardware.pos_name : ''" id="h_kd_hardware" class="form-control input-sm" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_mst_ews')); ?>");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        trash: 0,
        userid: "<?php echo e(Auth::user()->userid); ?>",
        plant: "<?php echo e(Auth::user()->def_plant); ?>"
    };
    $scope.h = {};
    $scope.m = [];
    $scope.q = {};
    $scope.oCekPlant = function() {
        SfService.httpGet("sys_syplant_cek_data", {
            userid: $scope.f.userid,
            plant: $scope.f.plant
        }, function(jdata) {
            $scope.cek_plant = jdata.data.data_cek_plant;
        });
    }
    $scope.oCekPlant();

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        $scope.m = [];
        SfFormNew("#frm");
    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.kd_hardware = null;
    }

    $scope.oSearch = function(trash, order_by) {
        $scope.f.tab = "list";
        $scope.f.trash = trash;
        $scope.tableList = new NgTableParams({
            count: 50
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
                        userid: $scope.f.userid,
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
            f: $scope.f,
            h: $scope.h,
        }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oShow = function(id) {
        SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
            $scope.oNew();
            $scope.f.crud = 'u';
            $scope.h = jdata.data.h;
            $scope.oGallery();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLog = function() {
        SfLog('trs_local_mst_ews', $scope.h.ews_id);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\psda\admin\backend\resources\views/trs/local/mst_ews/mst_ews_frm.blade.php ENDPATH**/ ?>