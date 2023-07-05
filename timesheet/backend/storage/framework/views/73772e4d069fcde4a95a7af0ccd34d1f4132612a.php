<style type="text/css">
    @import  url('https://fonts.googleapis.com/css?family=Orbitron');
    @import  url('https://fontlibrary.org//face/segment7');

    .item_li {

        border-top: 1px solid #ccc;
        border-right: 0;
        border-bottom: 1px solid #ccc;
        border-left: 0;
        cursor: pointer;
    }

    .val_7s {
        font-family: 'segment7'
    }

</style>
<div id="sidebar" class="sidebar hidden-print">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img
                            src="<?php echo e(Auth::check() && Auth::user()->url_img != null ? \App\Sf::fileFtpUrl(Auth::user()->url_img) : url('coloradmin/assets/img/user-13.jpg')); ?>"
                            onerror="this.src='<?php echo e(url('coloradmin/assets/img/ionic.png')); ?>'" /></a>
                </div>
                <div class="info">
                    <?php echo e(Auth::check() ? Auth::user()->userid : ''); ?>

                    <small><?php echo e(ucwords(strtolower(Auth::check() ? Auth::user()->username : 'Guest'))); ?></small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header"><a href="<?php echo e(url('sys_system_change_plant')); ?>"> Plant :
                    <?php echo e(\Session::get('plant')); ?></a></li>





            <div data-scrollbar="true" data-height="535px" class="bg-inverse m-0 p-0">

                <div class="panel-group" id="accordion" style="border-radius:0">

                    <div class="panel panel-inverse overflow-hidden" ng-repeat="(k,v) in loggerData"
                        style="border-radius:0">
                        <div class=" panel-heading" style="border-radius:0;background:#2d353c;">
                            <h3 class="panel-title" style="border-radius:0">
                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                    data-parent="#accordion" href="#coll{{ v . kd_logger }}" style="border-radius:0">
                                    <i class="fa fa-plus-circle pull-right"></i>
                                    <img ng-show="v.kd_logger=='1'"
                                        src="<?php echo e(url('colorparalax/assets/img/device_blue.png')); ?>" width="15"
                                        height="15"></img>
                                    <img ng-show="v.kd_logger=='2'"
                                        src="<?php echo e(url('colorparalax/assets/img/device_green.png')); ?>" width="15"
                                        height="15"></img>
                                    <img ng-show="v.kd_logger=='9'"
                                        src="<?php echo e(url('colorparalax/assets/img/device_yellow.png')); ?>" width="15"
                                        height="15"></img>
                                    {{ v . nm_logger }}
                                </a>
                            </h3>
                        </div>
                        <div id="coll{{ v . kd_logger }}" class="panel-collapse collapse" style="border-radius:0">
                            <div class="panel-body">
                                <div class="list-group" style="border-radius: 0">
                                    <a style="font-size: 11px;border-radius: 0;" ng-repeat="(k1,v1) in v.hardware"
                                        class="list-group-item item_li p-l-0 p-r-0" style="border-radius: 0;"
                                        ng-click="oView(k,k1)">
                                        <table width='100%' border='0'>
                                            <tr>
                                                <td class="val_7s">
                                                    <span
                                                        ng-class="{'val_7s text-warning':v.kd_logger=='1','val_7s text-danger':v.kd_logger=='2','val_7s text-success':v.kd_logger=='9'}">{{ v1 . kd_hardware }}</span>-{{ v1 . uid }}
                                                </td>
                                                <td rowspan="3" align="right">
                                                    <span class="badge text-info m-0 p-0"
                                                        style="background: rgba(76, 175, 80, 0);">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i
                                                        ng-class="{'fa fa-map-marker text-primary':v.kd_logger=='1','fa fa-map-marker text-success':v.kd_logger=='2','fa fa-map-marker text-warning':v.kd_logger=='9'}"></i>&nbsp;<span
                                                        ng-class="{'text-primary':v.kd_logger=='1','text-success':v.kd_logger=='2','text-warning':v.kd_logger=='9'}"
                                                        style="font-size:10px;">{{ (v1 . location) | lowercase }}</span>
                                                </td>
                                            </tr>
                                            <tr ng-show="v.kd_logger!='9'">
                                                <td>
                                                    <div class="btn-group"
                                                        style="width:100%;margin:-10px 0 0 0;padding:0">
                                                        <a ng-repeat="v2 in v1.sensor[0].color_step"
                                                            class="btn btn-xs btn-{{ v2 }}"
                                                            style="width:{{ 100 / v1 . sensor[0] . count_step }}%;"></a>
                                                    </div>
                                                    <div class="btn-group val_7s"
                                                        style="width:100%;margin:-20px 0 0 0;padding:0">
                                                        <a ng-repeat="v2 in v1.sensor[0].val_step"
                                                            class="btn btn-xs btn-def"
                                                            style="width:{{ 100 / v1 . sensor[0] . count_step }}%;font-size:10px;">{{ v2 }}</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>







            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg hidden-print"></div>

<script>
    $(document).ready(function() {
        $("#sidebarCollapse").on("click", function() {
            $("#sidebar").toggleClass("active");
            $(this).toggleClass("active");
        });
    });
    app.controller('mainCtrl', ['$scope', '$http', '$interval', 'NgTableParams', 'SfService', 'FileUploader',
        function(
            $scope, $http, $interval, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('/')); ?>");
            $scope.f = {
                tab: 'list',
                plant: "<?php echo e(Session::get('plant')); ?>"
            };
            $scope.h = {};
            $scope.m = [];
            $scope.d1 = [];
            $scope.loggerData = [];
            $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";

            $scope.oLogger = function() {
                SfService.httpGet("trs_local_mst_logger_data", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.loggerData = jdata.data.loggerData;

                });
            }

            $scope.oLogger();

            $scope.moment = function(dt) {
                return moment(dt);
            }

        }
    ]);

</script>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\backend\resources\views/layouts/common/coloradmin/sidebar_left_front.blade.php ENDPATH**/ ?>