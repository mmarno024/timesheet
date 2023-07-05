<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Rumus Inflow <?php $__env->stopSection(); ?>
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
                        <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_mst_rumus_inflow']); ?> <?php echo $__env->renderComponent(); ?>
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
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i
                                class="fa fa-copy"></i> Copy</button>
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()"
                            ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru"
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_ri)">
                            <td title="'Kode'" filter="{kd_ri: 'text'}" sortable="'kd_ri'">{{ v . kd_ri }}</td>
                            <td title="'Nama Rumus'" filter="{nm_ri: 'text'}" sortable="'nm_ri'">{{ v . nm_ri }}</td>
                            <td title="'A'" filter="{angka1: 'text'}" sortable="'angka1'">{{ v . angka1 }}</td>
                            <td title="'B'" filter="{angka2: 'text'}" sortable="'angka2'">{{ v . angka2 }}</td>
                            <td title="'C'" filter="{angka3: 'text'}" sortable="'angka3'">{{ v . angka3 }}</td>
                            <td title="'Pangkat'" filter="{pangkat: 'text'}" sortable="'pangkat'">{{ v . pangkat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='kd_ri'>Kode Rumus Inflow</label>
                            <input type="text" ng-value="h.kd_ri" id="h_kd_ri" class="form-control input-sm" readonly
                                placeholder="Auto">
                        </div>
                        <div class="col-sm-3">
                            <label title='nm_ri'>Nama Rumus Inflow</label>
                            <input type="text" ng-model="h.nm_ri" id="h_nm_ri" class="form-control input-sm" maxlength="25">
                        </div>
                    </div>
                    <div class="row m-t-10 m-b-10 m-l-2">
                        <div class="col-sm-6 bg-blue-lighter p-10">
                            <span class="text-white text-bold">Rumus Inflow :</span>
                            <p></p>
                            <span class="text-white text-bold">Q =
                                {{ h . angka1 == '' || h . angka1 == null ? 'A' : h . angka1 }}
                                (h)<sup>{{ h . pangkat == '' || h . pangkat == null ? 'Pangkat' : h . pangkat }}</sup> +
                                {{ h . angka2 == '' || h . angka2 == null ? 'B' : h . angka2 }}(h) +
                                {{ h . angka3 == '' || h . angka3 == null ? 'C' : h . angka3 }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label title='angka1'>A</label>
                            <input type="number" ng-model="h.angka1" id="h_angka1" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='angka2'>B</label>
                            <input type="number" ng-model="h.angka2" id="h_angka2" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='angka3'>C</label>
                            <input type="number" ng-model="h.angka3" id="h_angka3" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-3">
                            <label title='pangkat'>Pangkat</label>
                            <input type="number" ng-model="h.pangkat" id="h_pangkat" class="form-control input-sm"
                                maxlength="1">
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h3 class="text-success">Daftar Alat</h3>
                    <div>
                        <div class="list-group">
                            <div class="row m-b-5" ng-repeat="v in d">

                                <div class="col-sm-6">
                                    <div class="col-sm-6 m-0 p-0">
                                        <table class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td width="30%">{{ $index + 1 }}.</td>
                                                <td width="70%" class="text-success p-0">
                                                    <input type="text" ng-model="v.id_alat"
                                                        class="form-control input-sm no-border-text text-success">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-1 m-0 p-0">
                                        <table class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td class="text-danger pointer" ng-click="oDelrow($index)" align="center">
                                                    <span class="label label-danger">Hapus Alat</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <button type="button" class="btn btn-sm btn-success" ng-click="addRow();">Tambah Alat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_mst_rumus_inflow')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.d = [];

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                $scope.d = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.kd_ri = null;
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
                    d: $scope.d
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
                    if (chatCtrl() != undefined) {
                        chatCtrl().listChat();
                    }
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.kd_ri;
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
                SfLog('trs_local_mst_rumus_inflow', $scope.h.kd_ri);
            }

            $scope.addRow = function() {
                $scope.d.push({});
            }

            $scope.oDelrow = function(idx) {
                $scope.d.splice(idx, 1);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/trs/local/mst_rumus_inflow/mst_rumus_inflow_frm.blade.php ENDPATH**/ ?>