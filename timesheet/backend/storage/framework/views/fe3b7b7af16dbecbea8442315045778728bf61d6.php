<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data API <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <style type="text/css">
        #remov {
            text-decoration: none;
        }

    </style>
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
                                <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
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
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td style="padding:6px;" title="'Fullname'" filter="{fullname: 'text'}" sortable="">
                                {{ v . fullname }}
                            </td>
                            <td style="padding:6px;" title="'Username'" filter="{username: 'text'}" sortable="">
                                {{ v . username }}</td>
                            <td style="padding:6px;" title="'User Code'" filter="{user_code: 'text'}" sortable="">
                                {{ v . user_code }}</td>
                            <td style="padding:6px;" title="'Filter IP'" filter="{filter_ip: 'text'}" sortable="">
                                <center><label
                                        ng-class="{'label label-sm label-danger':v.filter_ip=='no','label label-sm label-success':v.filter_ip=='yes'}">{{ v . filter_ip == 'yes' ? 'Filter ON' : 'Filter OFF' }}</label>
                                </center>
                            </td>
                            <td style="padding:6px;" title="'Filter Project'" filter="{filter_plant: 'text'}" sortable="">
                                <center><label
                                        ng-class="{'label label-sm label-danger':v.filter_plant=='no','label label-sm label-success':v.filter_plant=='yes'}">{{ v . filter_plant == 'yes' ? 'Filter ON' : 'Filter OFF' }}</label>
                                </center>
                            </td>
                            <td style="padding:6px;" title="'Filter Hardware'" filter="{filter_hardware: 'text'}"
                                sortable="">
                                <center><label
                                        ng-class="{'label label-sm label-danger':v.filter_hardware=='no','label label-sm label-success':v.filter_hardware=='yes'}">{{ v . filter_hardware == 'yes' ? 'Filter ON' : 'Filter OFF' }}</label>
                                </center>
                            </td>
                            <td style="padding:6px;" title="'Status'" filter="{status: 'text'}" sortable="">
                                <center><label
                                        ng-class="{'label label-sm label-danger':v.status=='nonaktif','label label-sm label-success':v.status=='aktif'}">{{ v . status == 'aktif' ? 'User Aktif' : 'User Tidak Aktif' }}</label>
                                </center>
                            </td>
                            <td style="padding:6px;" title="'Expired Date'" filter="{expired_date: 'text'}" sortable="">
                                {{ v . expired_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-2">
                            <label title='username'>Username</label>
                            <input type="text" ng-model="h.username" id="h_username" class="form-control input-sm" readonly
                                placeholder="Auto">
                        </div>
                        <div class="col-sm-3">
                            <label title='fullname'>Fullname</label>
                            <input type="text" ng-model="h.fullname" id="h_fullname" class="form-control input-sm"
                                maxlength="50" ng-readonly="f.crud!='c'" required>
                        </div>
                        
                        <div class="col-sm-3">
                            <label title='user_code'>User Code</label>
                            <input type="text" ng-model="h.user_code" id="h_user_code" class="form-control input-sm"
                                readonly placeholder="Auto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label title='filter_ip'>Filter IP</label>
                            <select class="form-control input-sm" id="h_filter_ip" ng-model="h.filter_ip">
                                <option ng-repeat="v in filter_ip" value="{{ v }}">{{ v }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label title='filter_plant'>Filter Project</label>
                            <select class="form-control input-sm" id="h_filter_plant" ng-model="h.filter_plant">
                                <option ng-repeat="v in filter_plant" value="{{ v }}">{{ v }}
                                </option>
                            </select>
                        </div>
                        <div ng-if="h.filter_plant=='yes'" class="col-sm-2">
                            <label title='filter_hardware'>Filter Hardware</label>
                            <select class="form-control input-sm" id="h_filter_hardware" ng-model="h.filter_hardware">
                                <option ng-repeat="v in filter_hardware" value="{{ v }}">{{ v }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label title='status'>Status</label>
                            <select class="form-control input-sm" id="h_status" ng-model="h.status">
                                <option ng-repeat="v in status" value="{{ v }}">{{ v }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label title='status'>Expired</label>
                            <input type="date" class="form-control input-sm" ng-model="h.expired_date">
                        </div>
                    </div>
                    <hr />
                    <div ng-show="h.filter_ip=='yes'" class="col-sm-4 p-10 m-r-10"
                        style="border-radius:5px;border:1px solid #0099cc">
                        <div class="col-sm-12 m-0 p-0">
                            <h5 class="text-primary">Daftar IP Address</h5>
                            <div class="row m-b-5" ng-repeat="v1 in d1">
                                <div class="col-sm-12">
                                    <div class="col-sm-8 m-0 p-0">
                                        <table width="100%" class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td width="15%">{{ $index + 1 }}.</td>
                                                <td width="85%" class="text-primary p-0">
                                                    <input type="text" ng-model="v1.ip_address"
                                                        placeholder="Masukkan IP Address"
                                                        class="form-control input-sm no-border-text text-primary">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-2 m-0 p-0">
                                        <table class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td class="text-danger pointer" ng-click="oDelrowIp($index)" align="center">
                                                    <span class="label label-danger">Hapus</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 m-0 p-0">
                            <button type="button" class="btn btn-sm btn-primary" ng-click="addRowIp();">Tambah IP
                                Address</button>
                        </div>
                    </div>

                    <div ng-show="h.filter_plant=='yes'" class="col-sm-7 p-10"
                        style="border-radius:5px;border:1px solid #0099cc">
                        <h5 class="text-primary">Daftar Project</h5>
                        <div class="col-sm-12 m-0 p-0">
                            <div ng-repeat="v2 in d2 track by $index" class="col-sm-12 m-0 p-0 m-0 p-0">
                                <div class="col-sm-12 m-0 p-0">
                                    <div class="col-sm-8 m-0 p-0">
                                        <table class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td width="20%">{{ $index + 1 }}.</td>
                                                <td width="80%" class="pointer text-primary p-0">
                                                    <input type="text" placeholder="..."
                                                        class="form-control input-sm no-border-text text-primary"
                                                        ng-click="oLookup('d2_plant',$index)"
                                                        ng-value="v2.plant+' | '+v2.plantname">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-1 m-0 p-0">
                                        <table class="table table-condensed table-bordered m-0"
                                            style="white-space: nowrap;">
                                            <tr>
                                                <td align="center" class="pointer" ng-click="oDelrowPlant($index)">
                                                    <span class="label label-danger">Hapus</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-sm-12 m-b-10 m-t-0" ng-show="h.filter_hardware=='yes'">
                                    <div ng-repeat="va in v2.sub track by $index" class="col-sm-12 m-0 p-0">
                                        <div class="col-sm-1 m-0 p-0">&nbsp;</div>
                                        <div class="col-sm-6 m-0 p-0">
                                            <table class="table table-condensed table-bordered m-0"
                                                style="white-space: nowrap;">
                                                <tr>
                                                    <td width="20%">{{ $parent . $index + 1 }}.{{ $index + 1 }}
                                                    </td>
                                                    
                                                    <td width="80%" class="pointer text-success p-0">
                                                        <input type="text" placeholder="..."
                                                            class="form-control input-sm no-border-text text-success"
                                                            ng-click="oLookup('d3_kd_hardware',$parent.$index,$index,v2.plant)"
                                                            ng-value="va.kd_hardware">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-1 m-0 p-0">
                                            <table class="table table-condensed table-bordered m-0"
                                                style="white-space: nowrap;">
                                                <tr>
                                                    <td width="" class="pointer" align="center"
                                                        ng-click="oDelrowHw($parent.$index,$index)"><span
                                                            class="label label-xs label-warning">Delete</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 m-t-5">
                                        <div class="col-sm-1 m-0 p-0">&nbsp;</div>
                                        <div class="col-sm-5 m-0 p-0">
                                            <button type="button" class="btn btn-xs btn-success"
                                                ng-click="addRowHw($index)">Tambah
                                                Hardware</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 m-0 p-0">
                            <button type="button" class="btn btn-sm btn-primary" ng-click="addRowPlant()">Tambah
                                Project</button>
                        </div>
                    </div>
                </form>
                <div class="col-sm-12 p-10">
                    <hr />
                    <h5 class="text-primary">Daftar Link API</h5>
                    <hr />
                    <div ng-if="d3!=''" class="text-primary text-bold" ng-repeat="vx in api_url">
                        <div class="text-primary text-bold" ng-repeat="vx2 in vx">
                            <i class="fa fa-arrow-right"></i> {{ vx2 }}
                        </div>
                    </div>
                    <div ng-if="d2!='' && d2[0].sub==''" class="text-primary text-bold" ng-repeat="vx in api_url">
                        <i class="fa fa-arrow-right"></i> {{ vx }}
                    </div>
                    <div ng-if="d2=='' && d3==''" class="text-primary text-bold">
                        <i class="fa fa-arrow-right"></i> {{ api_url }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_api')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.d1 = [];
            $scope.d2 = [];
            $scope.d3 = [];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            $scope.oCekActive = function() {
                SfService.httpGet("trs_local_trs_api_active");
            }
            $scope.oCekActive();

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.m = [];
                $scope.d1 = [];
                $scope.d2 = [];
                $scope.d3 = [];
                SfFormNew("#frm");
            }
            $scope.filter_ip = ['yes', 'no'];
            $scope.filter_plant = ['yes', 'no'];
            $scope.filter_hardware = ['yes', 'no'];
            $scope.status = ['aktif', 'nonaktif'];

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.kd_hardware = null;
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                $scope.tableList = new NgTableParams({
                    count: 25
                }, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.tableList.orderBy(),
                                q: $scope.f.q,
                                trash: $scope.f.trash,
                                plant: $scope.f.plant
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
                    f: $scope.f,
                    h: $scope.h,
                    d1: $scope.d1,
                    d2: $scope.d2,
                    d3: $scope.d3
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.f.crud = 'u';
                    $scope.h = jdata.data.h;
                    $scope.h.expired_date = jsDate($scope.h.expired_date);
                    $scope.d1 = jdata.data.d1;
                    $scope.d2 = jdata.data.d2;
                    $scope.d3 = jdata.data.d3;
                    $scope.api_url = jdata.data.api_url;
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj, etc) {
                switch (id) {
                    case 'd2_plant':
                        SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>",
                            function(id, name, jsondata) {
                                $scope.d2[selector].plant = id;
                                $scope.d2[selector].plantname = name;
                                $scope.$apply();
                            });
                        break;
                    case 'd3_kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup4')); ?>?plant=" + etc,
                            function(id, name, jsondata) {
                                $scope.d2[selector].sub[obj].kd_hardware = id;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_api', $scope.h.id);
            }

            $scope.addRowIp = function() {
                $scope.d1.push({});
            }

            $scope.oDelrowIp = function(idx) {
                $scope.d1.splice(idx, 1);
            }

            $scope.addRowPlant = function() {
                $scope.d2.push({
                    sort_no: $scope.d2.length + 1,
                    sub: []
                });
            }

            $scope.oDelrowPlant = function(idx) {
                $scope.d2.splice(idx, 1);
            }

            $scope.addRowHw = function(index) {
                $scope.d2[index].sub.push({
                    sort_no: $scope.d2[index].sub.length + 1
                });
            }

            $scope.oDelrowHw = function(idx1, idx2) {
                $scope.d2[idx1].sub.splice(idx2, 1);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/web_admin/backend/resources/views/trs/local/trs_api/trs_api_frm.blade.php ENDPATH**/ ?>