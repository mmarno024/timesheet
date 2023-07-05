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
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch(1)"><i
                                        class="fa fa fa-recycle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
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
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.kd_hardware)">
                            <td title="'Kode Logger'" filter="{kd_logger: 'text'}" sortable="'kd_logger'">
                                {{ v . rel_kd_logger . nm_logger }}
                            </td>
                            <td title="'Kode Hardware'" filter="{kd_hardware: 'text'}" sortable="'kd_hardware'">
                                {{ v . kd_hardware }}</td>
                            <td title="'UID'" filter="{uid: 'text'}" sortable="'uid'">
                                {{ v . uid }}</td>
                            <td title="'Location'" filter="{location: 'text'}" sortable="'location'">
                                {{ v . location }}</td>
                            <td title="'Nama Pos'" filter="{pos_name: 'text'}" sortable="'pos_name'">
                                {{ v . pos_name }}</td>
                            <td title="'Zona Waktu'" filter="{tzone: 'text'}" sortable="'tzone'">
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
                                    maxlength="15" ng-readonly="true" required>
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
                                    <div class="col-sm-12 text-primary m-b-10 text-center"><b>EXAMPLE : 202110190001</b>
                                    </div>
                                    <table class="table" width="100%" cellpadding="2">
                                        <tr>
                                            <td align="right">2021</td>
                                            <td align="center">:</td>
                                            <td>Tahun</td>
                                        </tr>
                                        <tr>
                                            <td align="right">101</td>
                                            <td align="center">:</td>
                                            <td>Kode proyek</td>
                                        </tr>
                                        <tr>
                                            <td align="right">9</td>
                                            <td align="center">:</td>
                                            <td>Kode logger</td>
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
                                placeholder="">
                        </div>
                        <div class="col-sm-2">
                            <label title='longitude'>Longitude</label>
                            <input type="number" ng-model="h.longitude" id="h_longitude" class="form-control input-sm"
                                placeholder="">
                        </div>
                        <div class="col-sm-2">
                            <label title='tzone'>Zona Waktu</label>&nbsp;<code>(Menit)</code>
                            <input type="number" ng-model="h.tzone" id="h_tzone" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="row" ng-if="h.kd_logger=='1' || h.kd_logger=='2'">
                        <div class=" col-sm-3">
                            <label title='perkalian'>Perkalian</label>
                            <input type="number" ng-model="h.perkalian" id="h_perkalian" class="form-control input-sm"
                                required>
                        </div>
                        <div class="col-sm-3">
                            <label title='penjumlahan'>Penjumlahan</label>
                            <input type="number" ng-model="h.penjumlahan" id="h_penjumlahan" class="form-control input-sm"
                                required>
                        </div>
                        <div class="col-sm-3">
                            <label title='satuan'>Satuan</label>&nbsp;<code>Kosongkan jk sama di sensor</code>
                            <input type="text" ng-model="h.satuan" id="h_satuan" class="form-control input-sm">
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
                    <p>&nbsp;</p>
                    <h3 ng-show="h.kd_logger=='9'" class="text-primary">Daftar Sensor</h3>
                    <div ng-show="h.kd_logger=='9'">
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
                    <h3 ng-show="h.kd_logger=='9' && f.crud=='u'" class="text-primary">Detail Label</h3>
                    <div ng-show="h.kd_logger=='9' && f.crud=='u'">
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
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.d1 = [];
            $scope.d2 = [];

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
                    item.formData = [{
                        id: $scope.h.kd_hardware,
                        path: 'trs_local_mst_hardware',
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
                SfGetMediaList('trs_local_mst_hardware/' + $scope.h.kd_hardware, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

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
                    case 'plant':
                        SfLookup("<?php echo e(url('sys_syplant_lookup')); ?>",
                            function(id, name, jsondata) {
                                $scope.h.plant = jsondata.plant;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_logger':
                        SfLookup("<?php echo e(url('trs_local_mst_logger_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.kd_logger = jsondata.kd_logger;
                                $scope.h.nm_logger = jsondata.nm_logger;
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

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\a_data\monitoring_back\backend\resources\views/trs/local/mst_hardware/mst_hardware_frm.blade.php ENDPATH**/ ?>