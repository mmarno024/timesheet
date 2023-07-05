<div id="header" class="header navbar navbar-default navbar-fixed-topxxx" style="background:#ffffff;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="height:100%;width:600px;" class="navbar-brand">
                <?php
                use App\Model\Sys\Syplant;
                $plant = Auth::user() == '' ? null : Auth::user()->def_plant;
                $cek_img = $plant != null ? Syplant::find($plant) : null;
                ?>
                <table border="0" cellspacing="">
                    <tr>
                        <td rowspan="2">
                            <img style="height: 35px;" src="<?php echo e(url('coloradmin/assets/img/logo.png')); ?>" />
                        </td>
                        <td rowspan="2">&nbsp;</td>
                        <td
                            style="font-weight:bold;color:#0059b3;font-size:16px;line-height:1;padding:2px;font-family:Arial Narrow">
                            <i class="fa fa-home"></i>&nbsp;<?php echo e(Auth::user() != '' ? \App\Sf::getPlantname(Auth::user()->def_plant) : \App\Sf::getParsys('APP_LABEL')); ?>

                        </td>
                    <tr>
                        <td style="color:rgb(212, 54, 19);font-size:12px;line-height:1;padding:2px;font-family:Arial">
                            &nbsp;<i class="fa fa-map-marker"></i>&nbsp;
                            <?php echo e(Auth::user() != '' ? \App\Sf::getAddr(Auth::user()->def_plant) : \App\Sf::getParsys('APP_WEB_ADDR')); ?>

                        </td>
                    </tr>
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
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown p-10">
                <span>
                    <a href="<?php echo e(\Auth::check() ? url('home') : url('login')); ?>" class="btn btn-sm btn-default"
                        style="background:#ffffff;border:1px solid #ffffff;color:rgb(134, 134, 134);border:.1em solid rgb(134, 134, 134);border-radius:0;font-family:Arial;border-radius:5px;"><?php echo e(\Auth::check() ? 'Admininistrator' : 'Sign in'); ?></a>
                </span>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH C:\laragon\www\kalsel\psda\admin\backend\resources\views/layouts/common/coloradmin/nav_top_front.blade.php ENDPATH**/ ?>