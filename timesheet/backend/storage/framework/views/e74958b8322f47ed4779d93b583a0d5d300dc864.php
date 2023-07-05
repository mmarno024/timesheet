<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Report Generator <?php $__env->stopSection(); ?>
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
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.rptid)">
                        <td title="'Rptid'" filter="{rptid: 'text'}" sortable="'rptid'">{{v.rptid}}</td>
                        <td title="'Ctg'" filter="{ctg: 'text'}" sortable="'ctg'">{{v.ctg}}</td>
                        <td title="'Rptname'" filter="{rptname: 'text'}" sortable="'rptname'">{{v.rptname}}</td>
                        <td title="'Rptdesc'" filter="{rptdesc: 'text'}" sortable="'rptdesc'">{{v.rptdesc}}</td>
                        <td title="'Str Conn'" filter="{str_conn: 'text'}" sortable="'str_conn'">{{v.str_conn}}</td>
                        <td title="'Str Query'" filter="{str_query: 'text'}" sortable="'str_query'">{{v.str_query}}</td>
                        <td title="'Rptconfig'" filter="{rptconfig: 'text'}" sortable="'rptconfig'">{{v.rptconfig}}</td>
                        <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{v.plant}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Report Id</label>
                        <input type="text" ng-model="h.rptid" id="h_rptid" class="form-control input-sm" readonly maxlength="">
                        <label>Category</label>
                        <div class="input-group">
                            <select ng-model="h.ctg" id="h_ctg" class="form-control input-sm">
                                <option ng-repeat="v in f.ctgs" ng-value="v[0]">{{v[1]}}</option>
                            </select>
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-default"  ng-click="addCombo('ctg')" title="Add"><i class="fa fa-plus"></i></button></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Description</label>
                        <input type="text" ng-model="h.rptdesc" id="h_rptdesc" class="form-control input-sm" maxlength="100">
                        <label>Report Name</label>
                        <input type="text" ng-model="h.rptname" id="h_rptname" class="form-control input-sm" maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Connection</label>
                        <div class="input-group">
                            <select ng-model="h.str_conn" id="h_str_conn" class="form-control input-sm">
                                <option ng-repeat="v in f.conns" ng-value="v[0]">{{v[1]}}</option>
                            </select>
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-default"  ng-click="addCombo('str_conn')" title="Add"><i class="fa fa-plus"></i></button></span>
                        </div>
                        <label>Config</label>
                        <input type="text" ng-model="h.rptconfig" id="h_rptconfig" class="form-control input-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Query</label>
                        <textarea ng-model="h.str_query" id="h_str_query" class="form-control input-sm" rows="8"></textarea>
                        <button type="button" ng-click="oSimulate(10)" class="btn btn-sm btn-success m-15"><i class="fa fa-play"></i> Simulate Top 10 Rows</button>
                        <button type="button" ng-click="oSimulate(0)" class="btn btn-sm btn-success m-15"><i class="fa fa-play"></i> Simulate All Rows</button>
                        <hr>
                        <h3>Query Result :</h3>
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered table-striped" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th ng-repeat="(k,v) in simulatelist[0]">{{k}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(key,value) in simulatelist">
                                        <td class="text-right">{{key+1}}.</td>
                                        <td ng-repeat="(k,v) in value">{{v}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('sys_syrpt')); ?>");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        trash: 0,
        userid: "<?php echo e(Auth::user()->userid); ?>",
        plant: "<?php echo e(Session::get('plant')); ?>",
        ctgs: [
            ['General', 'General (default)']
        ],
        conns: [
            ['local', 'local (default)']
        ]
    };
    $scope.h = {};
    $scope.simulatelist = [];
    $scope.m = [];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            item.formData = [{ id: $scope.h.group_id, path: 'sys_syrpt', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('sys_syrpt/' + $scope.h.group_id, function(jdata) {
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
        $scope.h.rptid = null;
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
            var id = $scope.h.rptid;
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
        SfLog('sys_syrpt', $scope.h.rptid);
    }

    $scope.addCombo = function(id) {
        swal({
            title: 'Add New Item',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Add',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                switch (id) {
                    case 'ctg':
                        $scope.f.ctgs.push([result.value, result.value]);
                        $scope.h.ctg = result.value;
                        $scope.$apply();
                        break;
                    case 'str_conn':
                        $scope.f.conns.push([result.value, result.value]);
                        $scope.h.str_conn = result.value;
                        $scope.$apply();
                        break;
                }
            }
        })
    }

    $scope.oSimulate = function(limit) {
        SfService.httpPost(SfService.getUrl('_simulate'), { h: $scope.h, f: $scope.f, limit: limit }, function(jdata) {
            console.log(jdata.data);
            $scope.simulatelist = jdata.data.data;
        });
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/syrpt/syrpt_frm.blade.php ENDPATH**/ ?>