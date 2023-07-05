<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Stasiun <?php $__env->stopSection(); ?>
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
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_stasiun']); ?> <?php echo $__env->renderComponent(); ?>
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
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
                            <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                                ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                            <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                    class="fa fa-clock-o"></i> Log</button>
                        </div>
                    </div>
                </div>
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_stasiun)">
                            <td title="'Area'" filter="{kd_area: 'text'}" sortable="'kd_area'">{{ v . kd_area }}</td>
                            <td title="'Kode Stasiun'" filter="{kd_stasiun: 'text'}" sortable="'kd_stasiun'">
                                {{ v . kd_stasiun }}</td>
                            <td title="'Nama Stasiun'" filter="{nm_stasiun: 'text'}" sortable="'nm_stasiun'">
                                {{ v . nm_stasiun }}</td>
                            <td title="'Longitude'" filter="{longitude: 'text'}" sortable="'longitude'">
                                {{ v . longitude }}
                            </td>
                            <td title="'Lokasi'" filter="{lokasi: 'text'}" sortable="'lokasi'">
                                {{ v . lokasi }}
                            </td>
                            <td title="'Latitude'" filter="{latitude: 'text'}" sortable="'latitude'">{{ v . latitude }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_stasiun'>Kode Stasiun</label>
                            <input type="text" ng-model="h.kd_stasiun" id="h_kd_stasiun" class="form-control input-sm"
                                maxlength="" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-3">
                            <label title='nm_stasiun'>Nama Stasiun</label>
                            <input type="text" ng-model="h.nm_stasiun" id="h_nm_stasiun" class="form-control input-sm"
                                maxlength="50">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='latitude'>Latitude</label>
                            <input type="number" ng-model="h.latitude" id="h_latitude" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='longitude'>Longitude</label>
                            <input type="number" ng-model="h.longitude" id="h_longitude" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='lokasi'>Lokasi</label>
                            <input type="number" ng-model="h.lokasi" id="h_lokasi" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_area'>Area</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_area+' | '+h.nm_area" id="h_kd_area"
                                    class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_area','h_kd_area')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
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
            SfService.setUrl("<?php echo e(url('trs_local_mst_stasiun')); ?>");
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
                        id: $scope.h.kd_stasiun,
                        path: 'trs_local_mst_stasiun',
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
                SfGetMediaList('trs_local_mst_stasiun/' + $scope.h.kd_stasiun, function(jdata) {
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
                $scope.h.kd_stasiun = null;
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

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_area':
                        SfLookup("<?php echo e(url('trs_local_mst_area_lookup')); ?>?plant=" + $scope.f.plant +
                            "&kabupaten=" + $scope.h.kd_kabupaten,
                            function(id, name, jsondata) {
                                $scope.h.kd_area = jsondata.kd_area;
                                $scope.h.nm_area = jsondata.nm_area;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_stasiun', $scope.h.kd_stasiun);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/trs/local/mst_stasiun/mst_stasiun_frm.blade.php ENDPATH**/ ?>