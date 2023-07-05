<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Menu <?php $__env->stopSection(); ?>
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
        <hr>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item
                <br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.menu_id)">
                        <td title="'Menu Id'" filter="{menu_id: 'text'}" sortable="'menu_id'">{{v.menu_id}}</td>
                        <td title="'Label'" filter="{label: 'text'}" sortable="'label'">
                            {{v.rel_parent.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.rel_parent.label!=null"></i>
                            {{v.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.label!=null"></i> <b class="text-success">{{v.label}}</b>
                        </td>
                        <td title="'Url'" filter="{url: 'text'}" sortable="'url'">{{v.url}}</td>
                        <td title="'Redirect'" filter="{redirect: 'text'}" sortable="'redirect'">{{v.redirect}}</td>
                        <td title="'Icon'" filter="{icon: 'text'}" sortable="'icon'">{{v.icon}}</td>
                        <td title="'Note'" filter="{note: 'text'}" sortable="'note'">{{v.note}}</td>
                        <td title="'Order No'" filter="{order_no: 'text'}" sortable="'order_no'">{{v.order_no}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Menu Id</label>
                        <input type="text" ng-model="h.menu_id" id="h_menu_id" class="form-control input-sm" readonly maxlength="">
                        <label>Label</label>
                        <input type="text" ng-model="h.label" id="h_label" class="form-control input-sm" required maxlength="30">
                        <label>Url</label>
                        <input type="text" ng-model="h.url" id="h_url" class="form-control input-sm" maxlength="100">
                    </div>
                    <div class="col-sm-4">
                        <label>Redirect</label>
                        <input type="text" ng-model="h.redirect" id="h_redirect" class="form-control input-sm" maxlength="100">
                        <label>Parent</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.parent" id="h_parent" class="form-control input-sm" data-min-length="0" data-html="1" data-auto-select="true" data-animation="am-flip-x" bs-options="icon.value as icon.html for icon in getParents($viewValue)" bs-typeahead>
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('parent','h_parent')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label>Icon</label>
                        <input type="text" ng-model="h.icon" id="h_icon" class="form-control input-sm" maxlength="30" data-animation="am-flip-x" bs-options="state  for state in getAddress($viewValue)" data-auto-select="true" bs-typeahead>
                    </div>
                    <div class="col-sm-4">
                        <label>Note</label>
                        <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm" maxlength="30">
                        <label>Order No</label>
                        <input type="text" ng-model="h.order_no" id="h_order_no" class="form-control input-sm" ng-pattern="/[0-9.,]+/" format="number" maxlength="">
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams, SfService) {
    SfService.setUrl("<?php echo e(url('sys_symenu')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0 };
    $scope.h = {};

    $scope.getParents = function(viewValue) {
        return SfService.typeahead(SfService.getUrl('_autocomplete_parent'), {
            q: viewValue,
            plant: $scope.f.plant,
            limit: 10
        });
    };

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        SfFormNew("#frm");
    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.menu_id = null;
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
        });
    }

    $scope.oDel = function(id, isRestore) {
        if (id == undefined) {
            var id = $scope.h.menu_id;
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
            case 'parent':
                SfLookup(SfService.getUrl("_lookup"), function(id_, name, jsondata) {
                    $("#" + selector).val(id_).trigger('input');;
                });
                break;
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }


    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/symenu/symenu_frm.blade.php ENDPATH**/ ?>