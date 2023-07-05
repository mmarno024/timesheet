<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
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
<body class="pace-top bg-white">

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo e(url('coloradmin')); ?>/assets/img/login-bg/bg-10.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> <?php echo e(\App\Sf::getParsys('APP_WEB_COMPANY_NAME')); ?></h4>
                    <p>
                        <?php echo e(\App\Sf::getParsys('APP_WEB_ADDR')); ?>

                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

                        <small>Please enter your credential authentication bellow.</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form action="<?php echo e(url('/login')); ?>" method="POST" class="margin-bottom-0">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="direct" value="<?php echo e($direct); ?>">
                        <div class="form-group m-b-15">
                            <input type="text" name="userid" class="form-control input-lg" placeholder="User ID" />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" class="form-control input-lg" placeholder="Password" />
                        </div>
                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" name="rememberme" checked="" value="1" /> Remember Me
                            </label>
                        </div>

                        <?php if (@$msg != ""): ?>
                            <div class="alert alert-danger">
                                <i class="fa fa-warning fa-3x pull-left"></i>
                                <b>Failed!</b><br>
                                Your credential username or password didn't match.
                            </div>
                        <?php endif?>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Not a member yet? Click <a href="#" class="text-success">here</a> to register
                            <br>or back to <a href="<?php echo e(url('/')); ?>" class="text-success"> web page</a>
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Itdsn WP - Temanggung 2015
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
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
	<script src="<?php echo e(url('coloradmin')); ?>/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
    <script type="text/javascript">
        window.setTimeout(function () {
            window.location.reload();
        }, 5 * 60 * 1000);
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\me\smart\smart_back\resources\views/sys/system/sflogin.blade.php ENDPATH**/ ?>