<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(url('neptuneparalax')); ?>/assets/img/fav.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script>
        var SfBaseUrl = "<?php echo e(url('/')); ?>";

    </script>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css"
        rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/overide.css?ver=2018.09.13" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN JQUERY JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/sweetalert2/sweetalert2.js"></script>
    <!-- ================== BEGIN JQUERY JS ================== -->

    <!-- ================== BEGIN ANGULAR JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-cookies.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-route.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/angular-sanitize.js"></script>
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.css" rel="stylesheet" />
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.tpl.min.js"></script>
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/summernote/summernote.css" rel="stylesheet" />
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/summernote/summernote.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/summernote/angular-summernote.min.js"></script>
    <script src="<?php echo e(url('/js/apps/dynamic-number.min.js?ver=2019.06.12')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sfAngular.js?ver=2019.07.08')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sf.js?ver=2018.12.03')); ?>"></script>
    <!-- ================== END ANGULAR JS ================== -->

    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-file-upload/angular-file-upload.min.js"></script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body ng-app="sfApp" ng-controller="topCtrl" id="topCtrl">
    <div ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl">
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <div id="page-container" class="page-container fade page-without-sidebar page-header-fixedxxx">
            <div><?php echo $__env->yieldContent('content'); ?> </div>
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
                data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        </div>
    </div>
    <!-- ================== BEGIN BASE JS ================== -->
    <!--[if lt IE 9]>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/html5shiv.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/respond.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/excanvas.min.js"></script>
  <![endif]-->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/flot/jquery.flot.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/colorreport_blank.blade.php ENDPATH**/ ?>