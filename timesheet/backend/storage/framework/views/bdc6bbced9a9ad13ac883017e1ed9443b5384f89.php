<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Logger Report <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('toolbar'); ?>
    <style type="text/css">
        .scroll {
            max-height: 500px;
            overflow-x: hidden;
            overflow-y: scroll;
        }

    </style>
    <div class="row">
        
        <div class="col-sm-2">
            <label title='Instansi'>Instansi</label>
            <div class="input-group">
                <input type="text" ng-value="q.id_instansi + ' - ' + q.nm_instansi" class="form-control input-sm m-b-5"
                    placeholder="Choose Station ..." readonly required>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-sm m-b-5" type="button" ng-click="oLookup('id_instansi')"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <label title='Device'>Device</label>
            <div class="input-group">
                <input type="text" ng-value="q.kd_device + ' - ' + q.nm_device" class="form-control input-sm m-b-5"
                    placeholder="Device ..." readonly required>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-sm m-b-5" type="button" ng-click="oLookup('kd_device')"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <label title='Device'>Hardware</label>
            <div class="input-group">
                <input type="text" ng-value="q.id_hardware" class="form-control input-sm m-b-5" placeholder="Hardware ..."
                    readonly required>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-sm m-b-5" type="button" ng-click="oLookup('id_hardware')"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        
        <div class="col-sm-2">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-sm btn-success btn-block" ng-click="getData()">Load Data</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="div1" class="p-10">
        <h3 class="text-center text-uppercase m-t-25">Report Logger</h3>

        <div class="table-responsive">
            
            <table width="100%" class="table-condensed table-bordered" style="white-space: nowrap;">
                <tr>
                    <th width="4%">No</th>
                    <th width="4%">Type</th>
                    <th width="4%">ID Alat</th>
                    <th width="4%">ID wilayah</th>
                    <th width="4%">ID Area</th>
                    <th width="4%">ID Stasiun</th>
                    <th width="6%">Waktu Awal</th>
                    <th width="6%">Waktu Akhir</th>
                    <th width="4%">Kirim Otomatis</th>
                    <th width="4%">Memori Dipakai</th>
                    <th width="4%">Total Data</th>
                    <th width="4%">Interval</th>
                    <th width="4%">Level Saat Ini</th>
                    <th width="4%">Status Alarm</th>
                    <th width="4%">Level 4</th>
                    <th width="4%">Level 3</th>
                    <th width="4%">Level 2</th>
                    <th width="4%">Level 1</th>
                    <th width="4%">Alarm Rendah</th>
                    <th width="4%">Set Level Awal</th>
                    <th width="4%">Jumlah Sampel</th>
                    <th width="6%">Waktu Alat Kirim</th>
                    <th width="6%">Waktu Diterima</th>
                </tr>
                
                
                
                
                <tr ng-repeat="v in data">
                    <td width="4%">{{ $index + 1 }}</td>
                    <td width="4%">{{ v . a }}</td>
                    <td width="4%">{{ v . b }}</td>
                    <td width="4%">{{ v . c }}</td>
                    <td width="4%">{{ v . d }}</td>
                    <td width="4%">{{ v . e }}</td>
                    <td width="6%">{{ v . f }}</td>
                    <td width="6%">{{ v . g }}</td>
                    <td width="4%">{{ v . h }}</td>
                    <td width="4%">{{ v . i }}</td>
                    <td width="4%">{{ v . j }}</td>
                    <td width="4%">{{ v . k }}</td>
                    <td width="4%">{{ v . l }}</td>
                    <td width="4%">{{ v . m }}</td>
                    <td width="4%">{{ v . n }}</td>
                    <td width="4%">{{ v . o }}</td>
                    <td width="4%">{{ v . p }}</td>
                    <td width="4%">{{ v . q }}</td>
                    <td width="4%">{{ v . r }}</td>
                    <td width="4%">{{ v . s }}</td>
                    <td width="4%">{{ v . t }}</td>
                    <td width="6%">{{ v . u }}</td>
                    <td width="6%">{{ v . v }}</td>
                </tr>
            </table>
            
        </div>
    </div>

    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_tr_data')); ?>");
            $scope.f = {
                plant: "<?php echo e(Session::get('plant')); ?>",
                id_instansi: '',
                nm_device: ''
            };

            $scope.date1 = jsDate("<?php echo e(date('Y-m-01')); ?>");
            $scope.date2 = jsDate("<?php echo e(date('Y-m-t')); ?>");
            $scope.q = [];
            $scope.data = [];

            $scope.getData = function() {
                SfService.get(SfService.getUrl('_rpt_data'), {
                    id_instansi: $scope.q.id_instansi,
                    nm_device: $scope.q.nm_device,
                    hardware: $scope.q.id_hardware,
                    date1: moment($scope.date1).format('YYYY-MM-DD'),
                    date2: moment($scope.date2).format('YYYY-MM-DD'),
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.data = jdata.data.data;
                });
            }

            // $scope.oLoadData = function(order_by) {
            //     $scope.tableList = new NgTableParams({}, {
            //         getData: function($defer, params) {
            //             var $btn = $('button').button('loading');
            //             return $http.get(SfService.getUrl("_rpt_data"), {
            //                 params: {
            //                     page: $scope.tableList.page(),
            //                     limit: $scope.tableList.count(),
            //                     order_by: $scope.tableList.orderBy(),
            //                     id_instansi: $scope.q.id_instansi,
            //                     nm_device: $scope.q.nm_device,
            //                     hardware: $scope.q.id_hardware,
            //                     date1: moment($scope.date1).format('YYYY-MM-DD'),
            //                     date2: moment($scope.date2).format('YYYY-MM-DD'),
            //                     plant: $scope.f.plant
            //                 }
            //             }).then(function(jdata) {
            //                 $btn.button('reset');
            //                 $scope.tableList.total(jdata.data.data.total);
            //                 return jdata.data.data.data;
            //             }, function(error) {
            //                 $btn.button('reset');
            //                 swal('', error.data, 'error');
            //             });
            //         }
            //     });
            // }

            $scope.moment = function(dt) {
                moment.locale('id');
                return moment(dt);
            }

            $scope.oLookup = function(id, selector, obj) {
                switch (id) {
                    case 'id_hardware':
                        // SfService.get(SfService.getUrl('_lookup2'), {
                        //     nm_device: $scope.q.nm_device
                        // });
                        SfLookup("<?php echo e(url('trs_local_tr_data_lookup2')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.id_hardware = jsondata.ID_ALAT;
                                $scope.$apply();
                            });
                        break;
                    case 'id_instansi':
                        SfLookup("<?php echo e(url('trs_local_ms_instansi_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.id_instansi = jsondata.id_instansi;
                                $scope.q.nm_instansi = jsondata.nm_instansi;
                                $scope.$apply();
                            });
                        break;
                    case 'kd_device':
                        SfLookup("<?php echo e(url('trs_local_jn_device_lookup')); ?>?plant=" + $scope.f.plant,
                            function(id, name, jsondata) {
                                $scope.q.kd_device = jsondata.kd_device;
                                $scope.q.nm_device = jsondata.nm_device;
                                $scope.$apply();
                            });
                        break;
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorreport', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/trs/local/tr_data/tr_data_rpt.blade.php ENDPATH**/ ?>