<?php $__env->startSection('content'); ?>
<link href="<?php echo e(url('coloradmin')); ?>/assets/css/style_all_prov.css" rel="stylesheet" />
    <style type="text/css">
        @import  url('https://fonts.googleapis.com/css?family=Orbitron');
        @import  url('https://fontlibrary.org//face/segment7');
        body{
            background-color:#2D353C;
        }
        a{
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
        }
        .swal-wide{
            width:450px !important;
        }
    </style>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1800; URL=$url");
    ?>
    <audio autoplay ng-if="countNotif >= 1" loop>
        <source src="<?php echo e(url('sound')); ?>/beep5.mp3" type="audio/mpeg">
        <p>Audio tidak disupport browser</p>
    </audio>
    <div class="col-lg-12 col-12 m-0 p-2" style="">
        <div class="col-lg-12 col-12 m-0 p-2 bg-white" style="border-radius: 5px;">
            <div class="col-lg-10 col-12 p-0 m-0" style="">
                <a style="height:100%;">
                    <?php
                    use App\Model\Sys\Syplant;
                    $plant = Auth::user() == '' ? null : Auth::user()->def_plant;
                    $cek_img = $plant != null ? Syplant::find($plant) : null;
                    ?>
                    <table border="0" cellspacing="">
                        <tr>
                            <td rowspan="2">
                                <img style="height:35px;width:35px;" src="<?php echo e(Auth::check() && Auth::user()->url_img != null ? \App\Sf::fileFtpUrl(Auth::user()->url_img) : url('coloradmin/assets/img/logo.png')); ?>" onerror="this.src='<?php echo e(url('coloradmin/assets/img/logo.png')); ?>'" />
                            </td>
                            <td rowspan="2">&nbsp;</td>
                            <td style="font-weight:bold;color:#0059b3;font-size:16px;line-height:1;padding:2px;font-family:Arial Narrow">
                                <i class="fa fa-home"></i>&nbsp;
                                <?php echo e(\App\Sf::getPlantname(Auth::user()->def_plant)); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="color:rgb(212, 54, 19);font-size:12px;line-height:1;padding:2px;font-family:Arial">
                                &nbsp;<i class="fa fa-map-marker"></i>&nbsp;
                                <?php echo e(\App\Sf::getAddr(Auth::user()->def_plant)); ?>

                            </td>
                        </tr>
                    </table>
                </a>
            </div>
            <div class="col-lg-2 col-12 m-0" style="text-align: right;padding:8px 5px 8px 0;">
                <a href="<?php echo e(url('home')); ?>" class="btn btn-sm btn-primary" style="border:none"><i class="fa fa-user-circle"></i> Administrator</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-12 m-0 p-2">
        <div ng-if="countNotif < 1" class="col-lg-4 col-12 m-0 p-2 bg-black" style="border-radius: 5px;">
            <i style="font-size:2vh;color:yellow" class="fa fa-spinner fa-spin"></i>&nbsp; 
            <span style="font-size:2vh;color:yellow" class="text-bold runword"></span>
        </div>
        <div ng-if="countNotif >= 1" class="col-lg-4 col-12 m-0 p-2 bg-black" style="border-radius: 5px;">
            <i style="font-size:2vh;color:red" class="fa fa-spinner fa-spin"></i>&nbsp; 
            <span style="font-size:2vh;color:white; padding:0 5px 0 5px" class="text-bold runword button_alarm"></span>
        </div>
        <div class="col-lg-8 col-12 m-0 p-2 bg-black" style="border-radius: 5px;">
            <marquee direction="left" scrollamount="3">
                <span class="text-bold" style="font-size:2vh;color:greenyellow" ng-repeat="vrt in running_text">{{vrt . pos_name}} : {{vrt['detail'].value}} {{vrt['detail']['sensor'].units}} | </span>
            </marquee>
        </div>
    </div>
    <div ng-repeat="(k,v) in data_hardware" class="col-lg-4 col-md-4 col-sm-12 m-0 p-2">
        <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-2 bg-white" style="border-radius: 5px;">
            <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-r-0 p-b-0 p-l-0 p-t-2" style="">
                <div class="col-lg-11 col-md-11 col-sm-11 m-0 p-0" style="float:left">
                    <span ng-if="v.detail['waterlevel'].status == 'normal'" class="text-primary text-bold m-l-5">WL : {{ v . pos_name }} - EWS : {{ v.detail_ews[0].ews_location }}</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 3" style="-webkit-text-stroke: 0.1px black" class="text-bold m-l-5 blink_yellow">WL : {{ v . pos_name }} - EWS : {{ v.detail_ews[0].ews_location }}</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 4" class="text-bold m-l-5 blink_orange">WL : {{ v . pos_name }} - EWS : {{ v.detail_ews[0].ews_location }}</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && (v.detail['waterlevel'].alarm_status >= 5 && v.detail['waterlevel'].alarm_status < 8)" class="text-bold m-l-5 blink_red">WL : {{ v . pos_name }} - EWS : {{ v.detail_ews[0].ews_location }}</span>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 m-0 p-0 text-right" style="">
                    <a href="" style="cursor: pointer" title="Open Full Windows">
                        <img src="<?php echo e(url('coloradmin')); ?>/assets/icon/expand-arrows.png" width="12px;" alt="" style="" ng-click="oExpand(v.hardware)" />
                    </a>
                </div>
            </div>
            <hr style="margin-bottom:2px;"/>            
            <div class="col-lg-6 col-md-6 col-sm-12 m-0 p-0" style="">
                <div id="gallery" class="col-lg-12 col-md-12 col-sm-12 gallery m-0 p-2" style="">
                    <div class="image gallery-group-1 m-0" style="width: 100%;padding:0;border-radius: 5px">
                        <div class="image-inner">
                            <a ng-if="v.device_img == NULL" href="<?php echo e(url('coloradmin')); ?>/assets/img/cctv.jpg" data-lightbox="gallery-group-1">
                                <img ng-if="v.device_img == NULL" src="<?php echo e(url('coloradmin')); ?>/assets/img/cctv.jpg" alt="" style="border-radius:5px;" />
                            </a>
                            <a ng-if="v.device_img != NULL" href="<?php echo e(url('device_img')); ?>/{{ v . device_img . img_name }}" data-lightbox="gallery-group-1">
                                <img ng-if="v.device_img != NULL" src="<?php echo e(url('device_img')); ?>/{{ v . device_img . img_name }}" alt="" style="border-radius:5px;" />
                            </a>
                            <span class="image-caption" style="font-size:10px;border-radius:0 3px 3px 0;margin-top:2%;">
                                <p style="padding: 0;margin:0;color:yellow">Coordinate : {{ v . device_img . latitude }}, {{ v . device_img . longitude }}</p>
                                <p style="padding: 0;margin:0;color:yellow">Capture Time : {{ v . device_img . date_capture }}</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-0 p-0" style="">
                <div class="col-lg-12 col-md-12 col-sm-12 m-0" style="padding:0 5px 0 5px;">
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 m-0 p-0">
                        <span class="text-primary" style="font-size: 10px;"><i class="fa fa-calendar"></i> {{ v.time_local }}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m-0 p-0" style="text-align: right;">
                        <span ng-if="v.detail['waterlevel'].status == 'normal'" class="text-success text-bold">NORMAL</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 3" class="text-bold" style="color:#E5E338;-webkit-text-stroke: 0.1px black">{{ v . detail['waterlevel'] . status }}</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 4" class="text-bold text-warning">{{ v . detail['waterlevel'] . status }}</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && (v.detail['waterlevel'].alarm_status >= 5 && v.detail['waterlevel'].alarm_status < 8)" class="text-bold text-danger">{{ v . detail['waterlevel'] . status }}</span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0" style="">                    
                    <div class="col-lg-8 col-md-8 col-sm-12 m-0 p-3 text-center" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0" style="">
                            <div class="card l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-tint fa-5x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:14px;" class="card-title m-t-0 m-b-0 text-white">Level Air</span>
                                        <span style="font-size:12px;" class="card-title m-t-0 m-b-0 text-white"> <i>({{ v . detail['waterlevel'].sensor . units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-5 d-flex" style="">
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="">
                                            <h2 class="d-flex align-items-center m-t-5 text-bold text-white " style="text-align: right; -webkit-text-stroke: 0.5px black">{{ v . detail['waterlevel'] . value }}</h2>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right" style="float:left;">
                                            <span style="font-size:12px;text-align: right">{{ v . detail['waterlevel'] . val_min }}</span> <i class="fa fa-arrow-down text-primary"></i>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right" style="float:left;">
                                            <span style="font-size:12px;text-align: right">{{ v . detail['waterlevel'] . val_max }}</span> <i class="fa fa-arrow-up text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 m-0 p-3 text-center" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 m-t-0 m-r-0 m-b-5 m-l-0 p-0 text-center" style="">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-battery-3 fa-2x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:10px" class="card-title m-t-0 m-b-0 text-white">Batt.</span>
                                        <span style="font-size:8px" class="card-title m-t-0 m-b-0 text-white"> <i>({{ v . detail['battery'] . sensor . units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-0 d-flex" style="">
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:right">
                                            <span style="font-size:15px" class="d-flex align-items-center m-t-0 text-right text-white">{{ v . detail['battery'] . value }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0 text-center" style="">
                            <div class="card l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-thermometer fa-2x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:10px" class="card-title m-t-0 m-b-0 text-white">Temp.</span>
                                        <span style="font-size:8px" class="card-title m-t-0 m-b-0 text-white"> <i>({{ v . detail['devicetemp'].sensor . units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-0 d-flex" style="">
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:right">
                                            <span style="font-size:15px" class="d-flex align-items-center m-t-0 text-right text-white">{{ v . detail['devicetemp'] . value }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 m-t-0 m-r-0 m-b-5 m-l-0" style="padding:0 5px 0 5px;">
                    <div class="btn-group" style="margin:0;padding:0;width:100%">
                        <a ng-repeat="(ki, vi) in v.detail['waterlevel']['properties']['color_step']" class="btn btn-{{vi}} btn-xs p-0 m-0 text-center" style="font-size:8px;width:25%">{{ v . detail['waterlevel']['properties']['value_step'][ki] }}</a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 m-0" style="padding:0 5px 0 5px;">
                    <span class="text-primary">status sirine : </span>
                    <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_type == 1" class="text-success"><b>OFF</b></span>
                    <span ng-if="v.detail['waterlevel'].status == 'normal' && (v.detail['waterlevel'].btn_type == 2 || v.detail['waterlevel'].btn_type == 5)" class="text-success">MENUNGGU RESPON</span>
                    <span ng-if="v.detail['waterlevel'].status == 'normal' && (v.detail['waterlevel'].btn_type == 3 || v.detail['waterlevel'].btn_type == 6)" class="text-success">RESPON GAGAL</span>
                    <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine_level == 8" class="text-success"><b>ON</b> UJI SIRINE</span>
                    <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine_level == 9" class="text-success"><b>ON</b> AMAN</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_type == 1" class="text-danger"><b>OFF</b></span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && (v.detail['waterlevel'].btn_type == 2 || v.detail['waterlevel'].btn_type == 5)" class="text-danger">MENUNGGU RESPON</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && (v.detail['waterlevel'].btn_type == 3 || v.detail['waterlevel'].btn_type == 6)" class="text-danger">RESPON GAGAL</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine_level == 1" class="text-danger"><b>ON</b> KUNING WASPADA</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine_level == 2" class="text-danger"><b>ON</b> ORANGE SIAGA</span>
                    <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine_level == 3" class="text-danger"><b>ON</b> MERAH AWAS</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 m-0" style="padding:0 5px 0 5px;">
                    <div class="col-lg-2 col-md-2 col-sm-2 m-0 p-0" style="float:left;">
                        <span ng-if="v.detail['waterlevel'].status == 'normal'" class="loader1a"></span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 3" class="loader1b_yellow"></span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].alarm_status == 4" class="loader1b_orange"></span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && (v.detail['waterlevel'].alarm_status >= 5 && v.detail['waterlevel'].alarm_status < 8)" class="loader1b_red"></span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 m-0 p-t-5 p-r-0 p-b-5 p-l-5 text-right">
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 1 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'normal' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsUji(v.hardware)"><i class="fa fa-thumbs-up"></i>&nbsp; Uji coba / Pemberitahuan</span>
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'on' && v.detail['waterlevel'].btn_type == 2 && v.detail_ews[0].ews_sirine == 1 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'onproccess' && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsCancel(v.hardware)"><i class="fa fa-refresh fa-spin"></i>&nbsp; Perintah dikirim ! Batalkan ?</span>
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 3 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'failed' && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsUji(v.hardware)"><i class="fa fa-warning"></i>&nbsp; Terjadi kegagalan ! Ulangi ?</span>
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'on' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine == 1 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'on'
                        && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOff(v.hardware)"><i class="fa fa-volume-up"></i>&nbsp; Sirine dinyalakan ! Matikan ?</span>
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 5 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'offproccess' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button"><i class="fa fa-refresh fa-spin"></i>&nbsp; Proses mematikan sirine</span>
                        <span ng-if="v.detail['waterlevel'].status == 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 6 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'failed' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-success text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOff(v.hardware)"><i class="fa fa-warning"></i>&nbsp; Gagal mematikan ! Ulangi ?</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 1 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'warning' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOn(v.hardware)"><i class="fa fa-warning"></i>&nbsp; Nyalakan sirine !</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'on' && v.detail['waterlevel'].btn_type == 2 && v.detail_ews[0].ews_sirine == 1 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'onproccess' && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsCancel(v.hardware)"><i class="fa fa-refresh fa-spin"></i>&nbsp; Perintah dikirim ! Batalkan ?</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 3 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 0 && v.detail_ews[0].ews_status == 'failed' && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOn(v.hardware)"><i class="fa fa-warning"></i>&nbsp; Terjadi kegagalan ! Ulangi ?</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'on' && v.detail['waterlevel'].btn_type == 4 && v.detail_ews[0].ews_sirine == 1 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'on'
                        && v.detail_ews[0].ews_sirine_level > 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOff(v.hardware)"><i class="fa fa-volume-up"></i>&nbsp; Sirine dinyalakan ! Matikan ?</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 5 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'offproccess' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button"><i class="fa fa-refresh fa-spin"></i>&nbsp; Proses mematikan sirine</span>
                        <span ng-if="v.detail['waterlevel'].status != 'normal' && v.detail['waterlevel'].btn_status == 'off' && v.detail['waterlevel'].btn_type == 6 && v.detail_ews[0].ews_sirine == 0 && v.detail_ews[0].ews_sirine_reply == 1 && v.detail_ews[0].ews_status == 'failed' && v.detail_ews[0].ews_sirine_level == 0" class="btn btn-danger text-white p-5" style="font-size:10px;" role="button" ng-click="oEwsOff(v.hardware)"><i class="fa fa-warning"></i>&nbsp; Gagal mematikan ! Ulangi ?</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs2/utils.js')); ?>"></script>
    <script src="<?php echo e(url('coloradmin/assets/plugins/chartjs/Chart.bundle.js')); ?>"></script>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', '$interval', 'NgTableParams', 'SfService', 'FileUploader',
            function($scope, $http, $interval, NgTableParams, SfService, FileUploader) {
                SfService.setUrl("<?php echo e(url('/')); ?>");
                $scope.f = {
                    tab: 'list',
                    plant: "<?php echo e(Auth::user()->def_plant); ?>"
                };
                $scope.h = {};
                $scope.m = [];
                $scope.d1 = [];
                $scope.plantData = [];
                $scope.path = "<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/";
                $scope.oCheck = function(hid) {
                    SfService.httpGet("trs_local_trs_view_cek_all_data");
                }
                $scope.oViewAll = function() {
                    SfService.httpGet("trs_local_trs_view_ap_data", {
                        plant: $scope.f.plant
                    }, function(jdata) {
                        $scope.data_hardware = jdata.data.dataHardware;
                        $scope.running_text = jdata.data.runningText;
                        $scope.countNotif = jdata.data.q_notif;
                        $scope.notif_text = jdata.data.notifText;
                        $scope.words = [];
                        angular.forEach($scope.notif_text, function(item, i) {
                            $scope.words.push(item.vstatus);
                        });
                        $scope.part,
                        $scope.i = 0,
                        $scope.offset = 0,
                        $scope.len = $scope.words.length,
                        $scope.forwards = true,
                        $scope.skip_count = 0,
                        $scope.skip_delay = 50,
                        $scope.speed = 50;
                        $scope.wordflick = function () {
                            clearInterval($scope.runtex);
                            $scope.runtex = setInterval(function () {
                                if ($scope.forwards) {
                                    if ($scope.offset >= $scope.words[$scope.i].length) {
                                        ++$scope.skip_count;
                                        if ($scope.skip_count == $scope.skip_delay) {
                                            $scope.forwards = false;
                                            $scope.skip_count = 0;
                                        }
                                    }
                                } else {
                                    if ($scope.offset == 0) {
                                        $scope.forwards = true;
                                        $scope.i++;
                                        $scope.offset = 0;
                                        if ($scope.i >= $scope.len) {
                                            $scope.i = 0;
                                        }
                                    }
                                }
                                $scope.part = $scope.words[$scope.i].substr(0, $scope.offset);
                                if ($scope.skip_count == 0) {
                                    if ($scope.forwards) {
                                        $scope.offset++;
                                    } else {
                                        $scope.offset--;
                                    }
                                }
                                $('.runword').text($scope.part);
                            },$scope.speed);
                        };
                        $scope.wordflick();                        
                    });
                }
                $scope.oEwsUji = function (hardware) {
                    (async () => {
                        const inputOptions = new Promise((resolve) => {
                            setTimeout(() => {
                                resolve({'8': 'Uji coba sirine', '9': 'Status aman' })
                            }, 500)
                        })
                        const { value: sirine_level } = await Swal.fire({
                            title: 'Pilih tipe sirine',
                            input: 'radio',
                            inputOptions: inputOptions,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Anda harus memilih salah satu !'
                                }
                            },
                            customClass: 'swal-wide',
                            showCancelButton: true,
                            confirmButtonText: 'Nyalakan sirine',
                            cancelButtonText: 'Batalkan',
                            confirmButtonColor: "#FF3B3F",
                            cancelButtonColor: "#008A8A",
                        })
                        if (sirine_level) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&sl=' + sirine_level + '&st=up';
                            Swal.fire('Perintah dikirim !', '', 'success')
                        }
                    })()
                }
                $scope.oEwsOn = function (hardware) {
                    (async () => {
                        const inputOptions = new Promise((resolve) => {
                            setTimeout(() => {
                                resolve({'1': 'Kuning (Waspada)', '2': 'Orange (Siaga)', '3': 'Merah (Awas)' })
                            }, 500)
                        })
                        const { value: sirine_level } = await Swal.fire({
                            title: 'Pilih tipe sirine',
                            input: 'radio',
                            inputOptions: inputOptions,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Anda harus memilih salah satu !'
                                }
                            },
                            customClass: 'swal-wide',
                            showCancelButton: true,
                            confirmButtonText: 'Nyalakan sirine',
                            cancelButtonText: 'Batalkan',
                            confirmButtonColor: "#FF3B3F",
                            cancelButtonColor: "#008A8A",
                        })
                        if (sirine_level) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&sl=' + sirine_level + '&st=up';
                            Swal.fire('Perintah dikirim !', '', 'success')
                        }
                    })()
                }
                $scope.oEwsCancel = function (hardware) {
                    Swal.fire({
                        title: 'Perintah akan dibatalkan ?',
                        showCancelButton: true,
                        confirmButtonColor: '#008A8A',
                        cancelButtonColor: '#FF3B3F',
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value == true) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&st=break';
                            Swal.fire('', 'Perintah dibatalkan !', 'success')
                        }
                    })
                }
                $scope.oEwsOff = function (hardware) {
                    Swal.fire({
                        title: 'Siaga - akan dimatikan ?',
                        showCancelButton: true,
                        confirmButtonColor: '#008A8A',
                        cancelButtonColor: '#FF3B3F',
                        confirmButtonText: 'Ya, matikan',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value == true) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&st=down';
                            Swal.fire('', 'Perintah dikirim !', 'success')
                        }
                    })
                }
                $scope.oExpand = function(hid) {
                    window.location = 'trs_local_trs_view_sp?id=' + hid;
                }
                $scope.moment = function(dt) {
                    return moment(dt);
                }
                $scope.oViewAll();
                $interval(function() {
                    $scope.oViewAll();
                    $scope.oCheck();
                }, 30000);
            }
        ]);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorreport_blank', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\kalsel_fix\admin\backend\resources\views/trs/local/trs_view/trs_view_all_prov_frm.blade.php ENDPATH**/ ?>