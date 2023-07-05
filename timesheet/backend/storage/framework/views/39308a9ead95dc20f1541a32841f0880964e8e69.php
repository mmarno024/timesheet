<?php $__env->startSection('title'); ?>Dashboard <?php $__env->stopSection(); ?>
<?php $__env->startSection('title-small'); ?>Sample <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Test Page</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/sparkline/jquery.sparkline.js"></script>
    <div class="">
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                    <div class="stats-title">USER ID</div>
                    <div class="stats-number"><?php echo e(Auth::user()->userid); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div class="stats-desc"><?php echo e(Auth::user()->username); ?></div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-inbox fa-fw"></i></div>
                    <div class="stats-title">MESSAGE INBOX</div>
                    <div class="stats-number">0</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 40.5%;"></div>
                    </div>
                    <div class="stats-desc">More Message</div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-purple">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
                    <div class="stats-title">APP NAME</div>
                    <div class="stats-number"><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-desc">Elite Develoment</div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-black">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-trophy fa-fw"></i></div>
                    <div class="stats-title">STATUS</div>
                    <div class="stats-number"><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 54.9%;"></div>
                    </div>
                    <div class="stats-desc">Logged in</div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload" ng-click="oTodaystaskdata()"><i class="fa fa-repeat"></i></a>
                        </div>
                        <h4 class="panel-title">Todo List (Today)</h4>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning" ng-if="todo.length==null|| todo.length==[]">
                            Tidak ada tugas untuk {{ f . q_todo_name }} hari ini.
                        </div>
                        <div ng-repeat="v in todo">
                            <b class="text-success">{{ v . proj_name }}</b> :
                            <ul>
                                <li ng-repeat="va in v.rel_d3" class="pointer p-b-10" ng-click="oActivity(v,va);">
                                    <a href="javascript:void(0)">{{ va . plan_start }} to {{ va . plan_end }} : <i
                                            class="text-success">{{ va . activity }}</i> {{ va . note }}<b
                                            class="text-danger">{{ va . progress }}%</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?>
                        <h4 class="panel-title">Session</h4>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Auth::user()->username); ?>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Current Time</div>
                    <div class="panel-body">
                        <?php echo e(date('d F Y H:i')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('trs_local_nprojh')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                username: "<?php echo e(Auth::user()->username); ?>",
                plant: "<?php echo e(Session::get('plant')); ?>",
                cat: "<?php echo e(@$request->cat); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.todo = [];

            $scope.oTodaystaskdata = function() {
                SfService.get(SfService.getUrl('_todaystask'), {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant,
                    cat: '%'
                }, function(jdata) {
                    $scope.todo = jdata.data.data;
                });
            }

            $scope.oActivity = function(v, va) {
                window.location.href = "<?php echo e(url('trs_local_nprojactv')); ?>?cat=" + v.cat + "&todo=" + va
                    .id;
            }

            $scope.oTodaystaskdata();

        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>