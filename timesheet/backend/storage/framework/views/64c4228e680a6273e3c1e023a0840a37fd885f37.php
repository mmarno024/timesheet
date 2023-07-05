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
    <div class="panel panel-success">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="row">
                    <div class="pull-right">
                        <div ng-show="f.tab=='list'">
                            <?php $__env->startComponent('layouts.common.coloradmin.guide', ['tag' => 'trs_local_trs_raw']); ?> <?php echo $__env->renderComponent(); ?>
                            <div class="input-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i
                                            class="fa fa fa-file-excel-o"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" ng-click="oSearch(1)"><i
                                            class="fa fa fa-recycle"></i></button>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                    placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="f.tab=='list'">
                    <div class="row">
                        
                        <div class="col-sm-10">
                            <div class="col-sm-2">
                                <label>Logger</label>
                                <div class="input-group">
                                    <input type="text" ng-value="f.kd_logger + ' - ' + f.nm_logger"
                                        class="form-control input-sm m-b-5" placeholder="Choose logger ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success btn-sm m-b-5" type="button"
                                            ng-click="oLookup('kd_logger')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>Hardware</label>
                                <div class="input-group">
                                    <input type="text" ng-value="f.kd_hardware" class="form-control input-sm m-b-5"
                                        placeholder="Choose hardware ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success btn-sm m-b-5" type="button"
                                            ng-click="oLookup('kd_hardware')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label style="margin-top: -5px">&nbsp;</label>
                                <button class="btn btn-sm btn-success btn-block" ng-click="oSearch()">Load Data</button>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="col-sm-8" style="float: right">
                                <label>Page Limit</label>
                                <select class="form-control" ng-model="limit" ng-change="oSearch()">
                                    <option ng-repeat="v in [10,50,100,1000]" ng-value="v">{{ v }}</option>
                                </select>
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
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            
                            <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{ v . id }}</td>
                            <td title="'Jenis Loger'" filter="{jenis_loger: 'text'}" sortable="'jenis_loger'">
                                {{ v . jenis_loger }}</td>
                            <td title="'No Seri Data Loger'" filter="{no_seri_data_loger: 'text'}"
                                sortable="'no_seri_data_loger'">{{ v . no_seri_data_loger }}</td>
                            <td title="'Versi Data Loger'" filter="{versi_data_loger: 'text'}"
                                sortable="'versi_data_loger'">{{ v . versi_data_loger }}</td>
                            <td title="'Kode Wilayah'" filter="{kode_wilayah: 'text'}" sortable="'kode_wilayah'">
                                {{ v . kode_wilayah }}</td>
                            <td title="'Kode Area'" filter="{kode_area: 'text'}" sortable="'kode_area'">
                                {{ v . kode_area }}</td>
                            <td title="'Kode Stasiun'" filter="{kode_stasiun: 'text'}" sortable="'kode_stasiun'">
                                {{ v . kode_stasiun }}</td>
                            <td title="'Simpan Data Pertama'" filter="{simpan_data_pertama: 'text'}"
                                sortable="'simpan_data_pertama'">{{ v . simpan_data_pertama }}</td>
                            <td title="'Simpan Data Terakhir'" filter="{simpan_data_terakhir: 'text'}"
                                sortable="'simpan_data_terakhir'">{{ v . simpan_data_terakhir }}</td>
                            <td title="'Pengambilan Data'" filter="{pengambilan_data: 'text'}"
                                sortable="'pengambilan_data'">{{ v . pengambilan_data }}</td>
                            <td title="'Kejadian Alarm Level'" filter="{kejadian_alarm_level: 'text'}"
                                sortable="'kejadian_alarm_level'">{{ v . kejadian_alarm_level }}</td>
                            <td title="'Kejadian Alarm Keamanan'" filter="{kejadian_alarm_keamanan: 'text'}"
                                sortable="'kejadian_alarm_keamanan'">{{ v . kejadian_alarm_keamanan }}</td>
                            <td title="'Logger Aktual'" filter="{logger_aktual: 'text'}" sortable="'logger_aktual'">
                                {{ v . logger_aktual }}</td>
                            <td title="'Sms Map Server'" filter="{sms_map_server: 'text'}" sortable="'sms_map_server'">
                                {{ v . sms_map_server }}</td>
                            <td title="'Data Logger Terpakai'" filter="{data_logger_terpakai: 'text'}"
                                sortable="'data_logger_terpakai'">{{ v . data_logger_terpakai }}</td>
                            <td title="'Kejadian Tindih Memory'" filter="{kejadian_tindih_memory: 'text'}"
                                sortable="'kejadian_tindih_memory'">{{ v . kejadian_tindih_memory }}</td>
                            <td title="'Data Tersimpan'" filter="{data_tersimpan: 'text'}" sortable="'data_tersimpan'">
                                {{ v . data_tersimpan }}</td>
                            <td title="'Interval Waktu'" filter="{interval_waktu: 'text'}" sortable="'interval_waktu'">
                                {{ v . interval_waktu }}</td>
                            <td title="'Baca Sensor Level'" filter="{baca_sensor_level: 'text'}"
                                sortable="'baca_sensor_level'">{{ v . baca_sensor_level }}</td>
                            <td title="'Status Alarm'" filter="{status_alarm: 'text'}" sortable="'status_alarm'">
                                {{ v . status_alarm }}</td>
                            <td title="'Nilai Alarm4'" filter="{nilai_alarm4: 'text'}" sortable="'nilai_alarm4'">
                                {{ v . nilai_alarm4 }}</td>
                            <td title="'Nilai Alarm3'" filter="{nilai_alarm3: 'text'}" sortable="'nilai_alarm3'">
                                {{ v . nilai_alarm3 }}</td>
                            <td title="'Nilai Alarm2'" filter="{nilai_alarm2: 'text'}" sortable="'nilai_alarm2'">
                                {{ v . nilai_alarm2 }}</td>
                            <td title="'Nilai Alarm1'" filter="{nilai_alarm1: 'text'}" sortable="'nilai_alarm1'">
                                {{ v . nilai_alarm1 }}</td>
                            <td title="'Nilai Alarm Rendah'" filter="{nilai_alarm_rendah: 'text'}"
                                sortable="'nilai_alarm_rendah'">{{ v . nilai_alarm_rendah }}</td>
                            <td title="'Tinggi Level Awal'" filter="{tinggi_level_awal: 'text'}"
                                sortable="'tinggi_level_awal'">{{ v . tinggi_level_awal }}</td>
                            <td title="'Tinggi Rekahan Awal'" filter="{tinggi_rekahan_awal: 'text'}"
                                sortable="'tinggi_rekahan_awal'">{{ v . tinggi_rekahan_awal }}</td>
                            <td title="'Sampel Baca Sensor'" filter="{sampel_baca_sensor: 'text'}"
                                sortable="'sampel_baca_sensor'">{{ v . sampel_baca_sensor }}</td>
                            <td title="'Curah Hujan Harian'" filter="{curah_hujan_harian: 'text'}"
                                sortable="'curah_hujan_harian'">{{ v . curah_hujan_harian }}</td>
                            <td title="'Nilai Alarm Hujan Harian'" filter="{nilai_alarm_hujan_harian: 'text'}"
                                sortable="'nilai_alarm_hujan_harian'">{{ v . nilai_alarm_hujan_harian }}</td>
                            <td title="'Nilai Curah Hujan'" filter="{nilai_curah_hujan: 'text'}"
                                sortable="'nilai_curah_hujan'">{{ v . nilai_curah_hujan }}</td>
                            <td title="'Baca Sensor Rekahan'" filter="{baca_sensor_rekahan: 'text'}"
                                sortable="'baca_sensor_rekahan'">{{ v . baca_sensor_rekahan }}</td>
                            <td title="'Alarm Rekah'" filter="{alarm_rekah: 'text'}" sortable="'alarm_rekah'">
                                {{ v . alarm_rekah }}</td>
                            <td title="'Sensor Buka Pintu'" filter="{sensor_buka_pintu: 'text'}"
                                sortable="'sensor_buka_pintu'">{{ v . sensor_buka_pintu }}</td>
                            <td title="'Latitude'" filter="{latitude: 'text'}" sortable="'latitude'">
                                {{ v . latitude }}</td>
                            <td title="'Longitude'" filter="{longitude: 'text'}" sortable="'longitude'">
                                {{ v . longitude }}</td>
                            <td title="'Lokasi'" filter="{lokasi: 'text'}" sortable="'lokasi'">{{ v . lokasi }}
                            </td>
                            <td title="'Parameter'" filter="{parameter: 'text'}" sortable="'parameter'">
                                {{ v . parameter }}</td>
                            <td title="'Response'" filter="{response: 'text'}" sortable="'response'">
                                {{ v . response }}</td>
                            <td title="'Sender'" filter="{sender: 'text'}" sortable="'sender'">{{ v . sender }}
                            </td>
                            <td title="'Server'" filter="{server: 'text'}" sortable="'server'">{{ v . server }}
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
                            <label title='jenis_loger'>Jenis Loger</label>
                            <input type="text" ng-model="h.jenis_loger" id="h_jenis_loger" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='no_seri_data_loger'>No Seri Data Loger</label>
                            <input type="text" ng-model="h.no_seri_data_loger" id="h_no_seri_data_loger"
                                class="form-control input-sm" maxlength="5" readonly>
                            <label title='versi_data_loger'>Versi Data Loger</label>
                            <input type="text" ng-model="h.versi_data_loger" id="h_versi_data_loger"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='kode_wilayah'>Kode Wilayah</label>
                            <input type="text" ng-model="h.kode_wilayah" id="h_kode_wilayah" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='kode_area'>Kode Area</label>
                            <input type="text" ng-model="h.kode_area" id="h_kode_area" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='kode_stasiun'>Kode Stasiun</label>
                            <input type="text" ng-model="h.kode_stasiun" id="h_kode_stasiun" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='simpan_data_pertama'>Simpan Data Pertama</label>
                            <input type="text" ng-model="h.simpan_data_pertama" id="h_simpan_data_pertama"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='simpan_data_terakhir'>Simpan Data Terakhir</label>
                            <input type="text" ng-model="h.simpan_data_terakhir" id="h_simpan_data_terakhir"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='pengambilan_data'>Pengambilan Data</label>
                            <input type="text" ng-model="h.pengambilan_data" id="h_pengambilan_data"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='kejadian_alarm_level'>Kejadian Alarm Level</label>
                            <input type="text" ng-model="h.kejadian_alarm_level" id="h_kejadian_alarm_level"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='kejadian_alarm_keamanan'>Kejadian Alarm Keamanan</label>
                            <input type="text" ng-model="h.kejadian_alarm_keamanan" id="h_kejadian_alarm_keamanan"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='logger_aktual'>Logger Aktual</label>
                            <input type="text" ng-model="h.logger_aktual" id="h_logger_aktual" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='sms_map_server'>Sms Map Server</label>
                            <input type="text" ng-model="h.sms_map_server" id="h_sms_map_server"
                                class="form-control input-sm" maxlength="" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='data_logger_terpakai'>Data Logger Terpakai</label>
                            <input type="text" ng-model="h.data_logger_terpakai" id="h_data_logger_terpakai"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='kejadian_tindih_memory'>Kejadian Tindih Memory</label>
                            <input type="text" ng-model="h.kejadian_tindih_memory" id="h_kejadian_tindih_memory"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='data_tersimpan'>Data Tersimpan</label>
                            <input type="text" ng-model="h.data_tersimpan" id="h_data_tersimpan"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='interval_waktu'>Interval Waktu</label>
                            <input type="text" ng-model="h.interval_waktu" id="h_interval_waktu"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='baca_sensor_level'>Baca Sensor Level</label>
                            <input type="text" ng-model="h.baca_sensor_level" id="h_baca_sensor_level"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='status_alarm'>Status Alarm</label>
                            <input type="text" ng-model="h.status_alarm" id="h_status_alarm" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='nilai_alarm4'>Nilai Alarm4</label>
                            <input type="text" ng-model="h.nilai_alarm4" id="h_nilai_alarm4" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='nilai_alarm3'>Nilai Alarm3</label>
                            <input type="text" ng-model="h.nilai_alarm3" id="h_nilai_alarm3" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='nilai_alarm2'>Nilai Alarm2</label>
                            <input type="text" ng-model="h.nilai_alarm2" id="h_nilai_alarm2" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='nilai_alarm1'>Nilai Alarm1</label>
                            <input type="text" ng-model="h.nilai_alarm1" id="h_nilai_alarm1" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='nilai_alarm_rendah'>Nilai Alarm Rendah</label>
                            <input type="text" ng-model="h.nilai_alarm_rendah" id="h_nilai_alarm_rendah"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='tinggi_level_awal'>Tinggi Level Awal</label>
                            <input type="text" ng-model="h.tinggi_level_awal" id="h_tinggi_level_awal"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='tinggi_rekahan_awal'>Tinggi Rekahan Awal</label>
                            <input type="text" ng-model="h.tinggi_rekahan_awal" id="h_tinggi_rekahan_awal"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='sampel_baca_sensor'>Sampel Baca Sensor</label>
                            <input type="text" ng-model="h.sampel_baca_sensor" id="h_sampel_baca_sensor"
                                class="form-control input-sm" maxlength="" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label title='curah_hujan_harian'>Curah Hujan Harian</label>
                            <input type="text" ng-model="h.curah_hujan_harian" id="h_curah_hujan_harian"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='nilai_alarm_hujan_harian'>Nilai Alarm Hujan Harian</label>
                            <input type="text" ng-model="h.nilai_alarm_hujan_harian" id="h_nilai_alarm_hujan_harian"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='nilai_curah_hujan'>Nilai Curah Hujan</label>
                            <input type="text" ng-model="h.nilai_curah_hujan" id="h_nilai_curah_hujan"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='baca_sensor_rekahan'>Baca Sensor Rekahan</label>
                            <input type="text" ng-model="h.baca_sensor_rekahan" id="h_baca_sensor_rekahan"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='alarm_rekah'>Alarm Rekah</label>
                            <input type="text" ng-model="h.alarm_rekah" id="h_alarm_rekah" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='sensor_buka_pintu'>Sensor Buka Pintu</label>
                            <input type="text" ng-model="h.sensor_buka_pintu" id="h_sensor_buka_pintu"
                                class="form-control input-sm" maxlength="" readonly>
                            <label title='latitude'>Latitude</label>
                            <input type="text" ng-model="h.latitude" id="h_latitude" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='longitude'>Longitude</label>
                            <input type="text" ng-model="h.longitude" id="h_longitude" class="form-control input-sm"
                                maxlength="" readonly>
                            <label title='lokasi'>Lokasi</label>
                            <input type="text" ng-model="h.lokasi" id="h_lokasi" class="form-control input-sm"
                                maxlength="100" readonly>
                            <label title='parameter'>Parameter</label>
                            <input type="text" ng-model="h.parameter" id="h_parameter" class="form-control input-sm"
                                maxlength="65535" readonly>
                            <label title='response'>Response</label>
                            <input type="text" ng-model="h.response" id="h_response" class="form-control input-sm"
                                maxlength="100" readonly>
                            <label title='sender'>Sender</label>
                            <input type="text" ng-model="h.sender" id="h_sender" class="form-control input-sm"
                                maxlength="25" readonly>
                            <label title='server'>Server</label>
                            <input type="text" ng-model="h.server" id="h_server" class="form-control input-sm"
                                maxlength="25" readonly>
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
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
            $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_trs_raw')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.q = {};
            $scope.limit = '';
            $scope.order = 'desc';

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.id,
                        path: 'trs_local_trs_raw',
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
                SfGetMediaList('trs_local_trs_raw/' + $scope.h.id, function(jdata) {
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
                                limit: $scope.limit,
                                order_by: $scope.order,
                                q: $scope.f.q,
                                logger: $scope.f.kd_logger,
                                hardware: $scope.f.kd_hardware,
                                // date1: moment($scope.f.date1).format('YYYY-MM-DD'),
                                // date2: moment($scope.f.date2).format('YYYY-MM-DD'),
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
                });
            }

            $scope.oRestore = function(id) {
                $scope.oDel(id, 1);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'kd_logger':
                        SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.f.kd_logger = jsondata.kd_logger;
                                $scope.f.nm_logger = jsondata.nm_logger;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup2')); ?>?plant=" + $scope.f.plant +
                            "&logger=" + $scope.f.kd_logger,
                            function(id, name, jsondata) {
                                $scope.f.kd_hardware = jsondata.kd_hardware;
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

<?php echo $__env->make('layouts.coloradmin_minified', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\pln\updk\backend\resources\views/trs/local/trs_raw/trs_raw_frm.blade.php ENDPATH**/ ?>