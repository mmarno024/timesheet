<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-primary">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/home.blade.php ENDPATH**/ ?>