<?php $__env->startSection('content'); ?>
<link href="<?php echo e(url('coloradmin')); ?>/assets/css/style_single_kab.css" rel="stylesheet" />
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

    <audio autoplay ng-if="data_hardware.detail['waterlevel'].alarm_status >= 2" loop>
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
        <div class="col-lg-4 col-12 m-0 p-2 bg-black" style="border-radius: 5px;">
            <i style="font-size:2.5vh;color:yellow" class="fa fa-spinner fa-spin"></i>&nbsp; 
            <span style="font-size:2.5vh;color:yellow" class="text-bold runword"></span>
        </div>
        <div class="col-lg-8 col-12 m-0 p-2 bg-black text-right" style="border-radius: 5px;">
            <span ng-if="notif_text != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 2" style="font-size:2.5vh;" class="text-bold button_alarm_yellow p-t-2 p-r-10 p-b-2 p-l-10">AWAS ! LEVEL AIR MEMBERIKAN SINYAL PERINGATAN {{data_hardware.detail['waterlevel'].status}}</span>
            <span ng-if="notif_text != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 3" style="font-size:2.5vh;" class="text-bold button_alarm_orange p-t-2 p-r-10 p-b-2 p-l-10">AWAS ! LEVEL AIR MEMBERIKAN SINYAL PERINGATAN {{data_hardware.detail['waterlevel'].status}}</span>
            <span ng-if="notif_text != 'normal' && data_hardware.detail['waterlevel'].alarm_status >= 4" style="font-size:2.5vh;" class="text-bold button_alarm_red p-t-2 p-r-10 p-b-2 p-l-10">AWAS ! LEVEL AIR MEMBERIKAN SINYAL PERINGATAN {{data_hardware.detail['waterlevel'].status}}</span>
            <span ng-if="notif_text == 'normal'" style="font-size:2.5vh;" class="text-bold btn btn-success p-t-2 p-r-10 p-b-2 p-l-10">LEVEL AIR DALAM KEADAAN NORMAL</span>
        </div>
    </div>
    
    <div class="col-lg-12 col-12 m-0 p-2">
        <div class="col-lg-12 col-12 m-0 p-2 bg-white" style="border-radius: 5px;">
            <div class="col-lg-12 col-12 m-0 p-0">
                <div class="col-lg-11 col-12 m-0 p-r-0 p-b-0 p-l-0 p-t-5" style="border:none">
                    <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" style="font-size:25px;" class="text-primary text-bold m-l-5">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>

                    <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail_ews[0].ews_sirine == 1 && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" style="font-size:25px;" class="text-primary text-bold m-l-5">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>

                    <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail_ews[0].ews_sirine == 0 && data_hardware.detail_ews[0].ews_sirine_reply == 1" style="font-size:25px;" class="text-bold m-l-5 blink_blue">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>

                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 3" style="font-size:25px;-webkit-text-stroke: 0.1px black" class="text-bold m-l-5 blink_yellow">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>
                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 4" style="font-size:25px;" class="text-bold m-l-5 blink_orange">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>
                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && (data_hardware.detail['waterlevel'].alarm_status >= 5 && data_hardware.detail['waterlevel'].alarm_status < 8)" style="font-size:25px;" class="text-bold m-l-5 blink_red">POS WATER LEVEL - {{ data_hardware . pos_name }}</span>

                </div>
                <div class="col-lg-1 m-0 p-r-5 p-t-5 text-right" style="">
                    <a href="" style="cursor: pointer" title="Close Full Windows">
                        <img src="<?php echo e(url('coloradmin')); ?>/assets/icon/compress-arrows.png" width="22px;" alt="" style="" ng-click="oCompress()" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-0 p-0">
                <div id="gallery" class="col-lg-12 col-12 gallery m-0 p-5">
                    <div class="image gallery-group-1 m-0" style="width: 100%;padding:0;border-radius: 5px">
                        <div class="image-inner">
                            <a ng-if="data_hardware.device_img == NULL" href="<?php echo e(url('coloradmin')); ?>/assets/img/broken_image.png" data-lightbox="gallery-group-1">
                                <img ng-if="data_hardware.device_img == NULL" src="<?php echo e(url('coloradmin')); ?>/assets/img/broken_image.png" alt="" style="border-radius:5px;height:100%;" />
                            </a>
                            <a ng-if="data_hardware.device_img != NULL" href="<?php echo e(url('device_img')); ?>/{{ data_hardware . device_img . img_name }}" data-lightbox="gallery-group-1">
                                <img ng-if="data_hardware.device_img != NULL" src="<?php echo e(url('device_img')); ?>/{{ data_hardware . device_img . img_name }}" alt="" style="border-radius:5px;height:100%;" />
                            </a>
                            <span class="image-caption" style="font-size:20px;border-radius:0 3px 3px 0;margin-top:4%;">
                                <p style="padding: 0;margin:0;color:yellow">Coordinate : {{ data_hardware . device_img . latitude }}, {{ data_hardware . device_img . longitude }}</p>
                                <p style="padding: 0;margin:0;color:yellow">Capture Time : {{ data_hardware . device_img . date_capture }}</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 m-0 p-0" style="">

                <div class="col-lg-12 col-12 m-0" style="padding:0 5px 0 5px;">
                    <span style="font-size:18px" class="text-primary">status level air : </span>
                    <span ng-if="data_hardware.detail['waterlevel'].status == 'normal'" style="font-size:18px" class="text-success text-bold">NORMAL</span>
                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 3" class="text-bold" style="font-size:18px;color:#E5E338;-webkit-text-stroke: 0.1px black">{{ data_hardware . detail['waterlevel'] . status }}</span>
                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 4" style="font-size:18px" class="text-bold text-warning">{{ data_hardware . detail['waterlevel'] . status }}</span>
                    <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && (data_hardware.detail['waterlevel'].alarm_status >= 5 && data_hardware.detail['waterlevel'].alarm_status < 8)" style="font-size:18px" class="text-bold text-danger">{{ data_hardware . detail['waterlevel'] . status }}</span>

                </div>
                <div class="col-lg-12 col-12 m-0 p-0" style="">
                    <div class="col-lg-8 col-md-8 col-sm-12 m-0 p-3 text-center" style="">
                        <div class="col-lg-12 col-12 m-0 p-0" style="">
                            <div class="card l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-tint fa-5x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:30px;" class="card-title text-white">Level Air</span>
                                        <span style="font-size:25px;" class="card-title text-white"> <i>({{ data_hardware . detail['waterlevel'].sensor.units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-5 d-flex" style="">
                                        <div class="col-lg-12 col-12" style="">
                                            <h2 class="d-flex align-items-center text-bold text-white" style="font-size:75px;text-align: right;-webkit-text-stroke: 1px black">{{ data_hardware . detail['waterlevel'].value }}</span>
                                        </div>
                                        <div class="col-lg-6 col-6 text-right" style="float:left;">
                                            <span style="font-size:35px;text-align: right">{{ data_hardware . detail['waterlevel'].val_min }}</span> <i style="font-size:35px;" class="fa fa-arrow-down text-primary"></i>
                                        </div>
                                        <div class="col-lg-6 col-6 text-right" style="float:left;">
                                            <span style="font-size:35px;text-align: right">{{ data_hardware . detail['waterlevel'].val_max }}</span> <i style="font-size:35px;" class="fa fa-arrow-up text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 m-0 p-3 text-center" style="">
                        <div class="col-lg-12 col-12 m-t-0 m-r-0 m-b-5 m-l-0 p-0 text-center" style="">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-battery-3 fa-2x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:30px" class="card-title m-t-0 m-b-0 text-white">Batt.</span>
                                        <span style="font-size:20px" class="card-title m-t-0 m-b-0 text-white"> <i>({{ data_hardware . detail['battery'].sensor.units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-0 d-flex" style="">
                                        <div class="col-lg-12 col-12" style="text-align:right">
                                            <span style="font-size:39px" class="d-flex align-items-center m-t-0 text-right text-white">{{ data_hardware . detail['battery'].value }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 m-t-0 m-r-0 m-b-5 m-l-0 p-0 text-center" style="">
                            <div class="card l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fa fa-thermometer fa-2x"></i></div>
                                    <div class="m-b-0 text-left" style="">
                                        <span style="font-size:30px" class="card-title m-t-0 m-b-0 text-white">Temp.</span>
                                            <span style="font-size:20px" class="card-title m-t-0 m-b-0 text-white"> <i>({{ data_hardware . detail['devicetemp'].sensor.units }})</i></span>
                                    </div>
                                    <div class="row align-items-center m-b-0 d-flex" style="">
                                        <div class="col-lg-12 col-12" style="text-align:right">
                                            <span style="font-size:39px" class="d-flex align-items-center m-t-0 text-right text-white">{{ data_hardware . detail['devicetemp'].value }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-lg-12 col-12 m-t-0 m-r-0 m-b-5 m-l-0" style="padding:0 0 0 5px;">
                    <div class="btn-group" style="margin:0;padding:0;width:100%">
                        <a ng-repeat="(ki, vi) in data_hardware.detail['waterlevel']['properties']['color_step']" class="btn btn-{{vi}} btn-xs p-0 m-0 text-center" style="font-size:15px;width:25%">{{ data_hardware . detail['waterlevel']['properties']['value_step'][ki] }}</a>
                    </div>
                </div>

                <div class="col-lg-12 col-12 m-0" style="padding:0 5px 0 5px;">
                    <span style="font-size:18px" class="text-primary">status sirine : </span>
                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="text-success">OFF</span>

                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="text-success">MENUNGGU RESPON</span>

                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1 && data_hardware.detail_ews[0].ews_sirine_level == 8" class="text-success">ON - UJI SIRINE</span>
                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1 && data_hardware.detail_ews[0].ews_sirine_level == 9" class="text-success">ON - KEMBALI NORMAL</span>

                    <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="text-success">MENUNGGU RESPON</span>


                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || ews_sirine == NULL) && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="text-danger">OFF</span>
                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="text-danger">MENUNGGU RESPON</span>

                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1 && data_hardware.detail_ews[0].ews_sirine_level == 1" class="text-danger">ON - KUNING (WASPADA)</span>
                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1 && data_hardware.detail_ews[0].ews_sirine_level == 2" class="text-danger">ON - ORANGE (SIAGA)</span>
                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1 && data_hardware.detail_ews[0].ews_sirine_level == 3" class="text-danger">ON - MERAH (WASPADA)</span>

                    <span style="font-size:18px" ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && data_hardware.detail_ews[0].ews_sirine == 0 && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="text-danger">MENUNGGU RESPON</span>

                </div>
                
                <div class="col-lg-12 col-12 m-b-0" style="border:none;padding:0 5px 0 5px;">
                    <div class="col-lg-2 col-2 m-0 p-0">
                        <span ng-if="data_hardware.detail['waterlevel'].status == 'normal'" class="loader1a"></span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 3" class="loader1b_yellow"></span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].alarm_status == 4" class="loader1b_orange"></span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && (data_hardware.detail['waterlevel'].alarm_status >= 5 && data_hardware.detail['waterlevel'].alarm_status < 8)" class="loader1b_red"></span>
                    </div>
                    <div class="col-lg-10 col-10 m-0 p-t-5 p-r-0 p-b-5 p-l-5 text-right">
                        <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" role="button" ng-click="oEwsNormal(data_hardware.hardware,'on')" class="btn btn-success text-white p-5" style="font-size:18px;" role="button"><i class="fa fa-thumbs-up"></i>&nbsp; Uji coba / Pemberitahuan</span>

                        <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="btn btn-success text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsCancel(data_hardware.hardware,'off')"><i class="fa fa-refresh fa-spin"></i>&nbsp; Perintah dikirim ! Batalkan ?</span>
                        
                        <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="btn btn-success text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsOff(data_hardware.hardware,'off')"><i class="fa fa-volume-up"></i>&nbsp; Sirine dinyalakan ! Matikan ?</span>

                        <span ng-if="data_hardware.detail['waterlevel'].status == 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="btn btn-success text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsOff(data_hardware.hardware,'off')"><i class="fa fa-refresh fa-spin"></i>&nbsp; Proses mematikan sirine</span>

                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && (data_hardware.detail_ews[0].ews_sirine == 0 || data_hardware.detail_ews[0].ews_sirine == NULL) && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="btn btn-danger text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsOn(data_hardware.hardware,'on')"><i class="fa fa-warning"></i>&nbsp; Nyalakan sirine !</span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && (data_hardware.detail_ews[0].ews_sirine_reply == 0 || data_hardware.detail_ews[0].ews_sirine_reply == NULL)" class="btn btn-danger text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsCancel(data_hardware.hardware,'off')"><i class="fa fa-refresh fa-spin"></i>&nbsp; Perintah dikirim ! Batalkan ?</span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'on' && data_hardware.detail_ews[0].ews_sirine == 1 && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="btn btn-danger text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsOff(data_hardware.hardware,'off')"><i class="fa fa-volume-up"></i>&nbsp; Sirine dinyalakan ! Matikan ?</span>
                        <span ng-if="data_hardware.detail['waterlevel'].status != 'normal' && data_hardware.detail['waterlevel'].btn_status == 'off' && data_hardware.detail_ews[0].ews_sirine == 0 && data_hardware.detail_ews[0].ews_sirine_reply == 1" class="btn btn-danger text-white p-5" style="font-size:18px;" role="button" ng-click="oEwsOff(data_hardware.hardware,'off')"><i class="fa fa-refresh fa-spin"></i>&nbsp; Proses mematikan sirine</span>

                    </div>
                </div>
                <div class="col-lg-12 col-12 m-0 text-right" style="border:none;padding:10px 5px 10px 5px;">
                    <span class="text-primary" style="font-size:13px">Tinggi permukaan air selama 12 jam terakhir</span>
                </div>
                <div class="col-lg-12 col-12 m-0" style="border:none;padding:0 5px 0 5px;">
                    <canvas ng-if="dataRealGraph != ''" id="lineGraph" style="width:100%;height:100%;"></canvas>
                    <h5 class="text-danger text-bold text-center" ng-if="dataRealGraph == ''" style="width:100%;height:100%;">
                        Tidak ada data yang terkirim dalam 12 jam terakhir
                    </h5>
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
                $scope.hid = "<?php echo e($request->id); ?>";

                $scope.oViewSingle = function() {
                    SfService.httpGet("trs_local_trs_view_sk_data", {
                        plant: $scope.f.plant,
                        hid: $scope.hid
                    }, function(jdata) {
                        $scope.data_hardware = jdata.data.dataHardware;
                        $scope.running_text = jdata.data.runningText;
                        $scope.notif_text = jdata.data.notifText;
                        $scope.dataRealGraph = jdata.data.dataRealGraph;
                        $scope.time = jdata.data.time;

                        $scope.words = [];
                        angular.forEach($scope.running_text, function(item, i) {
                            $scope.words.push(item.data_view);
                        });
                        $scope.part,
                        $scope.i = 0,
                        $scope.offset = 0,
                        $scope.len = $scope.words.length,
                        $scope.forwards = true,
                        $scope.skip_count = 0,
                        $scope.skip_delay = 30,
                        $scope.speed = 150;
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

                        $scope.labelGraph = [];
                        $scope.dataValue = [];
                        angular.forEach($scope.dataRealGraph, function(item, i) {
                            $scope.labelGraph.push(moment.unix(item.label));
                            $scope.dataValue.push(item.value);
                        });

                        $scope.ctx = document.getElementById('lineGraph');
                        $scope.myChart = new Chart($scope.ctx, {
                            type: 'line',
                            data: {
                                labels: $scope.labelGraph,
                                datasets: [{
                                    // backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    // borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 0.5,
                                    pointRadius: 0,
                                    lineTension: 0,
                                    fill: true,
                                    label: "Water Level (" + $scope.dataRealGraph[0].units + ")",
                                    data: $scope.dataValue,
                                }]
                            },
                            options: {
                                animation: false,
                                responsive: true,
                                title: {
                                    display: false,
                                    text: '-',
                                    fontSize: 12,
                                    padding: 2
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            fontSize: 8,
                                        },
                                    }],
                                    xAxes: [{
                                        type: 'time',
                                        autoSkip: false,
                                        time: {
                                            unit: 'hour',
                                            unitStepSize: 1,
                                            displayFormats: {
                                                millisecond: 'HH:mm:ss.SSS',
                                                second: 'HH:mm:ss',
                                                minute: 'HH:mm',
                                                hour: 'HH:00'
                                            },
                                            min: $scope.time.min_time,
                                            max: $scope.time.max_time,
                                        },
                                        ticks: {
                                            fontSize: 8
                                        }
                                    }]
                                },
                                legend: {
                                    display: false,
                                    labels: {
                                        boxWidth: 10,
                                        fontSize: 10
                                    }
                                }
                            },
                        });
                    });
                }

                $scope.oEwsNormal = function (hardware, btn_status) {
                    (async () => {
                        const inputOptions = new Promise((resolve) => {
                            setTimeout(() => {
                                resolve({'8': 'Uji coba sirine', '9': 'Status kembali normal' })
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
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&bs=' + btn_status + '&sl=' + sirine_level + '&st=up';
                            // Swal.fire({ html: `Sirine tipe ${sirine_level} telah dikirim !` })
                            Swal.fire('Perintah dikirim !', '', 'success')
                        }

                    })()
                }

                $scope.oEwsOn = function (hardware, btn_status) {
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
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&bs=' + btn_status + '&sl=' + sirine_level + '&st=up';
                            // Swal.fire({ html: `Sirine tipe ${sirine_level} telah dikirim !` })
                            Swal.fire('Perintah berhasil dikirim !', '', 'success')
                        }

                    })()
                }

                $scope.oEwsCancel = function (hardware, btn_status) {
                    Swal.fire({
                        title: 'Perintah akan dibatalkan ?',
                        // text: "You won't be able to revert this!",
                        // icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#008A8A',
                        cancelButtonColor: '#FF3B3F',
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value == true) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&bs=' + btn_status + '&st=break';
                            Swal.fire('', 'Perintah berhasil dibatalkan !', 'success')
                        }
                    })
                }

                $scope.oEwsOff = function (hardware, btn_status) {
                    Swal.fire({
                        title: 'Sirine Siaga akan dimatikan ?',
                        // text: "You won't be able to revert this!",
                        // icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#008A8A',
                        cancelButtonColor: '#FF3B3F',
                        confirmButtonText: 'Ya, matikan',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value == true) {
                            window.location = 'trs_local_trs_ews_status?hc=' + hardware + '&bs=' + btn_status + '&st=down';
                            Swal.fire('', 'Sirine berhasil dimatikan !', 'success')
                        }
                    })
                }

                $scope.oCompress = function() {
                    window.location = 'trs_local_trs_view_ak';
                }

                $scope.moment = function(dt) {
                    return moment(dt);
                }

                $scope.moment = function(dt) {
                    return moment(dt);
                }

                $scope.oViewSingle();
                $interval(function() {
                    $scope.oViewSingle();
                }, 30000);

            }
        ]);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.colorreport_blank', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kalsel\psda\admin\backend\resources\views/trs/local/trs_view/trs_view_single_kab_frm.blade.php ENDPATH**/ ?>