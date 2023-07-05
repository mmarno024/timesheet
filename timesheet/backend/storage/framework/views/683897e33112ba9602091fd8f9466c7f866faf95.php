<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Kecamatan <?php $__env->stopSection(); ?>
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
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_kecamatan']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" ng-click="oPrint()"><i
                                            class="fa fa fa-print"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" ng-click="oSearch(1)"><i
                                            class="fa fa fa-recycle"></i></button>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                    placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div ng-show="f.tab=='frm'">
                            <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                                ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                            <button type="button" class="btn btn-sm btn-success" ng-click="oSave()"
                                ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                            <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i
                                    class="fa fa-copy"></i> Copy</button>
                            <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()"
                                ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                            <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                                ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                            <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                    class="fa fa-clock-o"></i> Log</button>
                            <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                            <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat', ['route' =>
                                'trs_local_mst_kecamatan', 'id' => 'h.kd_kecamatan']); ?> <?php echo $__env->renderComponent(); ?> </span>
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data">
                            <td title="'Kode Kecamatan'" filter="{kd_kecamatan: 'text'}" sortable="'kd_kecamatan'">
                                {{ v . kd_kecamatan }}</td>
                            <td title="'Nama Provinsi'" filter="{nm_provinsi: 'text'}" sortable="'nm_provinsi'">
                                {{ v . nm_provinsi }}</td>
                            <td title="'Nama Kabupaten'" filter="{nm_kabupaten: 'text'}" sortable="'nm_kabupaten'">
                                {{ v . nm_kabupaten }}</td>
                            <td title="'Nama Kecamatan'" filter="{nm_kecamatan: 'text'}" sortable="'nm_kecamatan'">
                                {{ v . nm_kecamatan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='kd_kecamatan'>Kd Kecamatan</label>
                            <input type="text" ng-model="h.kd_kecamatan" id="h_kd_kecamatan" class="form-control input-sm"
                                maxlength="7" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-4">
                            <label title='kd_kabupaten'>Kd Kabupaten</label>
                            <input type="text" ng-model="h.kd_kabupaten" id="h_kd_kabupaten" class="form-control input-sm"
                                maxlength="4">
                        </div>
                        <div class="col-sm-4">
                            <label title='nm_kecamatan'>Nm Kecamatan</label>
                            <input type="text" ng-model="h.nm_kecamatan" id="h_nm_kecamatan" class="form-control input-sm"
                                maxlength="30">
                        </div>
                    </div>
                    <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_kecamatan')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_kecamatan,
                        path: 'trs_local_mst_kecamatan',
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
                SfGetMediaList('trs_local_mst_kecamatan/' + $scope.h.kd_kecamatan, function(jdata) {
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
                $scope.h.kd_kecamatan = null;
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
                    var id = $scope.h.kd_kecamatan;
                }
                SfService.delete(SfService.getUrl("/" + encodeURI(id)), {
                    restore: isRestore
                }, function(jdata) {
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
                SfLog('trs_local_mst_kecamatan', $scope.h.kd_kecamatan);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/trs/local/mst_kecamatan/mst_kecamatan_frm.blade.php ENDPATH**/ ?>