<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Search Page <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span>Search</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-8">
        <div class="input-group">
            <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()" placeholder="Search">
            <div class="input-group-btn">
                <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <hr>
        <div class="panel">
            <div class="panel-body">
                <div class="alert alert-warning" ng-show="list.length==0">
                    <i class="fa fa-warning fa-3x pull-left"></i>
                    <b>Sorry..!</b>
                    <br>
                    Nothing item can be found. Try again using another keyword.
                </div>
                <div ng-repeat="v in list">
                    <a ng-href="<?php echo e(url('/')); ?>/{{v.url}}">
                        <h4 class="text-success">{{$index+1}}. {{v.label}}</h4>
                        <p class="desc">
                            {{v.rel_parent.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.rel_parent.label!=null"></i>
                            {{v.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.label!=null"></i> {{v.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.label!=null"></i>  <b class="text-success">{{v.label}}</b> (Route : {{v.url}})
                        </p>
                    </a><hr>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams, SfService) {
    SfService.setUrl("<?php echo e(url('sys_system')); ?>");
    $scope.f = { trash: 0, q: "<?php echo e(@$request->search_keyword); ?>" };
    $scope.list = [];

    $scope.oSearch = function() {
        SfService.httpGet(SfService.getUrl('_src_result'), {
            f: $scope.f
        }, function(jdata) {
            $scope.list = jdata.data.data;
        });
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/system/utility/src_page.blade.php ENDPATH**/ ?>