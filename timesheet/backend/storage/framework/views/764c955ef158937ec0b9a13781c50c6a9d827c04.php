<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Raw <?php $__env->stopSection(); ?>
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
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?>
            <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
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
                <div class="row" ng-show="f.tab=='list'">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label>Mulai dari</label>
                                <input type="date" class="form-control input-sm" ng-model="q.date1">
                            </div>
                            <div class="col-sm-2">
                                <label>Sampai dengan</label>
                                <input type="date" class="form-control input-sm" ng-model="q.date2">
                            </div>
                            <div ng-if="f.plant=='002'" class="col-sm-2">
                                <label>Project</label>
                                <div class="input-group">
                                    <input type="text" ng-value="q.plantx + ' - ' + q.plantnamex"
                                        class="form-control input-sm m-b-5" placeholder="Choose project ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                                            ng-click="oLookup('plant')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>Logger</label>
                                <div class="input-group">
                                    <input type="text" ng-value="q.nm_logger" class="form-control input-sm m-b-5"
                                        placeholder="Choose logger ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                                            ng-click="oLookup('kd_logger')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>Hardware</label>
                                <div class="input-group">
                                    <input type="text" ng-value="q.kd_hardware" class="form-control input-sm m-b-5"
                                        placeholder="Choose hardware ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-sm m-b-5" type="button"
                                            ng-click="oLookup('kd_hardware')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label style="margin-top: -5px">&nbsp;</label>
                                <button class="btn btn-sm btn-primary btn-block" ng-click="oSearch()">Proses</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="f.tab=='list'">
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i>
                    Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is
                    deleted item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;font-size:11px;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td style="padding:5px;" title="'Waktu terima'" filter="{updated_at: 'text'}" sortable="''">
                                {{ v.updated_at }}</td>
                            <td style="padding:5px;" title="'Waktu Aktual'" filter="{timelocal: 'text'}" sortable="''">
                                {{ v.timelocal }}</td>
                            <td style="padding:5px;" title="'Project'" filter="{plant: 'text'}" sortable="''">
                                {{ v.rel_plant.plantname.substr(0, 10) }}..</td>
                            <td style="padding:5px;" title="'Logger'" filter="{kd_logger: 'text'}" sortable="''">
                                {{ v.rel_kd_logger.nm_logger }}</td>
                            <td style="padding:5px;" title="'Hardware'" filter="{kd_hardware: 'text'}" sortable="''">
                                {{ v.kd_hardware }}</td>
                            <td style="padding:5px;" title="'Lokasi'" filter="{location: 'text'}" sortable="">
                                {{ v.location.substr(0, 10) }}..</td>
                            <td style="padding:5px;" title="'Browser'" filter="{browser: 'text'}" sortable="''">
                                {{ v.browser.substr(0, 15) }}..</td>
                            <td style="padding:5px;" title="'Nilai'" filter="{location: 'text'}" sortable="">
                                <span ng-if="v.kd_logger=='1'" ng-repeat="v1 in v.rel_d_wl"
                                    class="label label-primary m-r-5" style="font-size: 10px;">
                                    {{ v1.kd_sensor }} : {{ v1.value }}
                                </span>
                                <span ng-if="v.kd_logger=='2'" ng-repeat="v1 in v.rel_d_ch"
                                    class="label label-success m-r-5" style="font-size: 10px;">
                                    {{ v1.kd_sensor }} : {{ v1.value }}
                                </span>
                                <span ng-if="v.kd_logger=='8'" ng-repeat="v1 in v.rel_d_ftp"
                                    class="label label-warning m-r-5" style="font-size: 10px;">
                                    {{ v1.kd_sensor }} : {{ v1.value }}
                                </span>
                                <span ng-if="v.kd_logger=='9'" ng-repeat="v1 in v.rel_d_gpa"
                                    class="label label-warning m-r-5" style="font-size: 10px;">
                                    {{ v1.kd_sensor }} : {{ v1.value }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='id'>Id</label>
                            <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength=""
                                ng-readonly="f.crud!='c' || true " placeholder="auto" readonly>
                            <label title='kd_logger'>Logger</label>
                            <input type="text" ng-model="h.kd_logger" id="h_kd_logger" class="form-control input-sm"
                                readonly>
                            <label title='kd_hardware'>Hardware</label>
                            <input type="text" ng-model="h.kd_hardware" id="h_kd_hardware" class="form-control input-sm"
                                maxlength="5" readonly>
                            <label title='uid'>UID</label>
                            <input type="text" ng-model="h.uid" id="h_uid" class="form-control input-sm" maxlength=""
                                readonly>
                            <label title='location'>Lokasi</label>
                            <input type="text" ng-model="h.location" id="h_location" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='timestamp'>Timestamp</label>
                            <input type="text" ng-model="h.timestamp" id="h_timestamp" class="form-control input-sm"
                                readonly>
                            <label title='timeutc'>Waktu UTC</label>
                            <input type="text" ng-model="h.timeutc" id="h_timeutc" class="form-control input-sm" readonly>
                            <label title='timelocal'>Waktu Lokal</label>
                            <input type="text" ng-model="h.timelocal" id="h_timelocal" class="form-control input-sm"
                                readonly>
                            <label title='latitude'>Latitude</label>
                            <input type="text" ng-model="h.latitude" id="h_latitude" class="form-control input-sm" readonly>
                            <label title='longitude'>Longitude</label>
                            <input type="text" ng-model="h.longitude" id="h_longitude" class="form-control input-sm"
                                readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='sender'>Pengirim</label>
                            <input type="text" ng-model="h.sender" id="h_sender" class="form-control input-sm" readonly>
                            <label title='browser'>Browser</label>
                            <input type="text" ng-model="h.browser" id="h_browser" class="form-control input-sm" readonly>
                            <label title='secret_key'>Kunci</label>
                            <input type="text" ng-model="h.secret_key" id="h_secret_key" class="form-control input-sm"
                                readonly>
                            <label title='server'>Server</label>
                            <input type="text" ng-model="h.server" id="h_server" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-12">
                            <label title='parameter'>Parameter</label>
                            <textarea class="form-control input-sm" style="height:150px;" ng-model="h.parameter" readonly></textarea>
                            
                        </div>
                    </div>
                    <hr />
                    <div class="row" ng-show="h.kd_logger=='1'">
                        <div class="col-sm-3">
                            <label title='simpan_data_pertama'>Simpan data pertama</label>
                            <input type="text" ng-model="h.rel_d_wl[0].simpan_data_pertama" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='kejadian_alarm_keamanan'>Alarm keamanan</label>
                            <input type="text" ng-model="h.rel_d_wl[0].kejadian_alarm_keamanan" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='kejadian_tindih_memory'>Tindih memory</label>
                            <input type="text" ng-model="h.rel_d_wl[0].kejadian_tindih_memory" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='status_alarm'>Status alarm</label>
                            <input type="text" ng-model="h.rel_d_wl[0].status_alarm" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm4'>Nilai alarm 4</label>
                            <input type="text" ng-model="h.rel_d_wl[0].nilai_alarm4" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='sensor_buka_pintu'>Sensor buka pintu</label>
                            <input type="text" ng-model="h.rel_d_wl[0].sensor_buka_pintu" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='simpan_data_terakhir'>Simpan data terakhir</label>
                            <input type="text" ng-model="h.rel_d_wl[0].simpan_data_terakhir" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='logger_aktual'>Logger aktual</label>
                            <input type="text" ng-model="h.rel_d_wl[0].logger_aktual" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='data_tersimpan'>Data tersimpan</label>
                            <input type="text" ng-model="h.rel_d_wl[0].data_tersimpan" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm1'>Nilai alarm 1</label>
                            <input type="text" ng-model="h.rel_d_wl[0].nilai_alarm1" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm_rendah'>Nilai alarm rendah</label>
                            <input type="text" ng-model="h.rel_d_wl[0].nilai_alarm_rendah" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='pengambilan_data'>Pengambilan data</label>
                            <input type="text" ng-model="h.rel_d_wl[0].pengambilan_data" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='sms_map_server'>Sms map server</label>
                            <input type="text" ng-model="h.rel_d_wl[0].sms_map_server" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='interval_waktu'>Interval waktu</label>
                            <input type="text" ng-model="h.rel_d_wl[0].interval_waktu" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm2'>Nilai alarm 2</label>
                            <input type="text" ng-model="h.rel_d_wl[0].nilai_alarm2" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='tinggi_level_awal'>Tinggi level awal</label>
                            <input type="text" ng-model="h.rel_d_wl[0].tinggi_level_awal" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='kejadian_alarm_level'>Alarm level</label>
                            <input type="text" ng-model="h.rel_d_wl[0].kejadian_alarm_level" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='data_logger_terpakai'>Data terpakai</label>
                            <input type="text" ng-model="h.rel_d_wl[0].data_logger_terpakai" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='baca_sensor_level'>Baca sensor level</label>
                            <input type="text" ng-model="h.rel_d_wl[0].baca_sensor_level" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm3'>Nilai alarm 3</label>
                            <input type="text" ng-model="h.rel_d_wl[0].nilai_alarm3" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='sampel_baca_sensor'>Sample baca sensor</label>
                            <input type="text" ng-model="h.rel_d_wl[0].sampel_baca_sensor" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                    </div>

                    <div class="row" ng-show="h.kd_logger=='2'">
                        <div class="col-sm-3">
                            <label title='simpan_data_pertama'>Simpan data pertama</label>
                            <input type="text" ng-model="h.rel_d_ch[0].simpan_data_pertama" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='kejadian_alarm_keamanan'>Alarm keamanan</label>
                            <input type="text" ng-model="h.rel_d_ch[0].kejadian_alarm_keamanan" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='kejadian_tindih_memory'>Tindih memory</label>
                            <input type="text" ng-model="h.rel_d_ch[0].kejadian_tindih_memory" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='status_alarm'>Status alarm</label>
                            <input type="text" ng-model="h.rel_d_ch[0].status_alarm" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='simpan_data_terakhir'>Simpan data terakhir</label>
                            <input type="text" ng-model="h.rel_d_ch[0].simpan_data_terakhir" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='logger_aktual'>Logger aktual</label>
                            <input type="text" ng-model="h.rel_d_ch[0].logger_aktual" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='data_tersimpan'>Data tersimpan</label>
                            <input type="text" ng-model="h.rel_d_ch[0].data_tersimpan" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_alarm_hujan_harian'>Nilai alarm hujan harian</label>
                            <input type="text" ng-model="h.rel_d_ch[0].nilai_alarm_hujan_harian" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='pengambilan_data'>Pengambilan data</label>
                            <input type="text" ng-model="h.rel_d_ch[0].pengambilan_data" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='sms_map_server'>Sms map server</label>
                            <input type="text" ng-model="h.rel_d_ch[0].sms_map_server" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='interval_waktu'>Interval waktu</label>
                            <input type="text" ng-model="h.rel_d_ch[0].interval_waktu" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='nilai_curah_hujan'>Nilai curah hujan</label>
                            <input type="text" ng-model="h.rel_d_ch[0].nilai_curah_hujan" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label title='kejadian_alarm_level'>Alarm level</label>
                            <input type="text" ng-model="h.rel_d_ch[0].kejadian_alarm_level" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='data_logger_terpakai'>Data terpakai</label>
                            <input type="text" ng-model="h.rel_d_ch[0].data_logger_terpakai" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='curah_hujan_harian'>Curah hujan harian</label>
                            <input type="text" ng-model="h.rel_d_ch[0].curah_hujan_harian" id="h_sender"
                                class="form-control input-sm" readonly>
                            <label title='sensor_buka_pintu'>Sensor buka pintu</label>
                            <input type="text" ng-model="h.rel_d_ch[0].sensor_buka_pintu" id="h_sender"
                                class="form-control input-sm" readonly>
                        </div>
                    </div>

                    <div class="row" ng-show="h.kd_logger=='8'">
                        <div class="col-sm-12">
                            <h3 class="text-primary">Nilai Sensor</h3>
                            <p>
                                <span ng-repeat="v1 in h.rel_d_ftp">
                                    <button type="button" class="btn btn-warning m-b-5">{{ v1.rel_sensor.nm_sensor }}
                                        :
                                        {{ v1.data_aktual }}
                                        <i>({{ v1.rel_sensor.satuan }})</i></button>&nbsp;
                                </span>
                        </div>
                    </div>
                    <div class="row" ng-show="h.kd_logger=='9'">
                        <div class="col-sm-12">
                            <h3 class="text-primary">Nilai Sensor</h3>
                            <p>
                                <span ng-repeat="v1 in h.rel_d_gpa">
                                    <button type="button" class="btn btn-warning m-b-5">{{ v1.rel_sensor.nm_sensor }}
                                        :
                                        {{ v1.value }} <i>({{ v1.rel_sensor.satuan }})</i></button>&nbsp;
                                </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_raw')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {
                date1: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>"),
                date2: jsDate("<?php echo e(date('Y-m-d H:i:s')); ?>")
            };
            $scope.limit = '';
            $scope.order = 'desc';

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
                SfFormNew("#frm");
            }

            $scope.oSearch = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                $scope.tableList = new NgTableParams({
                    count: 100
                }, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.order,
                                q: $scope.f.q,
                                lg: $scope.q.kd_logger,
                                hw: $scope.q.kd_hardware,
                                t1: moment($scope.q.date1).format(
                                    'YYYY-MM-DD 00:00:01'),
                                t2: moment($scope.q.date2).format(
                                    'YYYY-MM-DD 23:59:59'),
                                trash: $scope.f.trash,
                                plant: $scope.f.plant,
                                qplant: $scope.q.plantx,
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
                    $scope.oSearch2();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.f.crud = 'u';
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
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup2')); ?>?plant=" + $scope.f.plant +
                            "&logger=" + $scope.q.kd_logger,
                            function(id, name, jsondata) {
                                $scope.q.kd_hardware = jsondata.kd_hardware;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_trs_raw', $scope.h.id);
            }

            $scope.oSearch();
        }]);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wmon\wadm\backend\resources\views/trs/local/trs_raw/trs_raw_frm.blade.php ENDPATH**/ ?>