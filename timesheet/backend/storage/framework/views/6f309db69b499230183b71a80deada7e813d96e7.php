<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Plant <?php $__env->stopSection(); ?>
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
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.plant)">
                        <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{v.plant}}</td>
                        <td title="'Plantname'" filter="{plantname: 'text'}" sortable="'plantname'">{{v.plantname}}</td>
                        <td title="'Com Code'" filter="{com_code: 'text'}" sortable="'com_code'">{{v.com_code}}</td>
                        <td title="'Bus Area'" filter="{bus_area: 'text'}" sortable="'bus_area'">{{v.bus_area}}</td>
                        <td title="'Old Plant'" filter="{old_plant: 'text'}" sortable="'old_plant'">{{v.old_plant}}</td>
                        <td title="'Addr'" filter="{addr: 'text'}" sortable="'addr'">{{v.addr}}</td>
                        <td title="'City'" filter="{city: 'text'}" sortable="'city'">{{v.city}}</td>
                        <td title="'Provice'" filter="{provice: 'text'}" sortable="'provice'">{{v.provice}}</td>
                        <td title="'State'" filter="{state: 'text'}" sortable="'state'">{{v.state}}</td>
                        <td title="'Postcode'" filter="{postcode: 'text'}" sortable="'postcode'">{{v.postcode}}</td>
                        <td title="'Area'" filter="{area: 'text'}" sortable="'area'">{{v.area}}</td>
                        <td title="'Coordinate'" filter="{coordinate: 'text'}" sortable="'coordinate'">{{v.coordinate}}</td>
                        <td title="'Url File'" filter="{url_file: 'text'}" sortable="'url_file'">{{v.url_file}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Plant</label>
                        <input type="text" ng-model="h.plant" id="h_plant" class="form-control input-sm" required   maxlength="10"   ng-readonly="f.crud!='c'  " >
                        <label>Plantname</label>
                        <input type="text" ng-model="h.plantname" id="h_plantname" class="form-control input-sm" required   maxlength="30"  >
                        <label>Com Code</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.com_code" id="h_com_code" class="form-control input-sm"  readonly maxlength="10"  >
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('com_code','h_com_code')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label>Bus Area</label>
                        <input type="text" ng-model="h.bus_area" id="h_bus_area" class="form-control input-sm"    maxlength="10"  >
                    </div>
                    <div class="col-sm-4">
                        <label>Old Plant</label>
                        <input type="text" ng-model="h.old_plant" id="h_old_plant" class="form-control input-sm"    maxlength="10"  >
                        <label>Addr</label>
                        <input type="text" ng-model="h.addr" id="h_addr" class="form-control input-sm"    maxlength="100"  >
                        <label>City</label>
                        <input type="text" ng-model="h.city" id="h_city" class="form-control input-sm"    maxlength="30"  >
                        <label>Provice</label>
                        <input type="text" ng-model="h.provice" id="h_provice" class="form-control input-sm"    maxlength="30"  >
                    </div>
                    <div class="col-sm-4">
                        <label>State</label>
                        <input type="text" ng-model="h.state" id="h_state" class="form-control input-sm"    maxlength="30"  >
                        <label>Postcode</label>
                        <input type="text" ng-model="h.postcode" id="h_postcode" class="form-control input-sm"    maxlength="30"  >
                        <label>Area</label>
                        <input type="text" ng-model="h.area" id="h_area" class="form-control input-sm"    maxlength="30"  >
                        <label>Coordinate</label>
                        <input type="text" ng-model="h.coordinate" id="h_coordinate" class="form-control input-sm"    maxlength="30"  >
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('sys_syplant')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.m = [];

     var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            item.formData = [{ id: $scope.h.group_id, path: 'sys_sygroup', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('sys_sygroup/' + $scope.h.group_id, function(jdata) {
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
        $scope.h.plant=null;
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
                        trash:$scope.f.trash
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

    $scope.oDel = function(id,isRestore) {
        if (id == undefined) {
            var id = $scope.h.plant;
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
            case 'com_code':
                SfLookup("<?php echo e(url('sys_sycom_lookup')); ?>", function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');;
                });
                break;
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

     $scope.oLog=function(){
        SfLog('sys_syplant',$scope.h.plant);
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/syplant/syplant_frm.blade.php ENDPATH**/ ?>