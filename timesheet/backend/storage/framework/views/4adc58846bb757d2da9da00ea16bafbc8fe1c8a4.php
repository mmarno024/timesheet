<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Desa <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch(1)"><i
                                            class="fa fa fa-recycle"></i></button>
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
                            <td title="'Kode Desa'" filter="{kd_desa: 'text'}" sortable="'kd_desa'">{{ v . kd_desa }}
                            </td>
                            <td title="'Nama Provinsi'" filter="{nm_provinsi: 'text'}" sortable="'nm_provinsi'">
                                {{ v . nm_provinsi }}</td>
                            <td title="'Nama Kabupaten'" filter="{nm_kabupaten: 'text'}" sortable="'nm_kabupaten'">
                                {{ v . nm_kabupaten }}</td>
                            <td title="'Nama Kecamatan'" filter="{nm_kecamatan: 'text'}" sortable="'nm_kecamatan'">
                                {{ v . nm_kecamatan }}</td>
                            <td title="'Nama Desa'" filter="{nm_desa: 'text'}" sortable="'nm_desa'">{{ v . nm_desa }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='kd_desa'>Kd Desa</label>
                            <input type="text" ng-model="h.kd_desa" id="h_kd_desa" class="form-control input-sm"
                                maxlength="10" ng-readonly="f.crud!='c'  ">
                        </div>
                        <div class="col-sm-4">
                            <label title='kd_kecamatan'>Kd Kecamatan</label>
                            <input type="text" ng-model="h.kd_kecamatan" id="h_kd_kecamatan" class="form-control input-sm"
                                maxlength="7">
                        </div>
                        <div class="col-sm-4">
                            <label title='nm_desa'>Nm Desa</label>
                            <input type="text" ng-model="h.nm_desa" id="h_nm_desa" class="form-control input-sm"
                                maxlength="40">
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
            SfService.setUrl("<?php echo e(url('trs_local_mst_desa')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};

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

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\backend\resources\views/trs/local/mst_desa/mst_desa_frm.blade.php ENDPATH**/ ?>