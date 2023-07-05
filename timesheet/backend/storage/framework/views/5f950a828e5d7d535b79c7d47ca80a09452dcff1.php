<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>System Parameter <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span>
<span ng-click="f.tab='list'">Advance</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<div class="row" ng-show="f.tab=='dash'">
    <div class="row">
        <?php foreach ($arr as $keys => $values): ?>
        <div class="col-md-6">
            <?php foreach ($values as $key => $value): ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                    </div>
                    <?php echo e($key); ?>

                </div>
                <div class="panel-body table-responsive" style="display: none;">
                    <table class="table table-condensed table-striped table-hover">
                        <?php foreach ($value as $k => $v): ?>
                        <tr class="pointer text-bold" ng-click="oDisp('<?php echo e($v->parid); ?>','<?php echo e($v->parname); ?>')">
                            <td>
                                <?php if ($v->isplant == 1): ?>
                                <span class="label label-warning pull-right"><?php echo e(Session::get('plant')); ?></span>
                                <?php endif?>
                                <?php echo e($k+1); ?>. <?php echo e($v->parname); ?>

                            </td>
                        </tr>
                        <tr class="pointer" ng-click="oDisp('<?php echo e($v->parid); ?>','<?php echo e($v->parname); ?>')">
                            <td class="p-l-20"><?php echo e($v->isplant==1?\App\Sf::getJson($v->parvalue,Session::get('plant')):$v->parvalue); ?></td>
                        </tr>
                        <?php endforeach?>
                    </table>
                </div>
                <div class="panel-footer text-success pointer" data-click="panel-collapse">
                    Total : <?php echo e(count($value)); ?> rows
                </div>
            </div>
            <?php endforeach?>
        </div>
        <?php endforeach?>
    </div>
</div>
<div class="panel panel-success" ng-show="f.tab=='frm' || f.tab=='list'">
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
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='dash'"><i class="fa fa-arrow-left"></i> Dashboard</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item
                <br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.parid)">
                        <td title="'ID'" filter="{parid: 'text'}" sortable="'parid'">{{v.parid}}</td>
                        <td title="'Group'" filter="{pargroup: 'text'}" sortable="'pargroup'">{{v.pargroup}}</td>
                        <td title="'Parameter Name'" filter="{parname: 'text'}" sortable="'parname'">{{v.parname}}</td>
                        <td title="'Value'" filter="{parvalue: 'text'}" sortable="'parvalue'">{{v.parvalue}}</td>
                        <td title="'Note'" filter="{parnote: 'text'}" sortable="'parnote'">{{v.parnote}}</td>
                        <td title="'Input Type'" filter="{input_type: 'text'}" sortable="'input_type'">{{v.input_type}}</td>
                        <td title="'Specific Plant'" filter="{isplant: 'text'}" sortable="'isplant'">{{v.isplant}}</td>
                        <td title="'Option Pattern'" filter="{option_value: 'text'}" sortable="'option_value'">{{v.option_value}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>ID</label>
                        <input type="text" ng-model="h.parid" id="h_parid" class="form-control input-sm" ng-readonly="f.crud!='c'" maxlength="20">
                        <label>Group</label>
                        <div class="input-group">
                            <select ng-model="h.pargroup" id="h_pargroup" class="form-control input-sm" required>
                                <option ng-repeat="v in dataset.pargroup" ng-value="v">{{v}}</option>
                            </select>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-default" ng-click="addCombo('pargroup')"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <label>Parameter Name</label>
                        <input type="text" ng-model="h.parname" id="h_parname" class="form-control input-sm" required maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Value</label>
                        <input type="text" ng-model="h.parvalue" id="h_parvalue" class="form-control input-sm" readonly maxlength="">
                        <label>Note</label>
                        <input type="text" ng-model="h.parnote" id="h_parnote" class="form-control input-sm" maxlength="30">
                        <label>Input Type</label>
                        <select ng-model="h.input_type" id="h_input_type" class="form-control input-sm" required>
                            <option ng-repeat="v in [['text','text'],['textarea','textarea'],['date','date'],['number','number'],['select','select']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Specific Plant</label>
                        <select ng-model="h.isplant" id="h_isplant" class="form-control input-sm">
                            <option ng-repeat="v in [['1','Yes'],['0','No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                        <label>Option Pattern</label>
                        <textarea ng-model="h.option_value" id="h_option_value" class="form-control input-sm"></textarea>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams, SfService) {
    SfService.setUrl("<?php echo e(url('sys_syparsys')); ?>");
    $scope.f = { crud: 'c', tab: 'dash', trash: 0, plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.dataset = { pargroup: [] };
    <?php foreach ($pargroups as $key => $v): ?>
    $scope.dataset.pargroup.push("<?php echo e($v->pargroup); ?>");
    <?php endforeach?>

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        SfFormNew("#frm");
    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.parid = null;
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
            var id = $scope.h.parid;
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
        SfLog('sys_syparsys', $scope.h.parid);
    }

    $scope.oDisp = function(id, sname) {
        SfDialog("disp_parsys", sname + '.', "modal-lg", function() {
            $("#disp_parsys .modal-body").html("Please Wait..");
            SfService.httpGet(SfService.getUrl('_disp'), { id: id, plant: $scope.f.plant }, function(jdata) {
                $("#disp_parsys .modal-body").html(jdata.data);
            });
        });
    }

    $scope.saveDash = function(id) {
        SfService.httpPost(SfService.getUrl('_saveDash'), {
            plant: $scope.f.plant,
            parid: id,
            parvalue: $("#d_parvalue").val()
        }, function(jdata) {
            window.location.reload();
        });
    }

    $scope.addCombo = function(id) {
        switch (id) {
            case 'pargroup':
                swal({
                        title: 'Add new group',
                        input: 'text',
                        showCancelButton: true,
                    })
                    .then((value) => {
                        $scope.dataset.pargroup.push(value.value);
                        $scope.$apply();
                    });
                break;
        }
    }

}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/syparsys/syparsys_frm.blade.php ENDPATH**/ ?>