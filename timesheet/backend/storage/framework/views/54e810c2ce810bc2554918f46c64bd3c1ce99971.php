<div id="header" class="header navbar navbar-default navbar-fixed-topxxx" style="background:#2d353c;">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="<?php echo e(url('home')); ?>" class="navbar-brand">
                <img src="<?php echo e(url('coloradmin')); ?>/assets/img/logo.png" alt="">
            </a>
            <a style="height:100%;width:600px;" class="navbar-brand">
                <table border="0" cellspacing="">
                    <tr>
                        <td style="font-weight:bold;color:greenyellow;font-size:17px;line-height:1">
                            <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></td>
                    </tr>
                    <tr>
                        <td style="color:white;font-size:12px;line-height:1">
                            <?php echo e(\App\Sf::getParsys('APP_WEB_ADDR')); ?></td>
                    </tr>
                </table>
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="top-navbar">
            <ul class="nav navbar-nav">
                <li class="hidden"><a href="javascript:;" data-click="sidebar-minify" style="padding-bottom: 0px"><i
                            class="fa fa-bars fa-2x"></i></a></li>
            </ul>
        </div>
        <!-- end mobile sidebar expand / collapse button -->
        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown p-10">
                <span>
                    <a href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>"
                        class="btn btn-sm btn-inverse"><?php echo e(\Auth::check() ? 'Admininistrator' : 'Sign in'); ?></a>
                </span>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<?php /**PATH D:\Xampp\htdocs\besai\backend\resources\views/layouts/common/coloradmin/nav_top_front.blade.php ENDPATH**/ ?>