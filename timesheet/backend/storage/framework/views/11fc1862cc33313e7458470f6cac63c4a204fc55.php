<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title>Neptune</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/morris/morris.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css">

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/css/core.css">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <![endif]-->
</head>

<body class="fixed-sidebar fixed-header skin-default content-appear" ng-app="sfApp" ng-controller="topCtrl"
    id="topCtrl">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>
        
        <?php $__env->startComponent('layouts.common.neptuneadmin.sidebar'); ?> <?php echo $__env->renderComponent(); ?>
        
        <?php $__env->startComponent('layouts.common.neptuneadmin.site_header'); ?> <?php echo $__env->renderComponent(); ?>

        <div ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl" class="site-content">
            <!-- Content -->
            <div class="content-area py-1">
                <div class="container-fluid">
                    <div class="row row-md">
                        <div class="col-sm-6" style="margin-bottom: 10px;">
                            <h4>Dasboard</h4>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 10px;text-align:right"> Home / <?php echo $__env->yieldContent('title'); ?> /
                            <?php echo $__env->yieldContent('breadcrumb'); ?></div>
                    </div>
                    <div class="box box-block bg-white b-t-0 mb-2" style="min-height:460px;">
                        <div>
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-xs-center">
                        <div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
                            2021 © Tatonas
                        </div>
                        <div class="col-sm-8 text-sm-right">
                            <ul class="nav nav-inline l-h-2">
                                <li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <!-- Vendor JS -->
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jquery/jquery-1.12.3.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap4/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.mousewheel.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/mwheelIntent.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/waves/waves.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/switchery/dist/switchery.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot/jquery.flot.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot/jquery.flot.resize.min.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/CurvedLines/curvedLines.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/TinyColor/tinycolor.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/sparkline/jquery.sparkline.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/raphael/raphael.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/morris/morris.min.js"></script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script type="text/javascript"
        src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/peity/jquery.peity.js"></script>

    <!-- Neptune JS -->
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/js/demo.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/js/index.js"></script>

    <!-- ================== BEGIN ANGULAR JS ================== -->
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/angular.min.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/angular-cookies.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/angular-route.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/angular-sanitize.js"></script>
    <link href="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.css" rel="stylesheet" />
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular/ng-table/ng-table.min.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/moment/moment-with-locales.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular-strap/angular-strap.min.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular-strap/angular-strap.tpl.min.js"></script>
    <link href="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/summernote/summernote.css" rel="stylesheet" />
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/summernote/summernote.js"></script>
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/summernote/angular-summernote.min.js"></script>
    <script src="<?php echo e(url('/js/apps/dynamic-number.min.js?ver=2019.06.12')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sfAngular.js?ver=2020.05.08')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sf.js?ver=2019.03.12')); ?>"></script>
    <!-- ================== END ANGULAR JS ================== -->

    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/angular-file-upload/angular-file-upload.min.js"></script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('neptuneadmin')); ?>/assets/plugins/pace/pace.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/layouts/neptuneadmin.blade.php ENDPATH**/ ?>