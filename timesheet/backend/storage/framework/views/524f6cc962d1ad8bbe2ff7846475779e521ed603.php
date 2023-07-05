<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?> <?php echo e($syuser == false ? '' : ucwords(strtolower($syuser->username))); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div>
        <ul class="nav nav-pills">
            <li class="nav-items active"><a href="#tab-1" data-toggle="tab">About</a></li>
            <li class="nav-items"><a href="#tab-2" data-toggle="tab">Gallery</a></li>
            <li class="nav-items"><a href="#tab-3" data-toggle="tab">Log</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab-1">
                <div class="row">
                    <div class="col-sm-9">
                        <h3>Personal Data</h3>
                        <table class="table">
                            <tr>
                                <td width="30%">User ID</td>
                                <td width="1%">:</td>
                                <td>{{ h . userid }}</td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td>:</td>
                                <td>{{ h . username }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>{{ h . address }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ h . email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>{{ h . phone }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>:</td>
                                <td>{{ h . gender }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-3">
                        <h3>Photo</h3>
                        <div class="thumbnail">
                            <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . url_img }}">
                        </div>
                        <h3>Signature</h3>
                        <div class="thumbnail">
                            <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . url_sign }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in" id="tab-2">
                <div class="row">
                    <div class="col-sm-3" ng-repeat="v in m">
                        <div class="thumbnail">
                            <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ v . name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in" id="tab-3">
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed "
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="">
                            <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{ v . id }}</td>
                            <td title="'Trs'" filter="{trs: 'text'}" sortable="'trs'">{{ v . trs }}</td>
                            <td title="'Doc No'" filter="{doc_no: 'text'}" sortable="'doc_no'">{{ v . doc_no }}</td>
                            <td title="'User'" filter="{created_by: 'text'}" sortable="'created_by'">
                                {{ v . created_by }} -
                                {{ v . rel_created_by . username }}</td>
                            <td title="'Activity'" filter="{activity: 'text'}" sortable="'activity'">{{ v . activity }}
                            </td>
                            <td title="'Tag'" filter="{tag: 'text'}" sortable="'tag'">{{ v . tag }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('sys_syuser')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0
            };
            $scope.h = {};
            $scope.m = [];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            $scope.oGallery = function() {
                SfGetMediaList('sys_syuser/' + $scope.h.userid, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oSearchLog = function(trash, order_by) {
                $scope.f.tab = "list";
                $scope.f.trash = trash;
                $scope.tableList = new NgTableParams({}, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get("<?php echo e(url('sys_sylog_list')); ?>", {
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

            $scope.oShow = function(id) {
                SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
                    $scope.h = jdata.data.h;
                    $scope.oGallery();
                    $scope.oSearchLog();
                });
            }

            $scope.oShow("<?php echo e($syuser->userid); ?>");
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/sys/syuser/syuser_profile.blade.php ENDPATH**/ ?>