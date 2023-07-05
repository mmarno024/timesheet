<?php $__env->startSection('content'); ?>
<!-- begin #home -->
<div id="home" class="content has-bg home">
    <div class="content-bg">
        <img src="<?php echo e(url('colorparalax')); ?>/assets/img/home-bg.jpg" alt="Home" />
    </div>
        <div class="container home-content">
            <h1><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></h1>
            <h3><?php echo e(\App\Sf::getParsys('APP_WEB_COMPANY_NAME')); ?></h3>
            <p><?php echo e(\App\Sf::getParsys('APP_WEB_HOME_HTML')); ?></p>
            <a href="<?php echo e(\Auth::check()?url('home'):url('login')); ?>" class="btn btn-theme"><?php echo e(\Auth::check()?'ADMIN PAGE':'SIGN IN'); ?></a><br />
            <br />
            or <a href="#">subscribe</a> newsletter
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.colorparalax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/syweb/home.blade.php ENDPATH**/ ?>