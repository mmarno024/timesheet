<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Plant <?php $__env->stopSection(); ?>
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
                        <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()"
                            ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.plant)">
                            <td style="padding:6px;" title="'Project'" filter="{plant: 'text'}" sortable="">
                                {{ v . plant }}</td>
                            <td style="padding:6px;" title="'Project Name'" filter="{plantname: 'text'}" sortable="">
                                {{ v . plantname }}
                            </td>
                            <td style="padding:6px;" title="'Addr'" filter="{addr: 'text'}" sortable="">
                                {{ v . addr }}</td>
                            <td style="padding:6px;" title="'City'" filter="{city: 'text'}" sortable="">
                                {{ v . rel_city . nm_kabupaten }}
                            </td>
                            <td style="padding:6px;" title="'Provice'" filter="{provice: 'text'}" sortable="">
                                {{ v . rel_provice . nm_provinsi }}</td>
                            <td style="padding:6px;" title="'Latitude'" filter="{latitude: 'text'}" sortable="">
                                {{ v . latitude }}</td>
                            <td style="padding:6px;" title="'Longitude'" filter="{longitude: 'text'}" sortable="">
                                {{ v . longitude }}</td>
                            <td style="padding:6px;" title="'Note'" filter="{note: 'text'}" sortable="">
                                {{ v . note }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        
                        <div class="col-sm-1">
                            <label>Project</label>
                            <input type="text" ng-model="h.plant" id="h_plant" class="form-control input-sm" maxlength="3"
                                ng-readonly="true" placeholder="Auto">
                        </div>
                        <div class="col-sm-3">
                            <label>Nama Project</label>
                            <input type="text" ng-model="h.plantname" id="h_plantname" class="form-control input-sm"
                                required maxlength="50">
                        </div>
                        <div class="col-sm-4">
                            <label>Note</label>
                            <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Address</label>
                            <input type="text" ng-model="h.addr" id="h_addr" class="form-control input-sm" maxlength="100">
                        </div>
                        <div class="col-sm-3">
                            <label>Provinsi</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.provice+' | '+h.provice_name" id="h_provice"
                                    class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('provice','h_provice')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Kabupaten/Kota</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.city+' | '+h.city_name" id="h_city"
                                    class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('city','h_city')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Kecamatan</label>
                            <div class="input-group">
                                <input type="text" ng-value="h.state+''+h.state_name" id="h_state"
                                    class="form-control input-sm" ng-readonly="true" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        ng-click="oLookup('state','h_state')"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Coordinate</label>
                            <input type="text" ng-model="h.coordinate" id="h_coordinate" class="form-control input-sm">
                        </div>
                        <div class="col-sm-3">
                            <label>Latitude</label>
                            <input type="text" ng-model="h.latitude" id="h_latitude" class="form-control input-sm">
                        </div>
                        <div class="col-sm-3">
                            <label>Longitude</label>
                            <input type="text" ng-model="h.longitude" id="h_longitude" class="form-control input-sm">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Favicon Note</label>
                            <input type="text" ng-model="h.favicon" id="h_favicon" class="form-control input-sm"
                                maxlength="100">
                        </div>
                        <div class="col-sm-2">
                            <label>Logo</label>
                            <select ng-model="h.image" id="h_image" class="form-control input-sm">
                                <option ng-repeat="v in m" ng-value="v.name">{{ v . name . substr(19) }}</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>&nbsp;</label>
                            <div class="thumbnail" ng-hide="h.image==null">
                                <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . image }}" alt="Logo">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Favicon</label>
                            <select ng-model="h.image_favicon" id="h_image_favicon" class="form-control input-sm">
                                <option ng-repeat="v in m" ng-value="v.name">{{ v . name . substr(19) }}</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label>&nbsp;</label>
                            <div class="thumbnail" ng-hide="h.image_favicon==null">
                                <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . image_favicon }}"
                                    alt="Favicon Image">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-primary">Daftar Logger</h3>
                    <div class="list-group">
                        <div class="row m-b-5" ng-repeat="v1 in d">
                            <div class="col-sm-4">
                                <div class="col-sm-10 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                        <tr>
                                            <td width="15%">{{ $index + 1 }}.</td>
                                            <td width="85%" class="text-primary p-0">
                                                <input type="text" ng-model="v1.kd_hardware" placeholder="..."
                                                    class="form-control input-sm no-border-text text-primary"
                                                    ng-click="oLookup('kd_hardware',v1)">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-2 m-0 p-0">
                                    <table class="table table-condensed table-bordered m-0" style="white-space: nowrap;">
                                        <tr>
                                            <td class="text-danger pointer" ng-click="oDelrow($index)" align="center">
                                                <span class="label label-danger">Hapus Logger</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="addRow();">Tambah Logger</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('sys_syplant')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.d = [];
            $scope.d1 = {}
            $scope.m = [];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    item.formData = [{
                        id: $scope.h.plant,
                        path: 'sys_syplant',
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
                SfGetMediaList('sys_syplant/' + $scope.h.plant, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                $scope.d = [];
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.plant = null;
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
                    f: $scope.f,
                    d: $scope.d,
                }, function(jdata) {
                    $scope.oSearch();
                });
            }

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.oNew();
                    $scope.h = jdata.data.h;
                    $scope.h.provice_name = jdata.data.h.rel_provice.nm_provinsi;
                    $scope.h.city_name = jdata.data.h.rel_city.nm_kabupaten;
                    $scope.f.crud = 'u';
                    $scope.d = jdata.data.d;
                    $scope.oGallery();
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.plant;
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
                    case 'com_code':
                        SfLookup("<?php echo e(url('sys_sycom_lookup')); ?>", function(id, name, jsondata) {
                            $("#" + selector).val(id).trigger('input');;
                        });
                        break;
                    case 'provice':
                        SfLookup("<?php echo e(url('trs_local_mst_provinsi_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.provice = jsondata.kd_provinsi;
                                $scope.h.provice_name = jsondata.nm_provinsi;
                                $scope.$apply();
                            });
                        break;
                    case 'city':
                        SfLookup("<?php echo e(url('trs_local_mst_kabupaten_lookup')); ?>?plant=" + $scope.f.plant +
                            "&provinsi=" + $scope.h.provice,
                            function(id, name, jsondata) {
                                $scope.h.city = jsondata.kd_kabupaten;
                                $scope.h.city_name = jsondata.nm_kabupaten;
                                $scope.$apply();
                            });
                        break;
                    case 'state':
                        SfLookup("<?php echo e(url('trs_local_mst_kecamatan_lookup')); ?>?plant=" + $scope.f.plant +
                            "&kabupaten=" + $scope.h.city,
                            function(id, name, jsondata) {
                                $scope.h.state = jsondata.kd_kecamatan;
                                $scope.h.state_name = jsondata.nm_kecamatan;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_hardware':
                        SfLookup("<?php echo e(url('trs_local_mst_hardware_lookup3')); ?>",
                            function(id, name, jsondata) {
                                var idx = $scope.d.indexOf(selector);
                                $scope.d[idx].kd_hardware = jsondata.kd_hardware;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('sys_syplant', $scope.h.plant);
            }

            $scope.addRow = function() {
                $scope.d.push({});
            }

            $scope.oDelrow = function(idx) {
                $scope.d.splice(idx, 1);
            }

            $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/sys/syplant/syplant_frm.blade.php ENDPATH**/ ?>