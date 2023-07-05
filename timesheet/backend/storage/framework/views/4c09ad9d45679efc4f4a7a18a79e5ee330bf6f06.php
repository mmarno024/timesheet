<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script>
        var SfBaseUrl = "<?php echo e(url('/')); ?>";

    </script>
    <link rel="shortcut icon" href="<?php echo e(url('neptuneparalax')); ?>/assets/img/fav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-4.3.1/themes/flatly/bootstrap.css"
        media="screen">
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/overide.css?ver=2019.01.13" rel="stylesheet" id="theme" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/animate.min.css" rel="stylesheet" />
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <!-- <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-4.3.1/popper.js/dist/umd/popper.min.js"></script> -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-cookies.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-route.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-sanitize.js"></script>
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.css" rel="stylesheet" />
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.tpl.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="<?php echo e(url('/js/apps/dynamic-number.min.js?ver=2019.06.12')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sfAngular.js?ver=2019.07.08')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sf.js?ver=2019.03.12')); ?>"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-file-upload/angular-file-upload.min.js"></script>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body ng-app="sfApp" ng-controller="topCtrl" id="topCtrl">
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#"><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <?php echo $__env->yieldContent('nav-menu'); ?>
            </ul>
            <?php echo $__env->yieldContent('nav-right'); ?>
        </div>
    </nav>
    <div ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl" class="content">
        <div class="container-fluid"><?php echo $__env->yieldContent('content'); ?></div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/b4_flatly.blade.php ENDPATH**/ ?>