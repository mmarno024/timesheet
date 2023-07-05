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

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneadmin')); ?>/assets/css/core.css">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <![endif]-->
</head>

<body class="img-cover" style="background-image: url(neptuneadmin/assets/img/photos-1/2.jpg);">

    <div class="container-fluid">
        <div class="sign-form">
            <div class="row">
                <div class="col-md-4 offset-md-4 px-3">
                    <div class="box b-a-10" style="padding:10px;">
                        <div class="p-2 text-xs-center">
                            <h5>Welcome to <?php echo e(\App\Sf::getParsys('APP_WEB_COMPANY_NAME')); ?></h5>
                            <small>Please enter your credential authentication bellow.</small>
                        </div>
                        <form action="<?php echo e(url('/login')); ?>" method="POST" class="form-material mb-1">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="direct" value="<?php echo e($direct); ?>">
                            <div class="form-group">
                                <input type="text" name="userid" class="form-control" placeholder="User ID" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" />
                            </div>
                            <div class="checkbox m-b-30" style="margin:10px 0 0 10px;">
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
                            <div class="px-2 form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block text-uppercase">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS -->
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/jquery/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneadmin')); ?>/assets/vendor/bootstrap4/js/bootstrap.min.js">
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/sys/system/sflogin.blade.php ENDPATH**/ ?>