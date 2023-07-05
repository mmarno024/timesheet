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
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/ionicons/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="<?php echo e(url('neptuneparalax')); ?>/assets/css/core.css">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <![endif]-->
</head>

<body>

    <div class="frontend-wrapper bg-white">

        <div class="header text-xs-center img-cover"
            style="background-image: url(neptuneparalax/assets/img/photos-1/4.jpg);">
            <div class="gradient gradient-warning"></div>
            <div class="h-content">
                <div class="clearfix">
                    <div class="h-logo float-xs-left"><a class="text-white" href="#">Logo</a></div>
                    <div class="h-menu float-xs-right">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a class="text-white"
                                    href="<?php echo e(url('/sys_syweb_page?q=home')); ?>">Home</a></li>
                            <li class="list-inline-item"><a class="text-white"
                                    href="<?php echo e(url('/sys_syweb_page?q=logger')); ?>">Logger</a></li>
                            <li class="list-inline-item"><a class="text-white"
                                    href="<?php echo e(url('/sys_syweb_page?q=about')); ?>">About</a></li>
                            <li class="list-inline-item"><a class="text-white"
                                    href="<?php echo e(url('/sys_syweb_page?q=contact')); ?>">Contacts</a></li>
                            <li class="list-inline-item"><a class="text-white"
                                    href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>"><?php echo e(\Auth::check() ? 'Admin Page' : 'SIGN IN'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                <div class="h-down">
                    <a class="text-white" href="#">
                        <i class="ti-angle-double-down"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="block-2 bg-danger">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="b-item">
                                    <div class="bi-icon"><i class="ti-pulse"></i></div>
                                    <div class="bi-title">Lorem ipsum dolor</div>
                                    <div class="bi-text">Sed diam sem, imperdiet at mollis vestibulum, bibendum id
                                        purus. Aliquam molestie</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="b-item">
                                    <div class="bi-icon"><i class="ti-palette"></i></div>
                                    <div class="bi-title">Lorem ipsum dolor</div>
                                    <div class="bi-text">Sed diam sem, imperdiet at mollis vestibulum, bibendum id
                                        purus. Aliquam molestie</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="b-item">
                                    <div class="bi-icon"><i class="ti-location-arrow"></i></div>
                                    <div class="bi-title">Lorem ipsum dolor</div>
                                    <div class="bi-text">Sed diam sem, imperdiet at mollis vestibulum, bibendum id
                                        purus. Aliquam molestie</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="b-item">
                                    <div class="bi-icon"><i class="ti-music-alt"></i></div>
                                    <div class="bi-title">Lorem ipsum dolor</div>
                                    <div class="bi-text">Sed diam sem, imperdiet at mollis vestibulum, bibendum id
                                        purus. Aliquam molestie</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block-4 bg-waarning">
            <div class="container-fluid">
                <div class="mb-2">
                    © 2021 Tatonas
                    <br> Created by <a href="#" class="text-danger"><span class="underline">IT & RnD</span></a>
                </div>
                <div class="b-to-top"><i class="ti-angle-double-up"></i></div>
            </div>
        </div>

    </div>

    <!-- Vendor JS -->
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/jquery/jquery-1.12.3.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/bootstrap4/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/waves/waves.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBvUrUti-n6JiOxxR0rGFAaCKVIiGimqx0"></script>
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/vendor/gmaps/gmaps.min.js"></script>

    <!-- Neptune JS -->
    <script type="text/javascript" src="<?php echo e(url('neptuneparalax')); ?>/assets/js/frontend.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/layouts/neptuneparalax.blade.php ENDPATH**/ ?>