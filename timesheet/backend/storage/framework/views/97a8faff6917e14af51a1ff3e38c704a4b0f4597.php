<div id="header" class="header navbar navbar-default navbar-fixed-topxxx">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="<?php echo e(url('home')); ?>" class="navbar-brand" style="font-size:10px">
                <img src="<?php echo e(url('coloradmin')); ?>/assets/img/logo.png"></img>
            </a>
            <a style="height:100%;font-weight:bold;color:#00acac;width:300px;"
                class="navbar-brand"><?php echo e(\App\Sf::getParsys('APP_LABEL')); ?></a>
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
            <li>
                <form class="navbar-form full-width" action="<?php echo e(url('src')); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter keyword" name="search_keyword" />
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell-o"></i>
                    <span class="label">{{ notif . length }}</span>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                    <li class="dropdown-header">Notifications ({{ notif . length }})</li>
                    <li class="media" ng-repeat="v in notif">
                        <a ng-href="{{ v . url }}">
                            <div class="media-left"><i ng-class="v.icon" class="media-object"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading"> {{ v . subj }}</h6>
                                <p>{{ v . body }}</p>
                                <div class="text-muted f-s-11">{{ v . note }}</div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-footer text-center">
                        <a href="<?php echo e(url('sys_symsgh')); ?>">View more</a>
                    </li>
                </ul>
            </li>
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
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/common/coloradmin/nav_top.blade.php ENDPATH**/ ?>