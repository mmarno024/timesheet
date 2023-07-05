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
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                    <div class="stats-title">USER</div>
                    <div class="stats-number"><?php echo e(Auth::user()->userid); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div class="stats-desc"><?php echo e(Auth::user()->username); ?></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-home fa-fw"></i></div>
                    <div class="stats-title">PROJECT</div>
                    <div class="stats-number"><?php echo e(Auth::user()->def_plant); ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-desc"><?php echo e(\App\Sf::getPlantname(Auth::user()->def_plant)); ?></div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
    </div>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\a_data\monitoring_back\backend\resources\views/sys/system/sfhome.blade.php ENDPATH**/ ?>