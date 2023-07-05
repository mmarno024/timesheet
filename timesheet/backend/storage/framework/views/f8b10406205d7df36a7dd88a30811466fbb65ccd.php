<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title><?php echo e(\App\Sf::getParsys('APP_WEB_COMPANY_NAME')); ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="<?php echo e(url('coloradmin')); ?>/assets/img/fav.png">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css"
        rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/style.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('coloradmin')); ?>/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <div class="login-cover">
        <div class="login-cover-image"><img src="<?php echo e(url('coloradmin')); ?>/assets/img/photos/2.jpg"
                data-id="login-cover-image" alt="" />
        </div>
        <div class="login-cover-bg"></div>
    </div>
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <img src="<?php echo e(url('coloradmin')); ?>/assets/img/fav.png"></img>
                    <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

                    <small>Please enter your credential authentication bellow.</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form action="<?php echo e(url('/login')); ?>" method="POST" class="form-material mb-1">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="direct" value="<?php echo e($direct); ?>">
                    <div class="form-group m-b-20">
                        <input type="text" name="userid" class="form-control" placeholder="User ID" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="checkbox m-b-20">
                        <label>
                            <input type="checkbox" name="rememberme" checked="" value="1" /> Remember Me
                        </label>
                    </div>
                    <?php if (@$msg != ''): ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-warning fa-3x pull-left"></i>
                        <b>Failed!</b><br>
                        Your credential username or password didn't match.
                    </div>
                    <?php endif; ?>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-1.12.4.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-migrate-1.4.1.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
  <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/html5shiv.js"></script>
  <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/respond.min.js"></script>
  <script src="<?php echo e(url('coloradmin')); ?>/assets/crossbrowserjs/excanvas.min.js"></script>
 <![endif]-->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo e(url('coloradmin')); ?>/assets/js/login-v2.demo.min.js"></script>
    <script src="<?php echo e(url('coloradmin')); ?>/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            LoginV2.init();
        });

    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\kalsel\bpbd\admin\backend\resources\views/sys/system/sflogin.blade.php ENDPATH**/ ?>