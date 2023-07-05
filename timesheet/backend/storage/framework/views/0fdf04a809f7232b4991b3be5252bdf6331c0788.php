<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>System Log <?php $__env->stopSection(); ?>
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
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oPrint()"><i
                                        class="fa fa fa-print"></i></button>
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
                    <div ng-show="f.tab=='frm'">
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
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
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{ v . id }}</td>
                            <td title="'Trs'" filter="{trs: 'text'}" sortable="'trs'">{{ v . trs }}</td>
                            <td title="'Doc No'" filter="{doc_no: 'text'}" sortable="'doc_no'">{{ v . doc_no }}</td>
                            <td title="'User'" filter="{created_by: 'text'}" sortable="'created_by'">{{ v . created_by }} -
                                {{ v . rel_created_by . username }}</td>
                            <td title="'Activity'" filter="{activity: 'text'}" sortable="'activity'">{{ v . activity }}
                            </td>
                            <td title="'Tag'" filter="{tag: 'text'}" sortable="'tag'">{{ v . tag }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Id</label>
                            <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly
                                maxlength="">
                            <label>Trs</label>
                            <input type="text" ng-model="h.trs" id="h_trs" class="form-control input-sm" required readonly
                                maxlength="30">
                        </div>
                        <div class="col-sm-4">
                            <label>Doc No</label>
                            <input type="text" ng-model="h.doc_no" id="h_doc_no" class="form-control input-sm" required
                                readonly maxlength="30">
                            <label>Tag</label>
                            <input type="text" ng-model="h.tag" id="h_tag" class="form-control input-sm" readonly
                                maxlength="200">
                        </div>
                        <div class="col-sm-4">
                            <label>Activity</label>
                            <textarea ng-model="h.activity" id="h_activity" class="form-control input-sm" required
                                rows="10"></textarea>
                        </div>
                    </div>
                    <hr>
                    <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams,
            SfService) {
            SfService.setUrl("<?php echo e(url('sys_sylog')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Session::get('userid')); ?>"
            };
            $scope.h = {};

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.id = null;
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
                                usercreated: $scope.f.userid
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
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.id;
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
                            var jdata = JSON.parse(jsondata);
                            $("#" + selector).val(id).trigger('input');;
                        });
                        break;*/
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }


            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\backend\resources\views/sys/sylog/sylog_frm.blade.php ENDPATH**/ ?>