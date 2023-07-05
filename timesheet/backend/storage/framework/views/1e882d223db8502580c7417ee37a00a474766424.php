<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Location <?php $__env->stopSection(); ?>
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
                        <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_location']); ?> <?php echo $__env->renderComponent(); ?>
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
                <button type="button" class="btn btn-sm btn-inverse" ng-attr-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_location)">
                            <td title="'Kode Location'" filter="{kd_location: 'text'}" sortable="'kd_location'">
                                {{ v . kd_location }}</td>
                            <td title="'Location'" filter="{location: 'text'}" sortable="'location'">
                                {{ v . location }}</td>
                            <td title="'Kecamatan'" filter="{nm_kecamatan: 'text'}" sortable="'nm_kecamatan'">
                                {{ v . nm_kecamatan }}</td>
                            <td title="'Kota/Kabupaten'" filter="{nm_kabupaten: 'text'}" sortable="'nm_kabupaten'">
                                {{ v . nm_kabupaten }}</td>
                            <td title="'Provinsi'" filter="{nm_provinsi: 'text'}" sortable="'nm_provinsi'">
                                {{ v . nm_provinsi }}</td>
                            <td title="'Project'" filter="{plant: 'text'}" sortable="'plant'">
                                {{ v . plant }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_location'>Kode Location</label>
                            <input type="text" ng-model="h.kd_location" id="h_kd_location" class="form-control input-sm"
                                maxlength="2" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-3">
                            <label title='location'>Location</label>
                            <input type="text" ng-model="h.location" id="h_location" class="form-control input-sm"
                                maxlength="30">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_provinsi'>Provinsi</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_provinsi+' | '+h.nm_provinsi" id="h_kd_provinsi"
                                    class="form-control input-sm" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_provinsi','h_kd_provinsi')"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_kabupaten'>Kota/Kabupaten</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_kabupaten+' | '+h.nm_kabupaten" id="h_kd_kabupaten"
                                    class="form-control input-sm" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_kabupaten','h_kd_kabupaten')"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label title='kd_kecamatan'>Kecamatan</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.kd_kecamatan+' | '+h.nm_kecamatan" id="h_kd_kecamatan"
                                    class="form-control input-sm" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-sm" type="button"
                                        ng-click="oLookup('kd_kecamatan','h_kd_kecamatan')"><i
                                            class="fa fa-search"></i></button>
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
            SfService.setUrl("<?php echo e(url('trs_local_mst_location')); ?>");
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
                        id: $scope.h.kd_location,
                        path: 'trs_local_mst_location',
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
                SfGetMediaList('trs_local_mst_location/' + $scope.h.kd_location, function(jdata) {
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
                $scope.h.kd_location = null;
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
                    f: $scope.f,
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.d = jdata.data.d;
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_provinsi':
                        SfLookup("<?php echo e(url('trs_local_mst_provinsi_lookup')); ?>",
                            function(id, name, jsondata) {
                                $scope.h.kd_provinsi = jsondata.kd_provinsi;
                                $scope.h.nm_provinsi = jsondata.nm_provinsi;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_kabupaten':
                        SfLookup("<?php echo e(url('trs_local_mst_kabupaten_lookup')); ?>?provinsi=" + $scope.h
                            .kd_provinsi,
                            function(id, name, jsondata) {
                                $scope.h.kd_kabupaten = jsondata.kd_kabupaten;
                                $scope.h.nm_kabupaten = jsondata.nm_kabupaten;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_kecamatan':
                        SfLookup("<?php echo e(url('trs_local_mst_kecamatan_lookup')); ?>?kabupaten=" + $scope.h
                            .kd_kabupaten,
                            function(id, name, jsondata) {
                                $scope.h.kd_kecamatan = jsondata.kd_kecamatan;
                                $scope.h.nm_kecamatan = jsondata.nm_kecamatan;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_mst_logger', $scope.h.kd_logger);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\psda\psda\backend\resources\views/trs/local/mst_location/mst_location_frm.blade.php ENDPATH**/ ?>