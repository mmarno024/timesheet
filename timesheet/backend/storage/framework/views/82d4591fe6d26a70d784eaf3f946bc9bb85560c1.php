<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Checklist List <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
    <span ng-show="f.tab=='frm'">Form Entry</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
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
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                    style="white-space: nowrap;">
                    <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="oShow(v.kd_checklist)">
                        <td style="padding:6px;" title="'Kode'" filter="{kd_type: 'text'}" sortable="">
                            {{ v . rel_kd_ct . nm_ct }}</td>
                        <td style="padding:6px;" title="'Kode'" filter="{kd_type: 'text'}" sortable="">
                            {{ v . kd_checklist }}</td>
                        <td style="padding:6px;" title="'Checklist'" filter="{nm_checklist: 'text'}" sortable="">
                            {{ v . nm_checklist }}</td>
                    </tr>
                </table>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-2">
                            <label title='kd_ct'>Type</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_ct" id="h_kd_ct" class="form-control input-sm"
                                    readonly maxlength="15" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('kd_ct','h_nm_ct')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_checklist'>Kode</label>
                            <input type="text" ng-model="h.kd_checklist" id="h_kd_checklist" class="form-control input-sm"
                                maxlength="50" placeholder="auto" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label title='nm_checklist'>Name</label>
                            <input type="text" ng-model="h.nm_checklist" id="h_nm_checklist" class="form-control input-sm"
                                maxlength="50" required>
                        </div>
                    </div>
                    <hr />
                    <h3 class="text-primary">Isi checklist</h3>
                    <div class="list-group">
                        <div class="row m-b-5" ng-repeat="(k1,v1) in d1">
                            <div class="col-sm-12">
                                <div class="col-sm-9 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                        <tr>
                                            <td width="10%">{{ $index + 1 }}.</td>
                                            <td width="20%" class="text-primary p-0">
                                                <input type="text" ng-model="v1.kd_detail" class="form-control input-sm no-border-text text-primary" readonly placeholder="auto">
                                            </td>
                                            <td width="70%" class="text-primary p-0">
                                                <input type="text" ng-model="v1.nm_detail" placeholder="..." class="form-control input-sm no-border-text text-primary">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-2 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                        <tr>
                                            <td class="text-danger pointer" ng-click="oDelrow($index)" align="center">
                                                <span class="label label-danger">Delete checklist</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="addRow();">Add checklist</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_checklist')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.d1 = [];
            $scope.m = [];
            $scope.sensor = [];

            // $scope.oCekPlant = function() {
            //     SfService.httpGet("sys_syplant_cek_data", {
            //         userid: $scope.f.userid,
            //         plant: $scope.f.plant
            //     }, function(jdata) {
            //         $scope.cek_plant = jdata.data.data_cek_plant;
            //     });
            // }
            // $scope.oCekPlant();

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_sensor,
                        path: 'trs_local_mst_checklist',
                        s: 'i',
                        userid: $scope.f.userid,
                        plant: $scope.f.plant
                    }];
                },
                onSuccessItem: function(fileItem, response, status, headers) {
                    $scope.oGallery();
                }
            });

            $scope.oGallery = function() {
                SfGetMediaList('trs_local_mst_checklist/' + $scope.h.kd_sensor, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.d1 = [];
                $scope.m = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.kd_sensor = null;
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                if ($scope.f.plant == '002') {
                    $scope.tableList = new NgTableParams({
                        count: 25
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
                } else {
                    SfService.httpGet("trs_local_mst_checklist_list", {
                        plant: $scope.f.plant
                    }, function(jdata) {
                        $scope.data = jdata.data.data;
                    });
                }
            }

            $scope.oSave = function() {
                SfService.save("#frm", SfService.getUrl(), {
                    h: $scope.h,
                    d1: $scope.d1,
                    f: $scope.f
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.d1 = jdata.data.d1;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_ct':
                        SfLookup("<?php echo e(url('trs_local_mst_checklist_type_lookup')); ?>",
                            function(id, name, jsondata) {
                                $scope.h.kd_ct = jsondata.kd_ct;
                                $scope.h.nm_ct = jsondata.nm_ct;
                                $scope.$apply();
                            });
                        break;
                }
            }

            $scope.addRow = function() {
                $scope.d1.push({});
            }

            $scope.oDelrow = function(idx) {
                $scope.d1.splice(idx, 1);
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_checklist', $scope.h.kd_checklist);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\timesheet\backend\resources\views/trs/local/mst_checklist/mst_checklist_frm.blade.php ENDPATH**/ ?>