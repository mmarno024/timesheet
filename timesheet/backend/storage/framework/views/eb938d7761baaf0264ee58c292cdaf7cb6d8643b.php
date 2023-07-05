<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Security Access | {{f.menuSelected[1]}} <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span>
<span ng-show="f.tab=='audit'">Security Audit</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<style type="text/css">
.todolist>li.active>a .todolist-title {
    text-decoration: underline;
    font-weight: bold;
}
</style>
<div class="row" ng-show="f.tab=='dash'">
    <div class="col-sm-3">
        <div class="panel panel-inverse">
            <div class="panel-heading">Security</div>
            <div class="panel-body p-0">
                <ul class="todolist">
                    <li ng-repeat="v in f.submenu" ng-click="oSubMenu(v,$index)" ng-class="{active: v[2]==1}">
                        <a href="javascript:;" class="todolist-container">
                            <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                            <div class="todolist-title">{{v[1]}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="todolist-container" ng-click="f.tab='audit'">
                            <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                            <div class="todolist-title">Security Audit</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="todolist-container" ng-click="f.tab='list'">
                            <div class="todolist-input"><i class="fa fa-gears"></i></div>
                            <div class="todolist-title">Advance Setting</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('sys_syparsys')); ?>" class="todolist-container">
                            <div class="todolist-input"><i class="fa fa-gears"></i></div>
                            <div class="todolist-title">Parameter System</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="todolist-container" ng-click="cleanUp()">
                            <div class="todolist-input"><i class="fa fa-magic"></i></div>
                            <div class="todolist-title">Clean Up Access</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="panel panel-inverse">
            <div class="panel-heading">Setting <b>{{f.menuSelected[1]}}</b></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="text-capitalize">{{f.menuSelected[3]}} ID</label>
                        <div class="input-group">
                            <input type="text" ng-model="d.key1" id="d_key1" class="form-control input-sm" readonly maxlength="">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup(f.menuSelected[3],'d_key1')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="text-capitalize">{{f.menuSelected[3]}} Name</label>
                        <input type="text" ng-model="d.name" id="d_name" class="form-control input-sm" readonly maxlength="">
                    </div>
                    <div class="col-sm-2">
                        <label>Cari : </label>
                        <input type="text" ng-model="f.qdash" class="form-control input-sm" maxlength="" placeholder="Search" ng-enter="oLoadDash();">
                    </div>
                    <div class="col-sm-2" ng-if="f.menuSelected[5]=='syaccess'">
                        <label>Option</label>
                        <select class="form-control input-sm" ng-model="f.bydept" ng-change="oLoadDash()">
                            <option ng-repeat="v in [['0','All Department'],['1','By Department']]" ng-value="v[0]" ng-selected="v[1]=='0'">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-sm btn-block btn-success" ng-click="oLoadDash();"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="row" ng-if="f.bydept=='1'">
                    <div class="col-sm-3">
                        <label class="text-capitalize">Department</label>
                        <div class="input-group">
                            <input type="text" ng-model="d.dept" id="d_dept" class="form-control input-sm" readonly maxlength="">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('dept','d_dept')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="text-capitalize">Department Name</label>
                        <input type="text" ng-model="d.dept_name" id="d_dept_name" class="form-control input-sm" readonly maxlength="">
                    </div>
                </div>
                <hr>
                <div class="table-responsive" ng-show="f.menuSelected[5]=='syplant'">
                    <table ng-table="tableDash" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oSet(v.plant,v.flag,$index,v)">
                            <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{v.plant}}</td>
                            <td title="'Plant Name'" filter="{plantname: 'text'}" sortable="'plantname'">{{v.plantname}}</td>
                            <td title="'#'" class="text-center">
                                <span ng-show="v.flag!=1" class="text-danger"><i class="fa fa-circle"></i> Blocked</span>
                                <span ng-show="v.flag==1" class="text-success"><i class="fa fa-circle"></i> Allowed</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive" ng-show="f.menuSelected[5]=='sygroup'">
                    <table ng-table="tableDash" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oSet(v.group_id,v.flag,$index,v)">
                            <td title="'Group ID'" filter="{group_id: 'text'}" sortable="'group_id'">{{v.group_id}}</td>
                            <td title="'Group Name'" filter="{group_name: 'text'}" sortable="'group_name'">{{v.group_name}}</td>
                            <td title="'#'" class="text-center">
                                <span ng-show="v.flag!=1" class="text-danger"><i class="fa fa-circle"></i> Blocked</span>
                                <span ng-show="v.flag==1" class="text-success"><i class="fa fa-circle"></i> Allowed</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive" ng-show="f.menuSelected[5]=='symenu'">
                    <table ng-table="tableDash" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oSet(v.menu_id,v.flag,$index,v)">
                            <td title="'Menu Id'" filter="{menu_id: 'text'}" sortable="'menu_id'">{{v.menu_id}}</td>
                            <td title="'Label'" filter="{label: 'text'}" sortable="'label'">
                                {{v.rel_parent.rel_parent.rel_parent.rel_parent.label}}
                                <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.rel_parent.rel_parent.label}}
                                <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.rel_parent.label}}
                                <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.label}}
                                <i class="fa fa-arrow-right" ng-show="v.rel_parent.label!=null"></i> <b class="text-success">{{v.label}}</b>
                            </td>
                            <td title="'Url'" filter="{url: 'text'}" sortable="'url'">{{v.url}}</td>
                            <td title="'#'" class="text-center">
                                <span ng-show="v.flag!=1" class="text-danger"><i class="fa fa-circle"></i> Blocked</span>
                                <span ng-show="v.flag==1" class="text-success"><i class="fa fa-circle"></i> Allowed</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive" ng-show="f.menuSelected[5]=='syaccess'">
                    <table ng-table="tableDash" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oSet(v.accessid,v.flag,$index,v)">
                            <td title="'Accessid'" filter="{accessid: 'text'}" sortable="'accessid'">{{v.accessid}}</td>
                            <td title="'Accessname'" filter="{accessname: 'text'}" sortable="'accessname'">{{v.accessname}}</td>
                            <td title="'Scope'" filter="{location: 'text'}" sortable="'location'">
                                <span ng-show="v.location==1" class="text-danger">By Plant</span>
                                <span ng-show="v.location==2" class="text-danger">By Dept</span>
                                <span ng-show="v.location!=1&&v.location!=2">All Plant</span>
                            </td>
                            <td title="'#'" class="text-center">
                                <span ng-show="v.flag!=1" class="text-danger"><i class="fa fa-circle"></i> Blocked</span>
                                <span ng-show="v.flag==1" class="text-success"><i class="fa fa-circle"></i> Allowed</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive" ng-show="f.menuSelected[5]=='syguide'">
                    <table ng-table="tableDash" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oSet(v.id,v.flag,$index,v)">
                            <td title="'ID Guide'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                            <td title="'Subject'" filter="{subj: 'text'}" sortable="'subj'">{{v.subj}}</td>
                            <td title="'Categories'" filter="{cat: 'text'}" sortable="'cat'">{{v.cat}}</td>
                            <td title="'#'" class="text-center">
                                <span ng-show="v.flag!=1" class="text-danger"><i class="fa fa-circle"></i> Blocked</span>
                                <span ng-show="v.flag==1" class="text-success"><i class="fa fa-circle"></i> Allowed</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-success" ng-show="f.tab=='frm' || f.tab=='list' || f.tab=='audit'">
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
        <div ng-show="f.tab=='audit'">
            <div class="row">
                <div class="col-sm-3">
                    <label class="text-capitalize">User ID</label>
                    <div class="input-group">
                        <input type="text" ng-model="r.userid" id="r_userid" class="form-control input-sm" readonly maxlength="">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('userid','r_userid')"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="text-capitalize">Name</label>
                    <input type="text" ng-model="r.name" id="r_name" class="form-control input-sm" readonly maxlength="">
                </div>
                <div class="col-sm-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-sm btn-block btn-success" ng-click="oLoadAudit(r.userid);">Load</button>
                </div>
                <div class="col-sm-3">
                    <label>Cari : </label>
                    <input type="text" ng-model="r.qdash" class="form-control input-sm" maxlength="" placeholder="Search">
                </div>
            </div>
            <hr>
            <div>
                <div class="text-bold">User-Plant</div>
                <ul>
                    <li class="pointer" ng-click="oLoadMember(v.key2,'user_plant')" ng-repeat="v in audit.user_plant | filter:r.qdash">{{v.key2}} - <span class="text-success">{{v.rel_key2_plant.plantname}}</span> <span class="text-danger">{{v.key3}}</span></li>
                </ul>
                <div class="text-bold">User-Group</div>
                <ul>
                    <li class="pointer" ng-click="oLoadMember(v.key2,'user_group')" ng-repeat="v in audit.user_group | filter:r.qdash">{{v.key2}} - <span class="text-success">{{v.rel_key2_group.group_name}}</span> <span class="text-danger">{{v.key3}}</span></li>
                </ul>
                <div class="text-bold">User-Access</div>
                <ul>
                    <li class="pointer" ng-click="oLoadMember(v.key2,'user_access')" ng-repeat="v in audit.user_access | filter:r.qdash">{{v.key2}} - <span class="text-success">{{v.rel_key2_access.accessname}}</span> <span class="text-danger">{{v.key3}}</span></li>
                </ul>
                <div class="text-bold">Group-Menu</div>
                <ul>
                    <li class="pointer" ng-click="oLoadMember(v.key2,'group_menu')" ng-repeat="v in audit.group_menu | filter:r.qdash">{{v.key2}} - <span class="text-success">{{v.rel_key2_menu.label}}</span> <span class="text-danger">{{v.key3}}</span></li>
                </ul>
                <div class="text-bold">Group-Access</div>
                <ul>
                    <li class="pointer" ng-click="oLoadMember(v.key2,'group_access')" ng-repeat="v in audit.group_access | filter:r.qdash">{{v.key2}} - <span class="text-success">{{v.rel_key2_access.accessname}}</span> <span class="text-danger">{{v.key3}}</span></li>
                </ul>
            </div>
        </div>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item
                <br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                        <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                        <td title="'Relation'" filter="{rel: 'text'}" sortable="'rel'">{{v.rel}}</td>
                        <td title="'Key 1'" filter="{key1: 'text'}" sortable="'key1'">{{v.key1}}</td>
                        <td title="'Key 2'" filter="{key2: 'text'}" sortable="'key2'">{{v.key2}}</td>
                        <td title="'Key 3'" filter="{key3: 'text'}" sortable="'key3'">{{v.key3}}</td>
                        <td title="'Key 4'" filter="{key4: 'text'}" sortable="'key4'">{{v.key4}}</td>
                        <td title="'Key5'" filter="{key5: 'text'}" sortable="'key5'">{{v.key5}}</td>
                        <td title="'Table 1'" filter="{tbl1: 'text'}" sortable="'tbl1'">{{v.tbl1}}</td>
                        <td title="'Table 2'" filter="{tbl2: 'text'}" sortable="'tbl2'">{{v.tbl2}}</td>
                        <td title="'Table 3'" filter="{tbl3: 'text'}" sortable="'tbl3'">{{v.tbl3}}</td>
                        <td title="'Table 4'" filter="{tbl4: 'text'}" sortable="'tbl4'">{{v.tbl4}}</td>
                        <td title="'Table 5'" filter="{tbl5: 'text'}" sortable="'tbl5'">{{v.tbl5}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Id</label>
                        <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength="">
                        <label>Relation</label>
                        <input type="text" ng-model="h.rel" id="h_rel" class="form-control input-sm" readonly maxlength="30">
                        <label>Key 1</label>
                        <input type="text" ng-model="h.key1" id="h_key1" class="form-control input-sm" readonly maxlength="30">
                        <label>Key 2</label>
                        <input type="text" ng-model="h.key2" id="h_key2" class="form-control input-sm" readonly maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Key 3</label>
                        <input type="text" ng-model="h.key3" id="h_key3" class="form-control input-sm" readonly maxlength="30">
                        <label>Key 4</label>
                        <input type="text" ng-model="h.key4" id="h_key4" class="form-control input-sm" readonly maxlength="30">
                        <label>Key5</label>
                        <input type="text" ng-model="h.key5" id="h_key5" class="form-control input-sm" readonly maxlength="30">
                        <label>Table 1</label>
                        <input type="text" ng-model="h.tbl1" id="h_tbl1" class="form-control input-sm" readonly maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label>Table 2</label>
                        <input type="text" ng-model="h.tbl2" id="h_tbl2" class="form-control input-sm" readonly maxlength="30">
                        <label>Table 3</label>
                        <input type="text" ng-model="h.tbl3" id="h_tbl3" class="form-control input-sm" readonly maxlength="30">
                        <label>Table 4</label>
                        <input type="text" ng-model="h.tbl4" id="h_tbl4" class="form-control input-sm" readonly maxlength="30">
                        <label>Table 5</label>
                        <input type="text" ng-model="h.tbl5" id="h_tbl5" class="form-control input-sm" readonly maxlength="30">
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
    SfService.setUrl("<?php echo e(url('sys_sylink')); ?>");
    $scope.f = { crud: 'c', tab: 'dash', trash: 0, menuSelected: {}, plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.audit = {};
    $scope.f.submenu = [
        ['syuser-syplant', 'User vs Plant', 0, 'user', 'syuser', 'syplant'],
        ['syuser-sygroup', 'User vs Group', 0, 'user', 'syuser', 'sygroup'],
        ['syuser-syaccess', 'User vs Access', 0, 'user', 'syuser', 'syaccess'],
        ['sygroup-symenu', 'Group vs Menu', 0, 'group', 'sygroup', 'symenu'],
        ['sygroup-syaccess', 'Group vs Access', 0, 'group', 'sygroup', 'syaccess'],
        ['sygroup-syguide', 'Group vs Guide', 0, 'group', 'sygroup', 'syguide']
    ];

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        $scope.r = {};
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

    $scope.oLoadDash = function(order_by) {
        $scope.tableDash = new NgTableParams({}, {
            getData: function($defer, params) {
                var $btn = $('button').button('loading');
                return $http.get(SfService.getUrl("_dash"), {
                    params: {
                        page: $scope.tableDash.page(),
                        limit: $scope.tableDash.count(),
                        order_by: $scope.tableDash.orderBy(),
                        q: $scope.f.qdash,
                        bydept: $scope.f.bydept,
                        d: $scope.d
                    }
                }).then(function(jdata) {
                    $btn.button('reset');
                    $scope.tableDash.total(jdata.data.data.total);
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
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), { restore: isRestore }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLookup = function(id, selector, obj) {
        switch (id) {
            case 'group':
                SfLookup("<?php echo e('sys_sygroup_lookup'); ?>", function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');
                    $scope.oLoadDash();
                    $("#d_name").val(name).trigger('input');
                });
                break;
            case 'dept':
                SfLookup("<?php echo e('sys_sydept_lookup'); ?>?plant=" + $scope.f.plant, function(id, name, jsondata) {
                    // $("#" + selector).val(id).trigger('input');
                    $scope.d.dept=id;
                    $scope.d.dept_name=name;
                    $scope.oLoadDash();
                    $scope.$apply();
                    // $("#d_dept_name").val(name).trigger('input');
                });
                break;
            case 'user':
                SfLookup("<?php echo e('sys_syuser_lookup'); ?>", function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');
                    $scope.oLoadDash();
                    $("#d_name").val(name).trigger('input');
                });
                break;
            case 'userid':
                SfLookup("<?php echo e('sys_syuser_lookup'); ?>", function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');
                    $("#r_name").val(name).trigger('input');
                    $scope.oLoadAudit($scope.r.userid);
                });
                break;
            default:
                // swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.oLog = function() {
        SfLog('sys_sylink', $scope.h.id);
    }

    $scope.oSubMenu = function(v, index) {
        if ($scope.f.menuSelected[4] != undefined) {
            if ($scope.f.menuSelected[4] != v[4]) {
                $("#d_key1").val('').trigger('input');
                $("#d_name").val('').trigger('input');
            }
        }
        $scope.f.menuSelected = v;
        angular.forEach($scope.f.submenu, function(item, i) {
            $scope.f.submenu[i][2] = 0;
        })
        $scope.f.submenu[index][2] = 1;
        $scope.d = {
            rel: v[0],
            key1: $("#d_key1").val(),
            name: $("#d_name").val(),
            tbl1: v[4],
            tbl2: v[5],
            tbl3: 'syplant'
        };
        $scope.f.qdash = '';
        $scope.oLoadDash();
    }

    $scope.oSet = function(id, flag, index, v) {
        if (flag == 1) {
            flag = 0;
        } else {
            flag = 1;
        }
        if ($scope.d.key1 == null || $scope.d.key1 == '') {
            swal('', 'Sorry, ' + $scope.f.menuSelected[3] + ' ID empty.', 'error');
            return false;
        }
        if ($scope.f.bydept == '1' && ($scope.d.dept == '' || $scope.d.dept == null || $scope.d.dept == undefined)) {
            swal('', 'Sorry, Department empty.', 'error');
            return false;
        }
        $scope.d.key2 = id;
        if ($scope.d.tbl2 == 'syaccess') {
            if (v.location == 1) {
                $scope.d.tbl3="syplant";
                $scope.d.key3 = "<?php echo e($plant); ?>";
            }else if (v.location == 2) {
                $scope.d.tbl3="sydept";
                $scope.d.key3 = $scope.d.dept;
            } else {
                $scope.d.key3 = '';
            }
        }
        $scope.d.flag = flag;
        SfService.save("#frm", SfService.getUrl(), {
            h: $scope.d,
            f: $scope.f
        }, function(jdata) {
            $scope.tableDash.data[index].flag = flag;
        });
    }

    $scope.oLoadAudit = function(userid) {
        if (userid == undefined || userid == '') {
            swal('', 'Select userid please!', 'error');
            return false;
        }
        SfService.httpPost(SfService.getUrl('_audit'), {
            r: $scope.r,
            f: $scope.f
        }, function(jdata) {
            $scope.audit.user_plant = jdata.data.user_plant;
            $scope.audit.user_group = jdata.data.user_group;
            $scope.audit.user_access = jdata.data.user_access;
            $scope.audit.group_menu = jdata.data.group_menu;
            $scope.audit.group_access = jdata.data.group_access;
        });

    }

    $scope.oLoadMember = function(key2, idrel) {
        var rel = '';
        switch (idrel) {
            case 'user_plant':
                rel = 'syuser-syplant';
                break;
            case 'user_group':
                rel = 'syuser-sygroup';
                break;
            case 'user_access':
                rel = 'syuser-syaccess';
                break;
            case 'group_menu':
                rel = 'sygroup-symenu';
                break;
            case 'group_access':
                rel = 'sygroup-syaccess';
                break;
        }

        SfDialog('div-member', key2 + ' Member', 'modal-md', function() {
            SfService.httpGet(SfService.getUrl('_member'), {
                key2: key2,
                rel: rel
            }, function(jdata) {
                var str = "<ol>";
                angular.forEach(jdata.data.data, function(item, i) {
                    if (item.rel_key1_user != null) {
                        str += "<li>" + item.key1 + " - " + item.rel_key1_user.username + "</li>";
                    } else if (item.rel_key1_group != null) {

                        str += "<li>" + item.key1 + " - " + item.rel_key1_group.group_name + "</li>";
                    }
                });
                str += "</ol>";
                $("#div-member div.modal-body").html(str);
            });
        });

    }

    $scope.cleanUp = function() {
        SfService.httpGet(SfService.getUrl('_cleanup'), {}, function(jdata) {
            swal('Clean Up', `Delete Unused User Key 1 : ` + jdata.data.syuser1 + ` rows <br>
                Delete Unused Group Key 1 : ` + jdata.data.sygroup1 + ` rows <br>
                Delete Unused Plant Key 2 : ` + jdata.data.syplant2 + ` rows <br>
                Delete Unused Group Key 2 : ` + jdata.data.sygroup2 + ` rows <br>
                Delete Unused Access Key 2 : ` + jdata.data.syaccess2 + ` rows <br>
                Delete Unused Menu Key 2 : ` + jdata.data.symenu2 + ` rows <br>
                `);
        });
    }
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/sys/sylink/sylink_frm.blade.php ENDPATH**/ ?>