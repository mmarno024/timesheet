<div id="header" class="header navbar navbar-default navbar-fixed-topxxx">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="<?php echo e(url('home')); ?>" class="navbar-brand"><span class="navbar-logo"></span>
                <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></a>
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
            
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo e(Auth::check() && Auth::user()->url_img != null ? \App\Sf::fileFtpUrl(Auth::user()->url_img) : url('coloradmin/assets/img/user-13.jpg')); ?>"
                        onerror="this.src='<?php echo e(url('coloradmin/assets/img/ionic.png')); ?>'" />
                    <span
                        class="hidden-xs"><?php echo e(ucwords(strtolower(Auth::check() ? Auth::user()->username : 'Guest'))); ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="<?php echo e(url('sys_system_profile')); ?>">Edit Profile</a></li>
                    <li><a href="<?php echo e(url('sys_system_change_plant')); ?>">Switch Plant</a></li>
                    <li><a href="#"
                            onclick="SfSetUserAttr('default_menu','<?php echo e(str_replace(url('/'), '', Request::fullUrl())); ?>');">Set
                            as Default Menu</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(url('sys_symsgh')); ?>">Inbox</a></li>
                    <li><a href="<?php echo e(url('sys_sycalendar')); ?>">Calendar</a></li>
                    <li><a href="<?php echo e(url('sys_system_personal_file')); ?>">Files</a></li>
                    <li><a href="<?php echo e(url('sys_syguide')); ?>">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(url('/')); ?>">Website</a></li>
                    <li class="divider"></li>
                    <li class="hidden"><a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                            Out</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                    <li><a href="<?php echo e(url('sflogout')); ?>">Log Out</a></li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/common/coloradmin/nav_topx.blade.php ENDPATH**/ ?>