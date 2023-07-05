<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Data Logger <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-success panel-expand">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <br>
            <div ng-show="f.tab=='list'">
                <div class="form-inline   m-b-15">
                    <label>Dari</label>
                    <input type="date" ng-model="q.date1" class="form-control input-sm">
                    <label>sd</label>
                    <input type="date" ng-model="q.date2" class="form-control input-sm">
                    <label>Tipe</label>
                    <select ng-model="q.so_type" class="form-control input-sm">
                        <option ng-repeat="v in ['INSTANSI','ALAT']" ng-value="v">{{ v }}</option>
                    </select>
                    <div class="input-group">
                        <input type="text" ng-value="h.id_instansi+' | '+h.nm_instansi" id="h_id_instansi"
                            class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm" type="button"
                                ng-click="oLookup('id_instansi','h_id_instansi')"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSearch()">Refresh</button>
                    <hr>
                </div>
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer">
                            <td title="'No'" filter="{rowid: 'text'}" sortable="'rowid'">{{ v . rowid }}</td>
                            <td title="'Type'" filter="{wkt_terima: 'text'}" sortable="'wkt_terima'">
                                {{ v . wkt_terima }}</td>
                            <td title="'ID Alat'" filter="{parameter: 'text'}" sortable="'parameter'">
                                {{ v . wkt_terima }}
                            </td>
                            <td title="'ID Wilayah'" filter="{validasi: 'text'}" sortable="'validasi'">{{ v . validasi }}
                            </td>
                            <td title="'ID Area'" filter="{respons: 'text'}" sortable="'respons'">{{ v . validasi }}</td>
                            <td title="'ID Stasiun'" filter="{protokol: 'text'}" sortable="'protokol'">{{ v . protokol }}
                            </td>
                            <td title="'Tanggal Awal'" filter="{sender: 'text'}" sortable="'sender'">{{ v . sender }}
                            </td>
                            <td title="'Tanggal Akhir'" filter="{server: 'text'}" sortable="'server'">{{ v . server }}
                            </td>
                            <td title="'Kirim Otomatis'" filter="{cksum: 'text'}" sortable="'cksum'">{{ v . cksum }}
                            </td>
                            <td title="'Memori Dipakai'" filter="{overwrite: 'text'}" sortable="'overwrite'">
                                {{ v . overwrite }}
                            </td>
                            <td title="'Total Data'" filter="{mig: 'text'}" sortable="'mig'">{{ v . mig }}</td>
                            <td title="'Interval'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}
                            </td>
                            <td title="'Level Saat Ini'" filter="{handler: 'text'}" sortable="'handler'">
                                {{ v . handler }}</td>
                            <td title="'Status Alarm'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}
                            </td>
                            <td title="'Level 4'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}</td>
                            <td title="'Level 3'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}</td>
                            <td title="'Level 2'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}</td>
                            <td title="'Level 1'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}</td>
                            <td title="'Alarm Rendah'" filter="{handler: 'text'}" sortable="'handler'">{{ v . handler }}
                            </td>
                            <td title="'Set Level Awal'" filter="{handler: 'text'}" sortable="'handler'">
                                {{ v . handler }}</td>
                            <td title="'Jumlah Sampel'" filter="{handler: 'text'}" sortable="'handler'">
                                {{ v . handler }}</td>
                            <td title="'Waktu Alat Kirim'" filter="{handler: 'text'}" sortable="'handler'">
                                {{ v . handler }}</td>
                            <td title="'Waktu Saat Diterima'" filter="{handler: 'text'}" sortable="'handler'">
                                {{ v . handler }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label title='rowid'>Rowid</label>
                            <input type="text" ng-model="h.rowid" id="h_rowid" class="form-control input-sm" readonly
                                maxlength="" ng-readonly="f.crud!='c' || true " placeholder="auto">
                            <label title='wkt_terima'>Wkt Terima</label>
                            <input type="text" ng-model="h.wkt_terima" id="h_wkt_terima" class="form-control input-sm"
                                maxlength="">
                            <label title='parameter'>Parameter</label>
                            <input type="text" ng-model="h.parameter" id="h_parameter" class="form-control input-sm"
                                maxlength="65535">
                            <label title='validasi'>Validasi</label>
                            <input type="text" ng-model="h.validasi" id="h_validasi" class="form-control input-sm"
                                maxlength="">
                        </div>
                        <div class="col-sm-4">
                            <label title='respons'>Respons</label>
                            <input type="text" ng-model="h.respons" id="h_respons" class="form-control input-sm"
                                maxlength="65535">
                            <label title='protokol'>Protokol</label>
                            <input type="text" ng-model="h.protokol" id="h_protokol" class="form-control input-sm"
                                maxlength="30">
                            <label title='sender'>Sender</label>
                            <input type="text" ng-model="h.sender" id="h_sender" class="form-control input-sm"
                                maxlength="20">
                            <label title='server'>Server</label>
                            <input type="text" ng-model="h.server" id="h_server" class="form-control input-sm"
                                maxlength="20">
                        </div>
                        <div class="col-sm-4">
                            <label title='cksum'>Cksum</label>
                            <input type="text" ng-model="h.cksum" id="h_cksum" class="form-control input-sm" maxlength="32">
                            <label title='overwrite'>Overwrite</label>
                            <input type="text" ng-model="h.overwrite" id="h_overwrite" class="form-control input-sm"
                                maxlength="">
                            <label title='mig'>Mig</label>
                            <input type="text" ng-model="h.mig" id="h_mig" class="form-control input-sm" maxlength="">
                            <label title='handler'>Handler</label>
                            <input type="text" ng-model="h.handler" id="h_handler" class="form-control input-sm"
                                maxlength="">
                        </div>
                    </div>
                    <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http,
            NgTableParams, SfService) {
            SfService.setUrl("<?php echo e(url('trs_local_tr_raw')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];



            $scope.oGallery = function() {
                SfGetMediaList('trs_local_tr_raw/' + $scope.h.rowid, function(jdata) {
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
                $scope.h.rowid = null;
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
                                // limit: $scope.tableList.count(),
                                limit: 100,
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
                    var id = $scope.h.rowid;
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
                    case 'id_instansi':
                        SfLookup("<?php echo e(url('trs_local_ms_instansi_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.h.id_instansi = id;
                                $scope.h.nm_instansi = name;
                                // $scope.h = jsondata;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('trs_local_tr_raw', $scope.h.rowid);
            }

            // $scope.oSearch();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin_minifiedx', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/syweb/logger.blade.php ENDPATH**/ ?>