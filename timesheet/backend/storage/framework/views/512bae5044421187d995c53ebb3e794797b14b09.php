<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Hardware <?php $__env->stopSection(); ?>
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
            <div class="row">
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button ng-show="f.plant=='002'" type="button" class="btn btn-warning btn-sm" ng-click="oSearch(1)"><i class="fa fa fa-recycle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1 && f.plant=='002'"><i class="fa fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1 && f.plant=='002'"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDelForce()" ng-show="f.crud=='u' && f.trash==1 && f.plant=='002'"><i class="fa fa-trash"></i> Force Delete</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                Back</button>
        </div>
        <div class="row" ng-show="f.tab=='list'">
            <div ng-show="f.plant=='002' && f.tab=='list'" class="col-lg-3 col-md-3 col-sm-4 m-t-5">
                <div class="input-group">
                    <input type="text" ng-value="q.plantnamex"
                        class="form-control input-sm m-b-5" placeholder="Choose project ..." readonly>
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                            ng-click="oLookup('plant')"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-primary btn-block m-t-5" ng-click="oSearch()">Load Data</button>
            </div>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                    style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_hardware)">
                        <td style="padding:6px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="">{{ v . kd_hardware }}</td>
                        <td style="padding:6px;" title="'Project'" filter="{plant: 'text'}" sortable="">{{ v . rel_plant != null ? v.rel_plant.plantname : 'Unregistered'}}</td>
                        <td style="padding:6px;" title="'Location (Logger)'" filter="{location: 'text'}" sortable="">{{ v . location }}</td>
                        <td style="padding:6px;" title="'Location (Web)'" filter="{pos_name: 'text'}" sortable="">{{ v . pos_name }}</td>
                        <td style="padding:6px;" title="'Latitude'" filter="{latitude: 'text'}" sortable="">{{ v . latitude }}</td>
                        <td style="padding:6px;" title="'Longitude'" filter="{longitude: 'text'}" sortable="">{{ v . longitude }}</td>
                        <td style="padding:6px;" title="'GSM Number'" filter="{no_gsm: 'text'}" sortable="">{{ v . no_gsm }}</td>
                        <td style="padding:6px;" title="'Time Zone'" filter="{tzone: 'text'}" sortable="">{{ v . tzone }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-3">
                        <label title='plant'>Project</label>
                        <input type="text" ng-value="h.plant" id="h_plant" class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_logger'>Logger</label>
                        <input type="text" ng-value="h.kd_logger" id="h_kd_logger" class="form-control input-sm" readonly maxlength="15" ng-readonly="true" required>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_hardware'>Hardware</label>
                        <input type="text" ng-model="h.kd_hardware" id="h_kd_hardware" class="form-control input-sm"
                            maxlength="6" ng-readonly="f.crud!='c'" required>
                    </div>
                    <div class="col-sm-3">
                        <label title='uid'>UID</label>
                        <input type="text" ng-model="h.uid" id="h_uid" class="form-control input-sm" maxlength="12"
                            readonly placeholder="Auto create">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label title='location'>Location</label>
                        <input type="text" ng-model="h.location" id="h_location" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label title='pos_name'>Post Name</label>
                        <input type="text" ng-model="h.pos_name" id="h_pos_name" class="form-control input-sm">
                    </div>
                    <div class="col-sm-2">
                        <label title='latitude'>Latitude</label>
                        <input type="number" ng-model="h.latitude" id="h_latitude" class="form-control input-sm"
                            placeholder="" readonly>
                    </div>
                    <div class="col-sm-2">
                        <label title='longitude'>Longitude</label>
                        <input type="number" ng-model="h.longitude" id="h_longitude" class="form-control input-sm"
                            placeholder="" readonly>
                    </div>
                    <div class="col-sm-2">
                        <label title='tzone'>Time Zone</label>&nbsp;<code>(Minute)</code>
                        <input type="number" ng-model="h.tzone" id="h_tzone" class="form-control input-sm" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label title='no_gsm'>GSM Number</label>
                        <input type="text" ng-model="h.no_gsm" id="h_no_gsm" class="form-control input-sm">
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3">
                        <label title='kd_provinsi'>Provice</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_provinsi+' | '+h.nm_provinsi" id="h_kd_provinsi"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_provinsi','h_kd_provinsi')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_kabupaten'>City</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_kabupaten+' | '+h.nm_kabupaten" id="h_kd_kabupaten"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_kabupaten','h_kd_kabupaten')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_kecamatan'>District</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_kecamatan+' | '+h.nm_kecamatan" id="h_kd_kecamatan"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_kecamatan','h_kd_kecamatan')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_desa'>Sub District</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_desa+' | '+h.nm_desa" id="h_kd_desa"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_desa','h_kd_desa')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <h3 class="text-primary">EWS List</h3>
                <div class="list-group">
                    <div class="row m-b-5" ng-repeat="v3 in d3">
                        <div class="col-sm-8">
                            <div class="col-sm-10 m-0 p-0">
                                <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                    <tr>
                                        <td width="15%">{{ $index + 1 }}.</td>
                                        <td width="85%" class="text-primary p-0">
                                            
                                            <input type="text" ng-click="oLookup('d3_ews_id', $index)" ng-value="v3.ews_id+' | '+v3.ews_location" placeholder="..." class="form-control input-sm no-border-text text-primary">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-2 m-0 p-0">
                                <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                    <tr>
                                        <td class="text-danger pointer" ng-click="oDelrow3($index)" align="center">
                                            <span class="label label-danger">Delete ews</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" ng-click="addRow3();">Add ews</button>
                </div>
                <hr />
                <h3 class="text-primary">Sensor List</h3>
                <div>
                    <div class="list-group">
                        <div class="row m-b-5" ng-repeat="v1 in d1">
                            <div class="col-sm-8">
                                <div class="col-sm-10 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0"
                                        style="white-space: nowrap;">
                                        <tr>
                                            <td width="15%">{{ $index + 1 }}.</td>
                                            <td width="85%" class="text-primary p-0">
                                                <input type="text" ng-click="oLookup('d1_kd_sensor', $index)"
                                                    ng-value="v1.kd_sensor+' | '+v1.nm_sensor" placeholder="..."
                                                    class="form-control input-sm no-border-text text-primary">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-2 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0"
                                        style="white-space: nowrap;">
                                        <tr>
                                            <td class="text-danger pointer" ng-click="oDelrow($index)" align="center">
                                                <span class="label label-danger">Delete sensor</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="addRow();">Add sensor</button>
                    </div>
                </div>
                <hr>
                <h3 ng-show="f.crud=='u'" class="text-primary">Label Detail</h3>
                <div ng-show="f.crud=='u'">
                    <div class="list-group">
                        <label>Input with sparated by comma (,) <code>Value Example :
                                    0,10,20,30,40</code>&nbsp;|&nbsp;<code>Available color :
                                    merah,oranye,kuning,hijau_muda,hijau,biru_muda,biru</code></label>
                        <div class="row m-b-5" ng-repeat="v2 in d2">
                            <div class="col-sm-11">
                                <div class="col-sm-12 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0"
                                        style="white-space: nowrap;">
                                        <tr>
                                            <td width="20%" class="p-0">
                                                <input type="text" ng-value="v2.kd_sensor"
                                                    class="form-control input-sm no-border-text text-black" readonly>
                                            </td>
                                            <td width="30%" class="p-0">
                                                <input type="text" ng-model="v2.val_step"
                                                    class="form-control input-sm no-border-text text-black"
                                                    placeholder="Input value">
                                            </td>
                                            <td width="50%" class="p-0">
                                                <input type="text" ng-model="v2.color_step"
                                                    class="form-control input-sm no-border-text text-black"
                                                    placeholder="Input color">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_mst_hardware')); ?>");
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
    $scope.q = {};
    $scope.oCekPlant = function() {
        SfService.httpGet("sys_syplant_cek_data", {
            userid: $scope.f.userid,
            plant: $scope.f.plant
        }, function(jdata) {
            $scope.cek_plant = jdata.data.data_cek_plant;
        });
    }
    $scope.oCekPlant();

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

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.kd_hardware = null;
    }

    $scope.oSearch = function(trash, order_by) {
        $scope.f.tab = "list";
        $scope.f.trash = trash;
        $scope.tableList = new NgTableParams({
            count: 50
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
                        plant: $scope.f.plant,
                        userid: $scope.f.userid,
                        qplant: $scope.q.plantx,
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
            $scope.d1 = jdata.data.d1;
            $scope.d2 = jdata.data.d2;
            $scope.d3 = jdata.data.d3;
            // $scope.oGallery();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLookup = function(id, selector, obj) {
        switch (id) {
            case 'plant':
                SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>?plant=" + $scope.f.plant,
                    function(id, name, jsondata) {
                        $scope.q.plantx = jsondata.project;
                        $scope.q.plantnamex = jsondata.project_name;
                        $scope.$apply();
                    });
                break;
            case 'd1_kd_sensor':
                SfLookup("<?php echo e(url('trs_local_mst_sensor_lookup')); ?>",
                    function(id, name, jsondata) {
                        $scope.d1[selector].kd_sensor = jsondata.kd_sensor;
                        $scope.d1[selector].nm_sensor = jsondata.nm_sensor;;
                        $scope.$apply();
                    });
                break;
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
            case 'kd_desa':
                SfLookup("<?php echo e(url('trs_local_mst_desa_lookup')); ?>?kecamatan=" + $scope.h
                    .kd_kecamatan,
                    function(id, name, jsondata) {
                        $scope.h.kd_desa = jsondata.kd_desa;
                        $scope.h.nm_desa = jsondata.nm_desa;
                        $scope.$apply();
                    });
                break;
            case 'd3_ews_id':
                SfLookup("<?php echo e(url('trs_local_mst_ews_lookup')); ?>",
                    function(id, name, jsondata) {
                        $scope.d3[selector].ews_id = jsondata.ews_id;
                        $scope.d3[selector].ews_location = jsondata.ews_location;;
                        $scope.$apply();
                    });
                break;
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.oLog = function() {
        SfLog('trs_local_mst_hardware', $scope.h.kd_hardware);
    }

    $scope.addRow = function() {
        $scope.d1.push({});
    }

    $scope.oDelrow = function(idx) {
        $scope.d1.splice(idx, 1);
    }

    $scope.addRow3 = function() {
        $scope.d3.push({});
    }

    $scope.oDelrow3 = function(idx3) {
        $scope.d3.splice(idx3, 1);
    }

    $scope.oDel = function(id, isRestore) {
        if (id == undefined) {
            var id = $scope.h.kd_hardware;
        }
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), {
            restore: isRestore
        }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oDelForce = function(id) {
        if (id == undefined) {
            var id = $scope.h.kd_hardware;
        }
        var str = "force delete";
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + str + ' it!'
        }).then((result) => {
            if (result.value) {
                var $btn = $('button').button('loading');
                $http.post('trs_local_mst_hardware_fdel', {
                    code:id
                }).then(function(jdata) {
                    $btn.button('reset');
                    swal('OK ' + str + 'd!', 'Your file has been ' + str + 'd.', 'success')
                    if (fn) fn(jdata);
                }, function(error) {
                    $btn.button('reset');
                    swal('', error.data, 'error');
                    return false;
                });
                $scope.oSearch();
            }
        })
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\timesheet\backend\resources\views/trs/local/mst_hardware/mst_hardware_frm.blade.php ENDPATH**/ ?>