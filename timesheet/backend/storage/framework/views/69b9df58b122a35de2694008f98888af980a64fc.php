<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data hardware <?php $__env->stopSection(); ?>
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
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel2()" ng-show="f.crud=='u' && f.trash==1 && f.plant=='002'"><i class="fa fa-trash"></i> Force Delete</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                Back</button>
        </div>
        <div class="row" ng-show="f.tab=='list'">
            <div class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <select name="vviews_expired" class="form-control input-sm" style="background:aquamarine" ng-model="viewexpiredh">
                    <option value="">Active</option>
                    <option value="xon">Expired</option>
                </select>
            </div>
            <div ng-show="viewexpiredh!='xon'" class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <select name="vviews_map" class="form-control input-sm" style="background:aquamarine" ng-model="viewmaph">
                    <option value="">Show on MAP</option>
                    <option value="xoff">Hide from MAP</option>
                </select>
            </div>
            <div  ng-show="f.plant=='002'" class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <select name="vviews" class="form-control input-sm" style="background:aquamarine" ng-model="viewh">
                    <option value="">On Project</option>
                    <option value="xregister">Non Project</option>
                </select>
            </div>
            <div ng-show="f.plant=='002' && f.tab=='list' && viewh == ''" class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <div class="input-group">
                    <input type="text" ng-value="q.plantnamex"
                        class="form-control input-sm m-b-5" placeholder="Choose project ..." readonly>
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                            ng-click="oLookup('plant')"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div ng-if="f.tab=='list' && f.plant!='002'" class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <div class="input-group">
                    <input type="text" ng-value="q.nm_logger"
                        class="form-control input-sm m-b-5" placeholder="Choose Logger ..." readonly>
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                            ng-click="oLookup('kd_logger2')"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div ng-if="f.tab=='list' && f.plant=='002'" class="col-lg-2 col-md-3 col-sm-4 m-t-5">
                <div class="input-group">
                    <input type="text" ng-value="q.nm_logger"
                        class="form-control input-sm m-b-5" placeholder="Choose Logger ..." readonly>
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                            ng-click="oLookup('kd_logger')"><i class="fa fa-search"></i></button>
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
                        <td style="padding:6px;" title="'View'" sortable="">
                            <span ng-class="{'label label-success':v.view_map=='on' || v.view_map=='' || v.view_map=='NULL','label label-danger':v.view_map=='off'}">{{ v.view_map=='off'?'Hide':'View' }}</span>
                            <span ng-class="{'label label-success':v.view_expired=='off' || v.view_expired=='' || v.view_expired=='NULL','label label-danger':v.view_expired=='on'}">{{ v.view_expired=='on'?'Expired':'Active' }}</span>
                        </td>                        
                        <td style="padding:6px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="">
                            <span ng-if="v.kd_logger != '8' && v.kd_logger != '9'" ng-class="{'label label-primary':v.kd_logger=='1','label label-success':v.kd_logger=='2','label label-inverse':v.kd_logger=='3' || v.kd_logger=='4','label label-warning':v.kd_logger=='8' || v.kd_logger=='9','label label-danger':v.kd_logger=='5'}">{{ v . rel_kd_logger . nm_logger.substr(0,3)}} | {{ v . kd_hardware }}</span>
                            <span ng-if="v.kd_logger == '8' || v.kd_logger == '9'" ng-class="{'label label-primary':v.kd_logger=='1','label label-success':v.kd_logger=='2','label label-inverse':v.kd_logger=='3' || v.kd_logger=='4','label label-warning':v.kd_logger=='8' || v.kd_logger=='9','label label-danger':v.kd_logger=='5'}">{{ v . rel_kd_logger . nm_logger.substr(3)}} | {{ v . kd_hardware }}</span>
                        </td>
                        <td style="padding:6px;" title="'Lokasi'" filter="{location: 'text'}" sortable="">
                            {{ v . location }}</td>
                        <td style="padding:6px;" title="'Latitude'" filter="{latitude: 'text'}" sortable="">
                            {{ v . latitude }}</td>
                        <td style="padding:6px;" title="'Longitude'" filter="{longitude: 'text'}" sortable="">
                            {{ v . longitude }}</td>
                        <td style="padding:6px;" title="'Nomor GSM'" filter="{no_gsm: 'text'}" sortable="">
                            {{ v . no_gsm }}</td>
                        <td style="padding:6px;" title="'Project'" filter="{plant: 'text'}" sortable="">
                            {{ v . rel_plant != null ? v.rel_plant.plantname : 'Unregistered'}}</td>
                        <td style="padding:6px;" title="'Zona Waktu'" filter="{tzone: 'text'}" sortable="">
                            {{ v . tzone }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-3">
                        <label title='plant'>Kode Project</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.plant" id="h_plant" class="form-control input-sm" readonly
                                maxlength="15" ng-readonly="true">
                            <div class="input-group-btn">
                                <button ng-show="f.crud=='c'" class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('plant','h_plant')"><i class="fa fa-search"></i></button>
                                <button ng-show="f.crud=='u'" class="btn btn-default btn-sm" type="button"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_logger'>Kode Logger</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_logger" id="h_kd_logger" class="form-control input-sm"
                                readonly maxlength="15" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button ng-show="f.crud=='c'" class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_logger','h_kd_logger')"><i class="fa fa-search"></i></button>
                                <button ng-show="f.crud=='u'" class="btn btn-default btn-sm" type="button"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_hardware'>Kode Hardware</label>
                        <input type="text" ng-model="h.kd_hardware" id="h_kd_hardware" class="form-control input-sm"
                            maxlength="6" ng-readonly="f.crud!='c'" required>
                    </div>
                    <div class="col-sm-3">
                        <label title='uid'>UID</label>&nbsp;<a data-toggle="modal" data-target="#myModal"
                            id="remov">Help<i class="fa fa-question"></i></a>
                        <input type="text" ng-model="h.uid" id="h_uid" class="form-control input-sm" maxlength="12"
                            readonly placeholder="Auto create">
                    </div>
                </div>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="col-sm-12 text-primary m-b-10 text-center"><b>EXAMPLE : 20210001</b>
                                </div>
                                <table class="table" width="100%" cellpadding="2">
                                    <tr>
                                        <td align="right">2021</td>
                                        <td align="center">:</td>
                                        <td>Tahun</td>
                                    </tr>
                                    <tr>
                                        <td align="right">0001</td>
                                        <td align="center">:</td>
                                        <td>Nomor urut hardware sesuai tahun</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label title='location'>Lokasi</label>
                        <input type="text" ng-model="h.location" id="h_location" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label title='pos_name'>Nama Pos</label>
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
                        <label title='tzone'>Zona Waktu</label>&nbsp;<code>(Menit)</code>
                        <input type="number" ng-model="h.tzone" id="h_tzone" class="form-control input-sm" readonly>
                    </div>
                </div>

                <div class="row" ng-if="h.kd_logger=='1' || h.kd_logger=='2' || h.kd_logger=='3' || h.kd_logger=='4'">
                    <div class=" col-sm-2">
                        <label title='perkalian'>Perkalian</label>
                        <input type="number" ng-model="h.perkalian" id="h_perkalian" class="form-control input-sm"
                            required readonly>
                    </div>
                    <div class="col-sm-2">
                        <label title='penjumlahan'>Penjumlahan</label>
                        <input type="number" ng-model="h.penjumlahan" id="h_penjumlahan" class="form-control input-sm"
                            required readonly>
                    </div>
                    <div class="col-sm-3">
                        <label title='satuan'>Satuan</label>&nbsp;<code>Kosongkan jk sama di sensor</code>
                        <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label title='set_alarm'>Set Alarm</label>
                        <select ng-model="h.set_alarm" id="h_set_alarm" class="form-control input-sm">
                            <option ng-repeat="vset in ['on','off']">{{ vset }}</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label title='no_gsm'>Nomor GSM</label>
                        <input type="text" ng-model="h.no_gsm" id="h_no_gsm" class="form-control input-sm">
                    </div>
                    <div class="col-sm-2">
                        <label title='view_map'>View MAP</label>
                        <select ng-model="h.view_map" id="h_view_map" class="form-control input-sm" style="background: aquamarine">
                            <option ng-repeat="viewset in ['on','off']">{{ viewset }}</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label title='view_expired'>View Expired</label>
                        <input type="text" ng-model="h.view_expired" id="h_view_expired" class="form-control input-sm" maxlength="12"
                            readonly>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3">
                        <label title='kd_provinsi'>Provinsi</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_provinsi+''+h.nm_provinsi" id="h_kd_provinsi"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_provinsi','h_kd_provinsi')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_kabupaten'>Kota/Kabupaten</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_kabupaten+''+h.nm_kabupaten" id="h_kd_kabupaten"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_kabupaten','h_kd_kabupaten')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_kecamatan'>Kecamatan</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_kecamatan+''+h.nm_kecamatan" id="h_kd_kecamatan"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_kecamatan','h_kd_kecamatan')"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label title='kd_desa'>Desa</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.kd_desa+''+h.nm_desa" id="h_kd_desa"
                                class="form-control input-sm" ng-readonly="true" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"
                                    ng-click="oLookup('kd_desa','h_kd_desa')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                
                <h3 ng-show="h.kd_logger=='8' || h.kd_logger=='9'" class="text-primary">Daftar Sensor</h3>
                <div ng-show="h.kd_logger=='8' || h.kd_logger=='9'">
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
                                                <span class="label label-danger">Hapus Sensor</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="addRow();">Tambah Sensor</button>
                    </div>
                </div>
                <hr>
                <h3 ng-show="(h.kd_logger=='8'||h.kd_logger=='9') && f.crud=='u'" class="text-primary">Detail Label</h3>
                <div ng-show="(h.kd_logger=='8'||h.kd_logger=='9') && f.crud=='u'">
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
                
                <h3 class="text-primary" ng-show="h.kd_logger=='1' || h.kd_logger=='2'">Detail Label
                </h3>
                <div ng-show="h.kd_logger=='1' || h.kd_logger=='2'">
                    <div class="list-group">
                        <div class="col-sm-12">
                            <div class="col-sm-7 m-0 p-0">
                                <label>Input Value with sparated by comma (,) <code>Example :
                                            0,10,20,30,40</code></label>
                                <textarea ng-model="d2.val_step" id="d2_val_step" class="form-control input-sm"
                                    rows="3"></textarea>
                                <p>&nbsp;</p>
                                <label>Input Color with sparated by comma (,) <code>Available color :
                                            merah,oranye,kuning,hijau_muda,hijau,biru_muda,biru</code></label>
                                <textarea ng-model="d2.color_step" id="d2_color_step" class="form-control input-sm"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
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
    $scope.q = {};
    $scope.viewh = '';
    $scope.viewmaph = '';
    $scope.viewexpiredh = '';

    $scope.arrViewH = [{
            "vhid": 1,
            "vhname": "Registered"
        },
        {
            "vhid": 2,
            "vhname": "Unregistered"
        }
    ];

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
                        log:$scope.q.kd_logger,
                        viewh: $scope.viewh,
                        viewmaph: $scope.viewmaph,
                        viewexpiredh: $scope.viewexpiredh,
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
            d2: $scope.d2
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
            $scope.oGallery();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLookup = function(id, selector, obj) {
        switch (id) {
            // case 'plant':
            //     SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>",
            //         function(id, name, jsondata) {
            //             $scope.h.plant = jsondata.plant;
            //             $scope.$apply();
            //         });
            //     break;
            case 'plant':
                SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>?plant=" + $scope.f.plant,
                    function(id, name, jsondata) {
                        $scope.q.plantx = jsondata.plant;
                        $scope.q.plantnamex = jsondata.plantname;
                        $scope.$apply();
                    });
                break;
            case 'kd_logger':
                SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                    function(id, name, jsondata) {
                        $scope.q.kd_logger = jsondata.kd_logger;
                        $scope.q.nm_logger = jsondata.nm_logger;
                        $scope.$apply();
                    });
                break;
            case 'kd_logger2':
                SfLookup("<?php echo e(url('trs_local_mst_logger_lookup2')); ?>?plant=" + $scope.f.plant,
                    function(id, name, jsondata) {
                        $scope.q.kd_logger = jsondata.kd_logger;
                        $scope.q.nm_logger = jsondata.nm_logger;
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

    $scope.oDel2 = function(id) {
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
                    swal(
                        'OK ' + str + 'd!',
                        'Your file has been ' + str + 'd.',
                        'success'
                    )
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
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\wmon_fix\admin\backend\resources\views/trs/local/mst_hardware/mst_hardware_frm.blade.php ENDPATH**/ ?>