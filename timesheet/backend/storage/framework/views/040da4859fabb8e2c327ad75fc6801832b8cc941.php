<div id="header" class="header navbar navbar-default navbar-fixed-topxxx" style="background:#2d353c;">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="<?php echo e(url('/')); ?>" class="navbar-brand">
                
                <?php
                use App\Model\Sys\Syplant;
                $plant = Auth::user() == '' ? null : Auth::user()->def_plant;
                $cek_img = $plant != null ? Syplant::find($plant) : null;
                ?>
                <img src="<?php echo e($cek_img != null ? \App\Sf::fileFtpUrl($cek_img->image) : url('coloradmin/assets/img/logo.png')); ?>"
                    onerror="this.src='<?php echo e(url('coloradmin/assets/img/logo.png')); ?>'" />
            </a>
            <a style="height:100%;width:600px;" class="navbar-brand">
                <table border="0" cellspacing="">
                    <tr>
                        <td style="font-weight:bold;color:#f00;font-size:17px;line-height:1;padding:2px;">
                            <i
                                class="fa fa-home"></i>&nbsp;<?php echo e(Auth::user() != '' ? \App\Sf::getPlantname(Auth::user()->def_plant) : \App\Sf::getParsys('APP_LABEL')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td style="color:white;font-size:12px;line-height:1;padding:2px;">
                            &nbsp;<i class="fa fa-map-marker"></i>&nbsp;
                            <?php echo e(Auth::user() != '' ? \App\Sf::getAddr(Auth::user()->def_plant) : \App\Sf::getParsys('APP_WEB_ADDR')); ?>

                        </td>
                    </tr>
                </table>
            </a>
            
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
                    <a href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>" class="btn btn-sm btn-primary"
                        style="background:#2d353c;border:1px solid #2d353c"><?php echo e(\Auth::check() ? 'Admininistrator' : 'Sign in'); ?></a>
                </span>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\a_data\monitoring_back\backend\resources\views/layouts/common/coloradmin/nav_top_front.blade.php ENDPATH**/ ?>