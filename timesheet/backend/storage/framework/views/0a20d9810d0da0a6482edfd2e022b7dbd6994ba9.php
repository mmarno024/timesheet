<?php $__env->startSection('title'); ?>Blank <?php $__env->stopSection(); ?>
<?php $__env->startSection('title-small'); ?>Pre Build <?php $__env->stopSection(); ?>
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
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-purple">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
                    <div class="stats-title">APP NAME</div>
                    <div class="stats-number"><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-desc">Elite Development</div>
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
    </div>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\palu\palu1\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>