<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Form Generator <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<div class="panel panel-success">
    <div class="panel-heading">
        <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> Properties
    </div>
    <div class="panel-body">
        <div class="row" id="frm">
            <div class="col-sm-3">
                <label>Schema</label>
                <select class="form-control input-sm" ng-model="h.schema" ng-change="changeSchema()" required="">
                    <option ng-repeat="v in dataset.conns" ng-value="v">{{v}}</option>
                </select>
                <label>Database Name</label>
                <select class="form-control input-sm" ng-model="h.db" ng-change="changeDb()" required="">
                    <option ng-repeat="v in dataset.dbs" ng-value="v">{{v}}</option>
                </select>
                <label>Table Name</label>
                <select class="form-control input-sm" ng-model="h.table" ng-change="changeTable()" required="">
                    <option ng-repeat="v in dataset.tables" ng-value="v">{{v}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Primary Key</label>
                <select class="form-control input-sm" ng-model="h.pk" required="">
                    <option ng-repeat="v in dataset.fields" ng-value="v.COLUMN_NAME">{{v.COLUMN_NAME}} {{v.COLUMN_KEY}}</option>
                </select>
                <label>Auto Increment</label>
                <select class="form-control input-sm" ng-model="h.ai" required="">
                    <option ng-repeat="v in [{key:1,label:'Yes'},{key:0,label:'No'}]" ng-value="v.key">{{v.label}}</option>
                </select>
                <label>Time Stamps</label>
                <select class="form-control input-sm" ng-model="h.timestamps" required="">
                    <option ng-repeat="v in [{key:1,label:'Yes'},{key:0,label:'No'}]" ng-value="v.key">{{v.label}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Path Group</label>
                <div class="input-group">
                    <select class="form-control input-sm" ng-model="h.path" ng-change="changePath()" required="">
                        <option ng-repeat="v in dataset.paths" ng-value="v">{{v}}</option>
                    </select>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-default" ng-click="addCombo('path')"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <label>Access Key</label>
                <input type="text" class="form-control input-sm" ng-model="h.accesskey" required="">
                <label>Form Title</label>
                <input type="text" class="form-control input-sm" ng-model="h.title" required="">
            </div>
            <div class="col-sm-3">
                <label>Connection Name</label>
                <div class="input-group">
                    <select class="form-control input-sm" ng-model="h.conn" required="">
                        <option ng-repeat="v in dataset.conns" ng-value="v">{{v}}</option>
                    </select>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-default" ng-click="addCombo('conns')"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <label>Use Upload File</label>
                <select class="form-control input-sm" ng-model="h.isfile">
                    <option ng-repeat="v in [{key:1,label:'Yes'},{key:0,label:'No'}]" ng-value="v.key">{{v.label}}</option>
                </select>
                <label ng-show="false">Fieldname of File</label>
                <select ng-show="false" class="form-control input-sm" ng-model="h.filefield">
                    <option ng-repeat="v in dataset.fields" ng-value="v.COLUMN_NAME">{{v.COLUMN_NAME}} {{v.COLUMN_KEY}}</option>
                </select>
                <label>&nbsp;</label>
                <button type="button" class="btn btn-sm btn-primary btn-block" ng-click="oGenStructure()">Generate Stucture</button>
            </div>
        </div>
    </div>
</div>
<div>
    <ul class="nav nav-pills">
        <li class="nav-items active"><a href="#tab-1" data-toggle="tab">Structure</a></li>
        <li class="nav-items"><a href="#tab-2" data-toggle="tab">Routes</a></li>
        <li class="nav-items"><a href="#tab-3" data-toggle="tab">Model</a></li>
        <li class="nav-items"><a href="#tab-4" data-toggle="tab">Controller</a></li>
        <li class="nav-items"><a href="#tab-5" data-toggle="tab">Form</a></li>
        <li class="nav-items"><a href="#tab-7" data-toggle="tab">Security</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tab-1">
            <button class="btn btn-success btn-sm pull-right" ng-click="oGenScript()" type="button">Generate Script</button>
            <h3 class="m-t-10">Source</h3>
            <p id="div-source">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Field Name</th>
                                <th>Type</th>
                                <th>Caption</th>
                                <th>Element</th>
                                <th>Required</th>
                                <th>Key</th>
                                <th>Extra</th>
                                <th>Default</th>
                                <th>Comment <span class="pointer link text-success" ng-click="setCommentToCaption()">[Set Caption]</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="v in dataset.structure">
                                <td class="text-right">{{$index+1}}</td>
                                <td>{{v.COLUMN_NAME}}</td>
                                <td>{{v.COLUMN_TYPE}}</td>
                                <td class="p-0">
                                    <input class="no-border-text form-control input-sm" type="text" ng-model="v.CAPTION">
                                </td>
                                <td class="p-0">
                                    <select class="no-border-text form-control input-sm" ng-model="v.ELEMENT">
                                        <option ng-repeat="vi in ['text','text readonly','text number','textarea','date','password','select','select-plus','checkbox','radio','button','lookup','hidden','none']" ng-value="vi">{{vi}}</option>
                                    </select>
                                </td>
                                <td class="p-0">
                                    <select class="no-border-text form-control input-sm" ng-model="v.REQUIRED">
                                        <option ng-repeat="vi in ['','required']" ng-value="vi">{{vi}}</option>
                                    </select>
                                </td>
                                <td>{{v.COLUMN_KEY}}</td>
                                <td>{{v.EXTRA}}</td>
                                <td>{{v.COLUMN_DEFAULT}}</td>
                                <td>{{v.COLUMN_COMMENT}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </p>
        </div>
        <div class="tab-pane fade" id="tab-2">
            <button class="btn btn-success btn-sm pull-right" ng-click="oWrite('routes')" type="button">Write Routes</button>
            <h3 class="m-t-10">Routes</h3>
            <div class="text-success">Path : <span class="scriptClear" id="div-routes-path"></span></div>
            <div class="text-info scriptClear" id="div-routes-result"></div>
            <hr>
            <textarea rows="20" class="form-control input-sm" id="div-routes"></textarea>
        </div>
        <div class="tab-pane fade" id="tab-3">
            <button class="btn btn-success btn-sm pull-right" ng-click="oWrite('model')" type="button">Write Model</button>
            <h3 class="m-t-10">Model</h3>
            <div class="text-success">Path : <span class="scriptClear" id="div-model-path"></span></div>
            <div class="text-info scriptClear" id="div-model-result"></div>
            <hr>
            <textarea rows="20" class="form-control input-sm" id="div-model"></textarea>
        </div>
        <div class="tab-pane fade" id="tab-4">
            <button class="btn btn-success btn-sm pull-right" ng-click="oWrite('controller')" type="button">Write Controller</button>
            <h3 class="m-t-10">Controller</h3>
            <div class="text-success">Path : <span class="scriptClear" id="div-controller-path"></span></div>
            <div class="text-info scriptClear" id="div-controller-result"></div>
            <hr>
            <textarea rows="20" class="form-control input-sm" id="div-controller"></textarea>
        </div>
        <div class="tab-pane fade" id="tab-5">
            <button class="btn btn-success btn-sm pull-right" ng-click="oWrite('form')" type="button">Write Form</button>
            <h3 class="m-t-10">Form</h3>
            <div class="text-success">Path : <span class="scriptClear" id="div-form-path"></span></div>
            <div class="text-info scriptClear" id="div-form-result"></div>
            <hr>
            <textarea rows="20" class="form-control input-sm" id="div-form"></textarea>
        </div>
        <div class="tab-pane fade" id="tab-7">
            <h3 class="m-t-10">Security</h3>
            <div class="text-info scriptClear" id="div-access-result"></div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="text-success">Menu</h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Menu Id</label>
                            <input type="text" ng-model="fmenu.menu_id" id="fmenu_menu_id" class="form-control input-sm" readonly maxlength="">
                            <label>Label</label>
                            <input type="text" ng-model="fmenu.label" id="fmenu_label" class="form-control input-sm" required maxlength="30">
                            <label>Url</label>
                            <input type="text" ng-model="fmenu.url" id="fmenu_url" class="form-control input-sm" maxlength="100">
                            <label>Redirect</label>
                            <input type="text" ng-model="fmenu.redirect" id="fmenu_redirect" class="form-control input-sm" maxlength="100">
                        </div>
                        <div class="col-sm-6">
                            <label>Parent</label>
                            <div class="input-group">
                                <input type="text" ng-model="fmenu.parent" id="fmenu_parent" class="form-control input-sm" readonly maxlength="">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('parent','fmenu_parent')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <label>Icon</label>
                            <input type="text" ng-model="fmenu.icon" id="fmenu_icon" class="form-control input-sm" maxlength="30">
                            <label>Note</label>
                            <input type="text" ng-model="fmenu.note" id="fmenu_note" class="form-control input-sm" maxlength="30">
                            <label>Order No</label>
                            <input type="text" ng-model="fmenu.order_no" id="fmenu_order_no" class="form-control input-sm" ng-pattern="/[0-9.,]+/" format="number" maxlength="">
                        </div>
                    </div>
                    <label>&nbsp;</label>
                    <button class="btn btn-success btn-block btn-sm" ng-click="oMakeMenu()">Create Menu</button>
                    <hr>
                    <a href="<?php echo e(url('sys_symenu')); ?>" target="_blank">Go to Menu Master</a>
                </div>
                <div class="col-sm-6">
                    <h4 class="text-success">Access Key</h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Accessid</label>
                            <input type="text" ng-model="faccess.accessid" id="faccess_accessid" class="form-control input-sm" required maxlength="30">
                            <label>Accessname</label>
                            <input type="text" ng-model="faccess.accessname" id="faccess_accessname" class="form-control input-sm" required maxlength="70">
                            <label>Accessgroup</label>
                            <select ng-model="faccess.accessgroup" id="faccess_accessgroup" class="form-control input-sm" required>
                                <option ng-repeat="v in [['user','User'],['group','Group']]" ng-value="v[0]">{{v[1]}}</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Location</label>
                            <select ng-model="faccess.location" id="faccess_location" class="form-control input-sm">
                                <option ng-repeat="v in [['1','Yes'],['0','No']]" ng-value="v[0]">{{v[1]}}</option>
                            </select>
                            <label>Note</label>
                            <input type="text" ng-model="faccess.note" id="faccess_note" class="form-control input-sm" maxlength="50">
                        </div>
                    </div>
                    <label>&nbsp;</label>
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-default" ng-repeat="v in [['C','Create'],['R','Read'],['U','Update'],['D','Delete'],['S','Restore']]" ng-click="oChangeAccess(v)">{{v[1]}}</a>
                    </div>
                    <div class="alert alert-info" ng-show="faccess.result!=''&& faccess.result!=null" style="margin-top:20px ">{{faccess.result}}</div>
                    <label>&nbsp;</label>
                    <button class="btn btn-success btn-block btn-sm" ng-click="oMakeAccess()">Create Access</button>
                    <hr>
                    <a href="<?php echo e(url('sys_syaccess')); ?>" target="_blank">Go to Accesskey Master</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams, SfService) {
    SfService.setUrl("<?php echo e(url('sys_sycrud')); ?>");
    $scope.f = {};
    $scope.h = {};
    $scope.fmenu = {};
    $scope.faccess = {};
    $scope.dataset = { conns: ['mysql', 'schema1'], dbs: [], tables: [], fields: [], paths: ['sys', 'trs\\local'], structure: [] };

    $scope.oInit = function() {
        $scope.h = { schema: 'schema1', isfile: 1, conn: 'mysql' };
        $scope.changeSchema();
    }

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        SfFormNew("#frm");
    }

    $scope.changeSchema = function() {
        SfService.httpGet(SfService.getUrl('/fn/getDbs'), { h: $scope.h }, function(jdata) {
            $scope.dataset.dbs = jdata.data.dbs;
        });
    }

    $scope.changeDb = function() {
        SfService.httpGet(SfService.getUrl('/fn/getTables'), { h: $scope.h }, function(jdata) {
            $scope.dataset.tables = jdata.data.tables;
        });
    }
    $scope.changeTable = function() {
        SfService.httpGet(SfService.getUrl('/fn/getFields'), { h: $scope.h }, function(jdata) {
            $scope.dataset.fields = jdata.data.fields;
            $scope.h.pk = null;
            $scope.h.ai = 0;
            $scope.h.timestamps = 0;
            angular.forEach($scope.dataset.fields, function(item, i) {
                if (item.COLUMN_KEY == 'PRI') {
                    $scope.h.pk = item.COLUMN_NAME;
                }
                if (item.EXTRA == 'auto_increment') {
                    $scope.h.ai = 1;
                }
                if (item.COLUMN_NAME == 'created_at') {
                    $scope.h.timestamps = 1;
                }
            });
            $scope.makeAccessKey();
        });
    }

    $scope.changePath = function() {
        $scope.makeAccessKey();
    }

    $scope.makeAccessKey = function() {
        var path = $scope.h.path;
        if (path == null) {
            var clean_path = "";
        } else {
            var clean_path = path.replace(/[\\]/g, '_');
        }
        $scope.h.accesskey = clean_path + '_' + $scope.h.table;
    }

    $scope.oGenStructure = function() {
        if (SfFormValidate("#frm") == false) {
            swal('', 'Data not Valid');
            return false;
        }
        SfService.httpGet(SfService.getUrl('/fn/getFields'), { h: $scope.h }, function(jdata) {
            $scope.dataset.structure = jdata.data.fields;
        });
    }

    $scope.oGenScript = function() {
        SfService.httpPost(SfService.getUrl('/fn/getScript'), { h: $scope.h, structure: $scope.dataset.structure }, function(jdata) {
            $(".scriptClear").html('');
            $("#div-routes").html(jdata.data.routes.str);
            $("#div-routes-path").html(jdata.data.routes.path);
            $("#div-model").html(jdata.data.model.str);
            $("#div-model-path").html(jdata.data.model.path);
            $("#div-controller").html(jdata.data.controller.str);
            $("#div-controller-path").html(jdata.data.controller.path);
            $("#div-form").html(jdata.data.form.str);
            $("#div-form-path").html(jdata.data.form.path);
            $("#div-access").html(jdata.data.access.str);
            $scope.fmenu = {
                label: $scope.h.title,
                url: jdata.data.conf.route
            };
            $scope.faccess = {
                accessid: jdata.data.conf.route.toUpperCase() + '_C',
                access_: jdata.data.conf.route.toUpperCase(),
                accessname: 'Create ' + $scope.h.title + " (" + jdata.data.conf.route + ")",
                accessname_: $scope.h.title + " (" + jdata.data.conf.route + ")",
                accessgroup: 'group',
                location: '1'
            };

        });
    }

    $scope.oWrite = function(id) {
        var path = $("#div-" + id + "-path").html();
        var script = $("#div-" + id).html();

        SfService.httpPost(SfService.getUrl('/fn/writeScript'), { id: id, path: path, script: script, route: $scope.h.accesskey }, function(jdata) {
            $("#div-" + id + "-result").html(jdata.data);
        });
    }

    $scope.oLookup = function(id, selector, obj) {
        switch (id) {
            case 'parent':
                SfLookup("<?php echo e(url('sys_symenu_lookup')); ?>", function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');;
                });
                break;
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.addCombo = function(id) {
        switch (id) {
            case 'path':
                swal({
                        title: 'Add new path',
                        input: 'text',
                        showCancelButton: true,
                    })
                    .then((value) => {
                        $scope.dataset.paths.push(value.value);
                        $scope.$apply();
                    });
                break;
            case 'conns':
                swal({
                        title: 'Add new connection name',
                        input: 'text',
                        showCancelButton: true,
                    })
                    .then((value) => {
                        $scope.dataset.conns.push(value.value);
                        $scope.$apply();
                    });
                break;
        }
    }

    $scope.oMakeMenu = function() {
        SfService.save("#frm", "<?php echo e(url('sys_symenu')); ?>", {
            h: $scope.fmenu,
            f: { crud: 'c', tab: 'list', trash: 0 }
        }, function(jdata) {
            swal('Create Menu', jdata.data, 'success');
        });
    }

    $scope.oChangeAccess = function(v) {
        $scope.faccess.accessid = $scope.faccess.access_ + "_" + v[0];
        $scope.faccess.accessname = v[1] + " " + $scope.faccess.accessname_;
        $scope.faccess.result = "";
    }

    $scope.oMakeAccess = function() {
        SfService.save("#frm", "<?php echo e(url('sys_syaccess')); ?>", {
            h: $scope.faccess,
            f: { crud: 'c', tab: 'list', trash: 0 }
        }, function(jdata) {
            $scope.faccess.result = jdata.data;
        });
    }

    $scope.setCommentToCaption = function() {
        angular.forEach($scope.dataset.fields, function(item, i) {
            if (item.COLUMN_COMMENT != '' && item.COLUMN_COMMENT != null) {
                $scope.dataset.structure[i].CAPTION = item.COLUMN_COMMENT;
            }
        });
    }

    $scope.oInit();

}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/sycrud/sycrud_frm.blade.php ENDPATH**/ ?>