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
    <title>Tatonas</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/chartist/chartist.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet"
        href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">

    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/morris/morris.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css">

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/css/core.css">
    <link rel="shortcut icon" href="<?php echo e(url('neptuneparalax')); ?>/assets/img/fav.png">

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
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/moment/moment-with-locales.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-strap/angular-strap.tpl.min.js"></script>
    
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/summernote/angular-summernote.min.js"></script>
    <script src="<?php echo e(url('/js/apps/dynamic-number.min.js?ver=2019.06.12')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sfAngular.js?ver=2020.05.08')); ?>"></script>
    <script src="<?php echo e(url('/js/apps/sf.js?ver=2019.03.12')); ?>"></script>
    <!-- ================== END ANGULAR JS ================== -->

    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/angular-file-upload/angular-file-upload.min.js"></script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <![endif]-->
</head>

<body class="skin-default  pace-done compact-sidebar" ng-app="sfApp" ng-controller="topCtrl" id="topCtrl">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>
        <?php $__env->startComponent('layouts.common.neptuneadmin.site_headerx'); ?> <?php echo $__env->renderComponent(); ?>

        <div ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl" class="site-content" style="margin-left:0px;">
            <!-- Content -->
            <div class="content-area py-1">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- Footer -->
                
            </div>

        </div>

        <!-- Vendor JS -->
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jquery/jquery-1.12.3.min.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/tether/js/tether.min.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap4/js/bootstrap.min.js">
        </script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.mousewheel.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/mwheelIntent.js">
        </script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/switchery/dist/switchery.min.js">
        </script>

        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/waves/waves.min.js"></script>

        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/chartist/chartist.min.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/switchery/dist/switchery.min.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/select2/dist/js/select2.min.js">
        </script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
        </script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/multi-select/js/jquery.multi-select.js"></script>

        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot/jquery.flot.min.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot/jquery.flot.resize.min.js">
        </script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/CurvedLines/curvedLines.js">
        </script>
        <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/TinyColor/tinycolor.js"></script>
        <script type="text/javascript"
            src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/sparkline/jquery.sparkline.min.js">
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
        
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/neptunefront.blade.php ENDPATH**/ ?>