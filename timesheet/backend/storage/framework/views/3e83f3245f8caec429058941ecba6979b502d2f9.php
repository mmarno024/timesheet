<div id="header" class="header navbar navbar-default navbar-fixed-topxxx">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="height:100%;width:600px;" class="navbar-brand">
                <table border="0" cellspacing="">
                    <tr>
                        <td rowspan="2">
                            <a href="<?php echo e(url('home')); ?>">
                                <img
                                    src="http://localhost/tatonas/webmon/monitoring/webadm/p/libftp/{{ cek_plant . image != null ? cek_plant . image : 'uploads/sys_syplant/default_logo.png' }}"></img>
                            </a>
                        </td>
                        <td rowspan="2">&nbsp;</td>
                        <td style="font-weight:bold;color:#303131;font-size:17px;line-height:1;border:none">
                            {{ cek_plant . plantname }}</td>
                    </tr>
                    <tr>
                        <td style="color:#666;font-size:12px;line-height:1">
                            {{ cek_plant . addr }}</td>
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
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-info-circle"></i>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown">
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
    </div>
</div>

<script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
        NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?php echo e(url('trs_local_mst_desa')); ?>");
        $scope.f = {
            crud: 'c',
            tab: 'list',
            trash: 0,
            userid: "<?php echo e(Auth::user()->userid); ?>",
            plant: "<?php echo e(Auth::user()->def_plant); ?>"
        };
        $scope.h = {};

        $scope.oCekPlant = function() {
            SfService.httpGet("sys_syplant_cek_data", {
                userid: $scope.f.userid,
                plant: $scope.f.plant
            }, function(jdata) {
                $scope.cek_plant = jdata.data.data_cek_plant;
            });
        }
        $scope.oCekPlant();

    }]);

</script>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\webadm\backend\resources\views/layouts/common/coloradmin/nav_top.blade.php ENDPATH**/ ?>