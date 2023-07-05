<?php $__env->startSection('content'); ?>
    <!-- begin #home -->
    <div class="col-md-8 offset-md-2">
        <div class="h-title"><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></div>
        <div class="h-text"><?php echo e(\App\Sf::getParsys('APP_WEB_COMPANY_NAME')); ?></div>
        <div class="h-buttons">
            <a href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>"
                class="btn btn-danger btn-rounded btn-lg"><?php echo e(\Auth::check() ? 'ADMIN PAGE' : 'SIGN IN'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.neptuneparalax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/sys/syweb/home.blade.php ENDPATH**/ ?>