<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Database Monitoring <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='dash'">Dashboard</span>
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
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_nitdb']); ?> <?php echo $__env->renderComponent(); ?>
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
                <div ng-show="f.tab=='dash'">
                    <button type="button" class="btn btn-sm btn-success" ng-click="oRpt1()"><i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-sm btn-default" ng-click="f.tab='list'"><i class="fa fa-cog"></i></button>
                </div>
                <div ng-show="f.tab=='frm'">
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i class="fa fa-copy"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()" ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i class="fa fa-clock-o"></i> Log</button>
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_nitdb','id'=>'h.id']); ?> <?php echo $__env->renderComponent(); ?> </span>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="oGenerate()" ng-attr-title="Generator" ng-show="f.tab=='list'"><i class="fa fa-download"></i> Generator</button>
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='dash'" ng-attr-title="Report" ng-show="f.tab=='list'"><i class="fa fa-line-chart"></i> Report</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab!='list'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='dash'">
        <h3 class="text-success">Data on {{rpt1.maxdate}}</h3>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Database</td>
                            <td>Table Count</td>
                            <td>Sum Row </td>
                            <td>Data Size </td>
                            <td>Index Size </td>
                            <td># </td>
                        </tr>
                    </thead>

                    <tbody ng-repeat="va in rpt1.db">
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{va.h.table_schema}}</td>
                            <td class="text-right">{{va.h.tbl_count|number:0}}</td>
                            <td class="text-right">{{va.h.row_sum|number:0}}</td>
                            <td class="text-right">{{va.h.size_sum|number:0}}</td>
                            <td class="text-right">{{va.h.index_sum|number:0}}</td>
                            <td class="pointer text-info" ng-click="va.more1=!va.more1"><i>detail</i></td>
                        </tr>
                        <tr ng-repeat="v in va.d" class="text-success" ng-if="va.more1==true">
                            <td>{{$index+1}}</td>
                            <td>{{va.h.table_schema}}</td>
                            <td class="text-italic"><i>{{v.table_name}}</i></td>
                            <td class="text-right">{{v.table_rows|number:0}}</td>
                            <td class="text-right">{{v.data_length|number:0}}</td>
                            <td class="text-right">{{v.index_length|number:0}}</td>
                            <td>{{v.table_collation}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                        <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                        <td title="'Sync Date'" filter="{sync_date: 'text'}" sortable="'sync_date'">{{v.sync_date}}</td>
                        <td title="'Server Addr'" filter="{server_addr: 'text'}" sortable="'server_addr'">{{v.server_addr}}</td>
                        <td title="'Table Catalog'" filter="{table_catalog: 'text'}" sortable="'table_catalog'">{{v.table_catalog}}</td>
                        <td title="'Table Schema'" filter="{table_schema: 'text'}" sortable="'table_schema'">{{v.table_schema}}</td>
                        <td title="'Table Name'" filter="{table_name: 'text'}" sortable="'table_name'">{{v.table_name}}</td>
                        <td title="'Table Type'" filter="{table_type: 'text'}" sortable="'table_type'">{{v.table_type}}</td>
                        <td title="'Engine'" filter="{engine: 'text'}" sortable="'engine'">{{v.engine}}</td>
                        <td title="'Version'" filter="{version: 'text'}" sortable="'version'">{{v.version}}</td>
                        <td title="'Row Format'" filter="{row_format: 'text'}" sortable="'row_format'">{{v.row_format}}</td>
                        <td title="'Table Rows'" filter="{table_rows: 'text'}" sortable="'table_rows'">{{v.table_rows}}</td>
                        <td title="'Avg Row Length'" filter="{avg_row_length: 'text'}" sortable="'avg_row_length'">{{v.avg_row_length}}</td>
                        <td title="'Data Length'" filter="{data_length: 'text'}" sortable="'data_length'">{{v.data_length}}</td>
                        <td title="'Max Data Length'" filter="{max_data_length: 'text'}" sortable="'max_data_length'">{{v.max_data_length}}</td>
                        <td title="'Index Length'" filter="{index_length: 'text'}" sortable="'index_length'">{{v.index_length}}</td>
                        <td title="'Data Free'" filter="{data_free: 'text'}" sortable="'data_free'">{{v.data_free}}</td>
                        <td title="'Auto Increment'" filter="{auto_increment: 'text'}" sortable="'auto_increment'">{{v.auto_increment}}</td>
                        <td title="'Create Time'" filter="{create_time: 'text'}" sortable="'create_time'">{{v.create_time}}</td>
                        <td title="'Update Time'" filter="{update_time: 'text'}" sortable="'update_time'">{{v.update_time}}</td>
                        <td title="'Check Time'" filter="{check_time: 'text'}" sortable="'check_time'">{{v.check_time}}</td>
                        <td title="'Table Collation'" filter="{table_collation: 'text'}" sortable="'table_collation'">{{v.table_collation}}</td>
                        <td title="'Checksum'" filter="{checksum: 'text'}" sortable="'checksum'">{{v.checksum}}</td>
                        <td title="'Create Options'" filter="{create_options: 'text'}" sortable="'create_options'">{{v.create_options}}</td>
                        <td title="'Table Comment'" filter="{table_comment: 'text'}" sortable="'table_comment'">{{v.table_comment}}</td>
                        <td title="'Max Index Length'" filter="{max_index_length: 'text'}" sortable="'max_index_length'">{{v.max_index_length}}</td>
                        <td title="'Temporary'" filter="{temporary: 'text'}" sortable="'temporary'">{{v.temporary}}</td>
                        <td title="'Note'" filter="{note: 'text'}" sortable="'note'">{{v.note}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='id'>Id</label>
                        <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength="" ng-readonly="f.crud!='c' || true " placeholder="auto">
                        <label title='sync_date'>Sync Date</label>
                        <input type="text" ng-model="h.sync_date" id="h_sync_date" class="form-control input-sm" required maxlength="">
                        <label title='server_addr'>Server Addr</label>
                        <input type="text" ng-model="h.server_addr" id="h_server_addr" class="form-control input-sm" required maxlength="30">
                        <label title='table_catalog'>Table Catalog</label>
                        <input type="text" ng-model="h.table_catalog" id="h_table_catalog" class="form-control input-sm" required maxlength="512">
                        <label title='table_schema'>Table Schema</label>
                        <input type="text" ng-model="h.table_schema" id="h_table_schema" class="form-control input-sm" required maxlength="64">
                        <label title='table_name'>Table Name</label>
                        <input type="text" ng-model="h.table_name" id="h_table_name" class="form-control input-sm" required maxlength="64">
                        <label title='table_type'>Table Type</label>
                        <input type="text" ng-model="h.table_type" id="h_table_type" class="form-control input-sm" maxlength="64">
                        <label title='engine'>Engine</label>
                        <input type="text" ng-model="h.engine" id="h_engine" class="form-control input-sm" maxlength="64">
                        <label title='version'>Version</label>
                        <input type="text" ng-model="h.version" id="h_version" class="form-control input-sm" maxlength="">
                    </div>
                    <div class="col-sm-4">
                        <label title='row_format'>Row Format</label>
                        <input type="text" ng-model="h.row_format" id="h_row_format" class="form-control input-sm" maxlength="10">
                        <label title='table_rows'>Table Rows</label>
                        <input type="text" ng-model="h.table_rows" id="h_table_rows" class="form-control input-sm" maxlength="">
                        <label title='avg_row_length'>Avg Row Length</label>
                        <input type="text" ng-model="h.avg_row_length" id="h_avg_row_length" class="form-control input-sm" maxlength="">
                        <label title='data_length'>Data Length</label>
                        <input type="text" ng-model="h.data_length" id="h_data_length" class="form-control input-sm" maxlength="">
                        <label title='max_data_length'>Max Data Length</label>
                        <input type="text" ng-model="h.max_data_length" id="h_max_data_length" class="form-control input-sm" maxlength="">
                        <label title='index_length'>Index Length</label>
                        <input type="text" ng-model="h.index_length" id="h_index_length" class="form-control input-sm" maxlength="">
                        <label title='data_free'>Data Free</label>
                        <input type="text" ng-model="h.data_free" id="h_data_free" class="form-control input-sm" maxlength="">
                        <label title='auto_increment'>Auto Increment</label>
                        <input type="text" ng-model="h.auto_increment" id="h_auto_increment" class="form-control input-sm" maxlength="">
                        <label title='create_time'>Create Time</label>
                        <input type="text" ng-model="h.create_time" id="h_create_time" class="form-control input-sm" maxlength="">
                    </div>
                    <div class="col-sm-4">
                        <label title='update_time'>Update Time</label>
                        <input type="text" ng-model="h.update_time" id="h_update_time" class="form-control input-sm" maxlength="">
                        <label title='check_time'>Check Time</label>
                        <input type="text" ng-model="h.check_time" id="h_check_time" class="form-control input-sm" maxlength="">
                        <label title='table_collation'>Table Collation</label>
                        <input type="text" ng-model="h.table_collation" id="h_table_collation" class="form-control input-sm" maxlength="32">
                        <label title='checksum'>Checksum</label>
                        <input type="text" ng-model="h.checksum" id="h_checksum" class="form-control input-sm" maxlength="">
                        <label title='create_options'>Create Options</label>
                        <input type="text" ng-model="h.create_options" id="h_create_options" class="form-control input-sm" maxlength="2048">
                        <label title='table_comment'>Table Comment</label>
                        <input type="text" ng-model="h.table_comment" id="h_table_comment" class="form-control input-sm" maxlength="2048">
                        <label title='max_index_length'>Max Index Length</label>
                        <input type="text" ng-model="h.max_index_length" id="h_max_index_length" class="form-control input-sm" maxlength="">
                        <label title='temporary'>Temporary</label>
                        <input type="text" ng-model="h.temporary" id="h_temporary" class="form-control input-sm" maxlength="1">
                        <label title='note'>Note</label>
                        <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm" maxlength="15">
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
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?php echo e(url('trs_local_nitdb')); ?>");
        $scope.f = {
            crud: 'c',
            tab: 'dash',
            trash: 0,
            userid: "<?php echo e(Auth::user()->userid); ?>",
            plant: "<?php echo e(Session::get('plant')); ?>"
        };
        $scope.h = {};
        $scope.rpt1 = {};
        $scope.m = [];

        var uploader = $scope.uploader = new FileUploader({
            url: "<?php echo e(url('upload_file')); ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            onBeforeUploadItem: function(item) {
                //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                item.formData = [{
                    id: $scope.h.id,
                    path: 'trs_local_nitdb',
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
            SfGetMediaList('trs_local_nitdb/' + $scope.h.id, function(jdata) {
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
                        $("#" + selector).val(id).trigger('input');;
                    });
                    break;*/
                default:
                    swal('Sorry', 'Under construction', 'error');
                    break;
            }
        }

        $scope.oLog = function() {
            SfLog('trs_local_nitdb', $scope.h.id);
        }

        $scope.oGenerate = function() {

            SfService.post(SfService.getUrl('_generate'), {}, function(jdata) {
                swal(jdata.data);
                $scope.oSearch();
                return false;
            });
        }
        $scope.oRpt1 = function() {

            SfService.post(SfService.getUrl('_rpt1'), {}, function(jdata) {
                $scope.rpt1 = jdata.data;
            });
        }

        // $scope.oSearch();
        $scope.oRpt1();
    }]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/trs/local/nitdb/nitdb_frm.blade.php ENDPATH**/ ?>