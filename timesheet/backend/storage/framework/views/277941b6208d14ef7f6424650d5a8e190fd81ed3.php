<!-- Header -->
<div class="site-header">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            <a class="navbar-brand" href="index.html">
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
        <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
            <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
                <span class="hamburger"></span>
            </div>
            <ul class="nav navbar-nav float-md-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="ti-email"></i>
                        <span class="hidden-md-up ml-1">Notifications</span>
                        <span class="tag tag-danger top">12</span>
                    </a>
                    <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp">
                        <div class="m-item">
                            <div class="mi-icon bg-info"><i class="ti-comment"></i></div>
                            <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span
                                    class="text-muted">commented post</span> <a class="text-black" href="#">Lorem ipsum
                                    dolor</a></div>
                            <div class="mi-time">5 min ago</div>
                        </div>
                        <div class="m-item">
                            <div class="mi-icon bg-danger"><i class="ti-heart"></i></div>
                            <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span
                                    class="text-muted">liked post</span> <a class="text-black" href="#">Lorem
                                    ipsum dolor</a></div>
                            <div class="mi-time">15:07</div>
                        </div>
                        <a class="dropdown-more" href="#">
                            <strong>View all notifications</strong>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown hidden-sm-down">
                    <a href="#" data-toggle="dropdown" aria-expanded="false">
                        <span class="avatar box-32">
                            <img src="<?php echo e(url('neptuneadmin')); ?>/assets/img/avatars/1.jpg" alt="">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                        <a class="dropdown-item" href="#">
                            <i class="ti-email mr-0-5"></i> Inbox
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="ti-user mr-0-5"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="ti-settings mr-0-5"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="ti-help mr-0-5"></i> Help</a>
                        <a class="dropdown-item" href="<?php echo e(url('sflogout')); ?>"><i class="ti-power-off mr-0-5"></i> Sign
                            out</a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item hidden-sm-down">
                    <a class="nav-link toggle-fullscreen" href="#">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <div class="header-form float-md-left ml-md-2">
                <form>
                    <input type="text" class="form-control b-a" placeholder="Search for...">
                    <button type="submit" class="btn bg-white b-a-0">
                        <i class="ti-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/layouts/common/neptuneadmin/site_header.blade.php ENDPATH**/ ?>