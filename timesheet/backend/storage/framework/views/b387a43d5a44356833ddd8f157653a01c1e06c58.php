<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(url('neptuneparalax')); ?>/assets/img/fav.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/css/style.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('colorparalax')); ?>/assets/css/theme/default.css" id="theme" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body data-spy="scroll" data-target="#header-navbar" data-offset="51"
    onkeypress="return disableCtrlKeyCombination(event);" onkeydown="return disableCtrlKeyCombination(event);">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand">
                        <span class="brand-logo"></span>
                        <span class="brand-text">
                            <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

                        </span>
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo e(url('/sys_syweb_page?q=home')); ?>">HOME</a></li>
                        <li><a href="<?php echo e(url('/sys_syweb_page?q=about')); ?>">ABOUT</a></li>
                        <li><a href="<?php echo e(url('/sys_syweb_page?q=gallery')); ?>">GALLERY</a></li>
                        <li><a href="<?php echo e(url('/sys_syweb_page?q=team')); ?>">TEAM</a></li>
                        <li><a href="<?php echo e(url('/sys_syweb_page?q=contact')); ?>">CONTACT</a></li>
                        <li><a
                                href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>"><?php echo e(\Auth::check() ? 'ADMIN PAGE' : 'SIGN IN'); ?></a>
                        </li>
                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- begin #footer -->
        <div id="footer" class="footer">
            <div class="container">
                <div class="footer-brand">
                    <div class="footer-brand-logo"></div>
                    <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

                </div>
                <p>
                    &copy; Copyright Color Admin <?php echo e(date('Y')); ?> <br />
                    <?php echo e(\App\Sf::getParsys('APP_DESC')); ?>. Created by <a href="mailto:it.wp@dsngroup.co.id">IT
                        DSNWP</a>
                </p>
                <p class="social-list">
                    <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-fw"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                    <a href="#"><i class="fa fa-google-plus fa-fw"></i></a>
                    <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                </p>
            </div>
        </div>
        <!-- end #footer -->

        <!-- begin theme-panel -->
        <div class="theme-panel hidden">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i
                    class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Blue">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default"
                            data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end theme-panel -->
    </div>
    <!-- end #page-container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/jquery/jquery-1.12.4.min.js"></script>
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/jquery/jquery-migrate-1.4.1.min.js"></script>
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
  <script src="<?php echo e(url('colorparalax')); ?>/assets/crossbrowserjs/html5shiv.js"></script>
  <script src="<?php echo e(url('colorparalax')); ?>/assets/crossbrowserjs/respond.min.js"></script>
  <script src="<?php echo e(url('colorparalax')); ?>/assets/crossbrowserjs/excanvas.min.js"></script>
 <![endif]-->
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="<?php echo e(url('colorparalax')); ?>/assets/plugins/scrollMonitor/scrollMonitor.js"></script>
    <script src="<?php echo e(url('colorparalax')); ?>/assets/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        // =======================================================================================
        var message = "Sorry, right-click has been disabled";
        /////////////////////////////////// 
        function clickIE() {
            if (document.all) {
                (message);
                return false;
            }
        }

        function clickNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    (message);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = clickNS;
        } else {
            document.onmouseup = clickNS;
            document.oncontextmenu = clickIE;
        }
        document.oncontextmenu = new Function("return false")

        function disableCtrlKeyCombination(e) {
            //List of keys
            var forbiddenKeys = new Array('u', 's');
            var key;
            var isCtrl;
            if (window.event) {
                key = window.event.keyCode; //IE
                if (window.event.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            } else {
                key = e.which; //firefox
                if (e.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            }
            //if ctrl is pressed check if other key is in forbidenKeys array
            if (isCtrl) {
                for (i = 0; i < forbiddenKeys.length; i++) {
                    //case-insensitive comparation
                    if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
                        //alert('Key combination CTRL + '+String.fromCharCode(key) +' has been disabled.');
                        return false;
                    }
                }
            }
            return true;
        }

        // =======================================================================================
        $(document).ready(function() {
            App.init();
        });

    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\backend\resources\views/layouts/colorparalax.blade.php ENDPATH**/ ?>