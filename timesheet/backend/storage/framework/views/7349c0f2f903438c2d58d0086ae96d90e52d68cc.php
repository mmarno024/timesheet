<!-- Header -->
<div class="site-header">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            <a class="navbar-brand" href="#">
                <div class="logo"></div>
            </a>
            <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                <span class="hamburger"></span>
            </div>
            <div class="toggle-button-second dark float-xs-right hidden-md-up">
                <i class="ti-arrow-left"></i>
            </div>
            <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse"
                data-target="#collapse-1">
                <span class="more"></span>
            </div>
        </div>
        <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1" style="background:#212330;">
            <ul class="nav navbar-nav float-md-right">
                <li class="nav-item dropdown hidden-sm-down">
                    <div class="buttons">
                        <a href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>"
                            class="btn btn-danger btn-md"><?php echo e(\Auth::check() ? 'Admininistrator' : 'Sign in'); ?></a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item hidden-sm-down">
                    <a class="nav-link toggle-fullscreen" href="#">
                        <b style="color:greenyellow">UPDK BANDAR LAMPUNG</b>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/common/neptuneadmin/site_headerx.blade.php ENDPATH**/ ?>