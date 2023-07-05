<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Mst_hardware_d2;
use App\Model\Trs\Local\Mst_ews;
use App\Model\Trs\Local\Mst_sensor;
use App\Model\Trs\Local\Trs_raw_d_img;
use App\Model\Trs\Local\Trs_log_activity_ews;
use App\Sf;
use DB;
use Illuminate\Http\Request;

class Trs_viewController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_trs_raw', 'Trs_viewController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.trs_view.trs_view_all_prov_frm', compact(['request', 'plant']));
    }

    public function getCheckAllData(Request $request) {
        $q_cek_ews_date = Mst_ews::select('mst_ews.ews_id', 'mst_ews.kd_hardware', 'mst_ews.ews_sirine', 'mst_ews.ews_sirine_time', 'mst_ews.ews_sirine_reply', 'mst_ews.ews_sirine_reply_time', 'mst_ews.ews_status', 'd1.kd_hardware', 'd1.alarm_status', 'd1.btn_status', 'd1.btn_type')
        ->join(DB::raw('mst_hardware_d1 as d1'), 'd1.kd_hardware', '=', 'mst_ews.kd_hardware')
        ->where('d1.kd_sensor', 'waterlevel')
        ->get();
        foreach($q_cek_ews_date as $k => $v) {
            if($v->btn_status == 'off' && $v->btn_type == 1 && $v->ews_sirine == 0 && $v->ews_sirine_reply == 0 && $v->ews_status == 'normal' && $v->alarm_status > 2) {
                Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_reply' => 0, 'ews_status' => 'warning', 'ews_sirine_level' => 0]);
                Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 1]);
            }
            if($v->btn_status == 'on' && $v->btn_type == 2 && $v->ews_sirine == 1 && $v->ews_sirine_reply == 0 && $v->ews_status == 'onproccess' && $v->ews_sirine_time < date('Y-m-d H:i:s')) {
                Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_reply' => 0, 'ews_status' => 'failed']);
                Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 3]);
                Trs_log_activity_ews::insert(['ews_id' => $v->ews_id, 'sender' => 'system', 'send_direct' => 2, 'send_type' => 0, 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_message' => 'Control EWS Failed', 'kd_hardware' => $v->kd_hardware, 'created_at' => date('Y-m-d H:i:s')]);
            }
            if($v->btn_status == 'on' && $v->btn_type == 4 && $v->ews_sirine == 1 && $v->ews_sirine_reply == 1 && $v->ews_status == 'on' && $v->ews_sirine_reply_time < date('Y-m-d H:i:s')) {
                Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_time' => date('Y-m-d H:i:s', strtotime("+5 min")), 'ews_sirine_reply' => 1, 'ews_status' => 'offproccess', 'ews_sirine_level' => 0]);
                Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 5]);
            }
            if($v->btn_status == 'off' && $v->btn_type == 5 && $v->ews_sirine == 0 && $v->ews_sirine_reply == 1 && $v->ews_status == 'offproccess' && $v->ews_sirine_time < date('Y-m-d H:i:s')) {
                Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_reply' => 1, 'ews_status' => 'failed', 'ews_sirine_level' => 0]);
                Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 6]);
                Trs_log_activity_ews::insert(['ews_id' => $v->ews_id, 'sender' => 'system', 'send_direct' => 2, 'send_type' => 0, 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_message' => 'Control EWS Failed', 'kd_hardware' => $v->kd_hardware, 'created_at' => date('Y-m-d H:i:s')]);
            }
            if($v->alarm_status <= 2 && $v->ews_status == 'warning') {
                if($v->ews_sirine_level != 8 || $v->ews_sirine_level != 9) {
                    Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0,  'ews_sirine_reply' => 0, 'ews_status' => 'normal', 'ews_sirine_level' => 0]);
                    Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 1]);
                }
            }
            if($v->alarm_status <= 2 && $v->btn_status == 'off' && $v->btn_type == 5 && $v->ews_sirine == 0 && $v->ews_sirine_reply == 0 && $v->ews_status == 'offproccess') {
                if($v->ews_sirine_level != 8 || $v->ews_sirine_level != 9) {
                    Mst_ews::where('ews_id', $v->ews_id)->update(['ews_sirine' => 0,  'ews_sirine_reply' => 0, 'ews_status' => 'normal', 'ews_sirine_level' => 0]);
                    Mst_hardware_d1::where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 1]);
                }
            }
        }
    }

    public function getAllprov(Request $request) {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_view.trs_view_all_prov_frm', compact(['request', 'plant']));
    }
    public function getAllprovData(Request $request) {
        $plant = $request->plant;
        if($plant == '002'){
            $qh = Mst_hardware::select('kd_hardware', 'uid', 'location', 'pos_name', 'latitude', 'longitude', 'condition', 'tlocal', 'plant')->where('kd_logger', '9')->get();
            $q_notif = Mst_hardware_d1::select('kd_sensor', 'alarm_status')->where('alarm_status', '>=', 3)->where('kd_sensor', 'waterlevel')->count();
            if($q_notif > 0){
                $notifText = [];
                foreach ($qh as $k => $v) {
                    $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->where('alarm_status', '>=', 3)->get();
                    foreach ($qd1 as $k1 => $v1) {
                        if($v1->alarm_status == 3) {
                            $notifText[$k]['status'] = '1';
                            $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : KUNING WSPDA' : $v->pos_name . ' : KUNING WSPDA';
                        } else if($v1->alarm_status == 4) {
                            $notifText[$k]['status'] = '2';
                            $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : ORANGE SIAGA' : $v->pos_name . ' : ORANGE SIAGA';
                        } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                            $notifText[$k]['status'] = '3';
                            $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : MERAH AWAS' : $v->pos_name . ' : MERAH AWAS';
                        } else if($v1->alarm_status == 8) {
                            $notifText[$k]['status'] = '8';
                            $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : UJI SIRINE' : $v->pos_name . ' : UJI SIRINE';
                        } else if($v1->alarm_status == 9) {
                            $notifText[$k]['status'] = '9';
                            $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : AMAN' : $v->pos_name . ' : AMAN';
                        }
                    }
                }
            } else {
                $notifText = [];
                foreach ($qh as $k => $v) {
                    $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('alarm_status', '<', 3)->where('kd_sensor', 'waterlevel')->get();
                    foreach ($qd1 as $k1 => $v1) {
                        $notifText[$k]['status'] = "normal";
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : LEVEL NORMAL' : $v->pos_name . ' : LEVEL NORMAL';
                    }
                }
            }
            $runningText = [];
            foreach ($qh as $k => $v) {
                $runningText[$k]['location'] = $v->location;
                $runningText[$k]['pos_name'] = $v->pos_name;
                $runningText[$k]['latitude'] = $v->latitude;
                $runningText[$k]['longitude'] = $v->longitude;
                $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->get();
                foreach ($qd1 as $k1 => $v1) {
                    $runningText[$k]['detail']['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
                    $runningText[$k]['detail']['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
                    $runningText[$k]['detail']['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
                    $runningText[$k]['detail']['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
                    $runningText[$k]['detail']['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
                    $runningText[$k]['detail']['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
                    $runningText[$k]['detail']['level0'] = $v1->level0 == null ? 0 : $v1->level0;
                    $runningText[$k]['detail']['level1'] = $v1->level1 == null ? 10 : $v1->level1;
                    $runningText[$k]['detail']['level2'] = $v1->level2 == null ? 20 : $v1->level2;
                    $runningText[$k]['detail']['level3'] = $v1->level3 == null ? 30 : $v1->level3;
                    $runningText[$k]['detail']['level4'] = $v1->level4 == null ? 40 : $v1->level4;
                }
            }
            $dataHardware = [];
            foreach ($qh as $k => $v) {
                $dataHardware[$k]['hardware'] = $v->kd_hardware;
                $dataHardware[$k]['uid'] = $v->uid;
                $dataHardware[$k]['location'] = strlen($v->location) > 31 ? substr($v->location, 0, 31). ' ...' : $v->location;
                $dataHardware[$k]['pos_name'] = strlen($v->pos_name) > 31 ? substr($v->pos_name, 0, 31). ' ...' : $v->pos_name;
                $dataHardware[$k]['latitude'] = $v->latitude;
                $dataHardware[$k]['longitude'] = $v->longitude;
                $dataHardware[$k]['condition'] = $v->condition;
                $dataHardware[$k]['time_local'] = date("d/m/'y H:i", strtotime($v->tlocal));
                $dataHardware[$k]['plant'] = $v->plant;
                $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'btn_status', 'btn_type', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->get();
                foreach ($qd1 as $k1 => $v1) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['btn_status'] = $v1->btn_status == null ? 'off' : $v1->btn_status;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['btn_type'] = $v1->btn_type;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['level0'] = $v1->level0 == null ? 0 : $v1->level0;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['level1'] = $v1->level1 == null ? 10 : $v1->level1;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['level2'] = $v1->level2 == null ? 20 : $v1->level2;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['level3'] = $v1->level3 == null ? 30 : $v1->level3;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['level4'] = $v1->level4 == null ? 40 : $v1->level4;
                    if($v1->alarm_status < 3){
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'normal';
                    } else if($v1->alarm_status == 3) {
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'KUNING WSPDA';
                    } else if($v1->alarm_status == 4) {
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'ORANGE SIAGA';
                    } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'MERAH AWAS';
                    } else if($v1->alarm_status == 8) {
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'UJI SIRINE';
                    } else if($v1->alarm_status == 9) {
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'AMAN';
                    }
                    $qdp = Mst_hardware_d2::select('count_step', 'val_step', 'color_step')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', $v1->kd_sensor)->get();
                    foreach($qdp as $k2 => $v2) {
                        $data_step1 = $v1->level0 . ',' . $v1->level2 . ',' . $v1->level3 . ',' . $v1->level4;
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['properties']['value_step'] = explode(",", $data_step1);
                        $data_step2 = 'hijau,kuning,oranye,merah';
                        $dataHardware[$k]['detail'][$v1->kd_sensor]['properties']['color_step'] = explode(",", $data_step2);
                    }
                }
                $qews = Mst_ews::select('ews_sirine', 'ews_sirine_reply', 'ews_status', 'ews_sirine_level', 'ews_location')->where('kd_hardware', $v->kd_hardware)->get();
                foreach ($qews as $k1 => $v1) {
                    $dataHardware[$k]['detail_ews'][$k1] = $v1;
                }
                $dataHardware[$k]['device_img'] = Trs_raw_d_img::select('date_capture', 'img_name', 'latitude', 'longitude')->where('kd_hardware', $v->kd_hardware)->orderBy('id', 'DESC')->first();
            }
        }
        return response()->json(compact(['runningText', 'dataHardware', 'q_notif', 'notifText']));
    }

    public function getSingleprov(Request $request) {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_view.trs_view_single_prov_frm', compact(['request', 'plant']));
    }
    public function getSingleprovData(Request $request) {
        $plant = $request->plant;
        $hardware = $request->hid;
        if($plant == '002'){
            $qh = Mst_hardware::select('kd_hardware', 'uid', 'location', 'pos_name', 'latitude', 'longitude', 'condition', 'tlocal', 'plant')->where('kd_logger', '9')->where('kd_hardware', $hardware)->first();            
            $q_notif = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->where('kd_sensor', 'waterlevel')->first();
            if($q_notif->alarm_status >= 3){
                if($q_notif->alarm_status == 3) {
                    $notifText = '1';
                } else if($q_notif->alarm_status == 4) {
                    $notifText = '2';
                } else if($q_notif->alarm_status >= 5 || $q_notif->alarm_status < 8) {
                    $notifText = '3';
                } else if($q_notif->alarm_status == 8) {
                    $notifText = '8';
                } else if($q_notif->alarm_status == 9) {
                    $notifText = '9';
                }
            } else {
                $notifText = "normal";
            }
            $qd1_rt = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->get();
            foreach ($qd1_rt as $k => $v) {
                $qs = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v->kd_sensor)->first();
                $runningText[$k]['data_view'] = $qs->sensor_name . ' : ' . number_format($v->value,1, ",", ".") . ' ' .$qs->units;
            }
            $dataHardware['hardware'] = $qh->kd_hardware;
            $dataHardware['uid'] = $qh->uid;
            $dataHardware['location'] = strlen($qh->location) > 100 ? substr($qh->location, 0, 100). ' ...' : $qh->location;
            $dataHardware['pos_name'] = strlen($qh->pos_name) > 100 ? substr($qh->pos_name, 0, 100). ' ...' : $qh->pos_name;
            $dataHardware['latitude'] = $qh->latitude;
            $dataHardware['longitude'] = $qh->longitude;
            $dataHardware['condition'] = $qh->condition;
            $dataHardware['time_local'] = date("d/m/'y H:i", strtotime($qh->tlocal));;
            $dataHardware['plant'] = $qh->plant;
            $qd1_dt = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'btn_status', 'btn_type', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->get();
            foreach ($qd1_dt as $k1 => $v1) {
                $dataHardware['detail'][$v1->kd_sensor]['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
                $dataHardware['detail'][$v1->kd_sensor]['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
                $dataHardware['detail'][$v1->kd_sensor]['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
                $dataHardware['detail'][$v1->kd_sensor]['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
                $dataHardware['detail'][$v1->kd_sensor]['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
                $dataHardware['detail'][$v1->kd_sensor]['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
                $dataHardware['detail'][$v1->kd_sensor]['btn_status'] = $v1->btn_status == null ? 'off' : $v1->btn_status;
                $dataHardware['detail'][$v1->kd_sensor]['btn_type'] = $v1->btn_type;
                $dataHardware['detail'][$v1->kd_sensor]['level0'] = $v1->level0 == null ? 0 : $v1->level0;
                $dataHardware['detail'][$v1->kd_sensor]['level1'] = $v1->level1 == null ? 10 : $v1->level1;
                $dataHardware['detail'][$v1->kd_sensor]['level2'] = $v1->level2 == null ? 20 : $v1->level2;
                $dataHardware['detail'][$v1->kd_sensor]['level3'] = $v1->level3 == null ? 30 : $v1->level3;
                $dataHardware['detail'][$v1->kd_sensor]['level4'] = $v1->level4 == null ? 40 : $v1->level4;
                if($v1->alarm_status < 3){
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'normal';
                } else if($v1->alarm_status == 3) {
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'KUNING WSPDA';
                } else if($v1->alarm_status == 4) {
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'ORANGE SIAGA';
                } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'MERAH AWAS';
                } else if($v1->alarm_status == 8) {
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'UJI SIRINE';
                } else if($v1->alarm_status == 9) {
                    $dataHardware['detail'][$v1->kd_sensor]['status'] = 'AMAN';
                }
                $qdp = Mst_hardware_d2::select('count_step', 'val_step', 'color_step')->where('kd_hardware', $hardware)->where('kd_sensor', $v1->kd_sensor)->get();
                foreach($qdp as $k2 => $v2) {
                    $data_step1 = $v1->level0 . ',' . $v1->level2 . ',' . $v1->level3 . ',' . $v1->level4;
                    $dataHardware['detail'][$v1->kd_sensor]['properties']['value_step'] = explode(",", $data_step1);
                    $data_step2 = 'hijau,kuning,oranye,merah';
                    $dataHardware['detail'][$v1->kd_sensor]['properties']['color_step'] = explode(",", $data_step2);
                }
                $qews = Mst_ews::select('ews_sirine', 'ews_sirine_reply', 'ews_status', 'ews_sirine_level', 'ews_location')->where('kd_hardware', $hardware)->get();
                foreach ($qews as $k2 => $v2) {
                    $dataHardware['detail_ews'][$k2] = $v2;
                }
                $dataHardware['device_img'] = Trs_raw_d_img::select('date_capture', 'img_name', 'latitude', 'longitude')->where('kd_hardware', $hardware)->orderBy('id', 'DESC')->first();
            }
            $time1 = date("Y-m-d H:i:s", strtotime('-12 hour'));
            $time2 = date("Y-m-d H:i:s");
            $q_all = "SELECT a.`id`, UNIX_TIMESTAMP(a.`tlocal`) AS `ts`, a.`tlocal`, b.`value`, b.`tlocal`, c.`nm_sensor`, c.`satuan`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_gpa b ON b.h_id = a.id
                INNER JOIN mst_sensor c ON c.kd_sensor = b.kd_sensor
                WHERE a.`kd_hardware` = '" . $hardware . "' AND b.`kd_sensor` = 'waterlevel'
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                ORDER BY a.`tlocal` ASC";
            $raw_all = DB::select(DB::raw($q_all));
            $dataRealGraph = [];
            foreach ($raw_all as $k => $v) {
                $dataRealGraph[$k]['sensor'] = $v->nm_sensor;
                $dataRealGraph[$k]['units'] = $v->satuan;
                $dataRealGraph[$k]['label'] = $v->ts;
                $dataRealGraph[$k]['value'] = number_format($v->value,1, ",", ".");
            }
            $time['min_time'] = $time1;
            $time['max_time'] = $time2;
        }
        return response()->json(compact(['runningText', 'dataHardware', 'notifText', 'time', 'dataRealGraph']));
    }

    public function getAllkab(Request $request) {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_view.trs_view_all_kab_frm', compact(['request', 'plant']));
    }
    public function getAllkabData(Request $request) {
        $plant = $request->plant;
        $qh = Mst_hardware::select('kd_hardware', 'uid', 'location', 'pos_name', 'latitude', 'longitude', 'condition', 'tlocal', 'plant')->where('kd_logger', '9')->where('plant', $plant)->get();
        $arr_hardware = [];
        foreach ($qh as $key => $value) {
            $arr_hardware[] = $value->kd_hardware;
        }
        $q_notif = Mst_hardware_d1::select('kd_sensor', 'alarm_status')->where('alarm_status', '>=', 3)->whereIn('kd_hardware', $arr_hardware)->where('kd_sensor', 'waterlevel')->count();
        if($q_notif > 0){
            $notifText = [];
            foreach ($qh as $k => $v) {
                $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->where('alarm_status', '>=', 3)->get();
                foreach ($qd1 as $k1 => $v1) {
                    if($v1->alarm_status == 3) {
                        $notifText[$k]['status'] = '1';
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : KUNING WSPDA' : $v->pos_name . ' : KUNING WSPDA';
                    } else if($v1->alarm_status == 4) {
                        $notifText[$k]['status'] = '2';
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : ORANGE SIAGA' : $v->pos_name . ' : ORANGE SIAGA';
                    } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                        $notifText[$k]['status'] = '3';
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : MERAH AWAS' : $v->pos_name . ' : MERAH AWAS';
                    } else if($v1->alarm_status == 8) {
                        $notifText[$k]['status'] = '8';
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : UJI SIRINE' : $v->pos_name . ' : UJI SIRINE';
                    } else if($v1->alarm_status == 9) {
                        $notifText[$k]['status'] = '9';
                        $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : AMAN' : $v->pos_name . ' : AMAN';
                    }
                }
            }
        } else {
            $notifText = [];
            foreach ($qh as $k => $v) {
                $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('alarm_status', '<', 3)->where('kd_sensor', 'waterlevel')->get();
                foreach ($qd1 as $k1 => $v1) {
                    $notifText[$k]['status'] = "normal";
                    $notifText[$k]['vstatus'] = strlen($v->pos_name) > 19 ? substr($v->pos_name, 0, 19) . ' .. : LEVEL NORMAL' : $v->pos_name . ' : LEVEL NORMAL';
                }
            }
        }
        $runningText = [];
        foreach ($qh as $k => $v) {
            $runningText[$k]['location'] = $v->location;
            $runningText[$k]['pos_name'] = $v->pos_name;
            $runningText[$k]['latitude'] = $v->latitude;
            $runningText[$k]['longitude'] = $v->longitude;
            $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', 'waterlevel')->get();
            foreach ($qd1 as $k1 => $v1) {
                $runningText[$k]['detail']['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
                $runningText[$k]['detail']['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
                $runningText[$k]['detail']['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
                $runningText[$k]['detail']['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
                $runningText[$k]['detail']['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
                $runningText[$k]['detail']['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
                $runningText[$k]['detail']['level0'] = $v1->level0 == null ? 0 : $v1->level0;
                $runningText[$k]['detail']['level1'] = $v1->level1 == null ? 0 : $v1->level1;
                $runningText[$k]['detail']['level2'] = $v1->level2 == null ? 0 : $v1->level2;
                $runningText[$k]['detail']['level3'] = $v1->level3 == null ? 0 : $v1->level3;
                $runningText[$k]['detail']['level4'] = $v1->level4 == null ? 0 : $v1->level4;
            }
        }
        $dataHardware = [];
        foreach ($qh as $k => $v) {
            $dataHardware[$k]['hardware'] = $v->kd_hardware;
            $dataHardware[$k]['uid'] = $v->uid;
            $dataHardware[$k]['location'] = strlen($v->location) > 50 ? substr($v->location, 0, 50). ' ...' : $v->location;
            $dataHardware[$k]['pos_name'] = strlen($v->pos_name) > 50 ? substr($v->pos_name, 0, 50). ' ...' : $v->pos_name;
            $dataHardware[$k]['latitude'] = $v->latitude;
            $dataHardware[$k]['longitude'] = $v->longitude;
            $dataHardware[$k]['condition'] = $v->condition;
            $dataHardware[$k]['time_local'] = date("d/m/'y H:i", strtotime($v->tlocal));;
            $dataHardware[$k]['plant'] = $v->plant;
            $qd1 = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'btn_status', 'btn_type', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $v->kd_hardware)->get();
            foreach ($qd1 as $k1 => $v1) {
                $dataHardware[$k]['detail'][$v1->kd_sensor]['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
                $dataHardware[$k]['detail'][$v1->kd_sensor]['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
                $dataHardware[$k]['detail'][$v1->kd_sensor]['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
                $dataHardware[$k]['detail'][$v1->kd_sensor]['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
                $dataHardware[$k]['detail'][$v1->kd_sensor]['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
                $dataHardware[$k]['detail'][$v1->kd_sensor]['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['btn_status'] = $v1->btn_status == null ? 'off' : $v1->btn_status;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['btn_type'] = $v1->btn_type;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['level0'] = $v1->level0 == null ? 0 : $v1->level0;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['level1'] = $v1->level1 == null ? 0 : $v1->level1;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['level2'] = $v1->level2 == null ? 0 : $v1->level2;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['level3'] = $v1->level3 == null ? 0 : $v1->level3;
                $dataHardware[$k]['detail'][$v1->kd_sensor]['level4'] = $v1->level4 == null ? 0 : $v1->level4;
                if($v1->alarm_status < 3){
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'normal';
                } else if($v1->alarm_status == 3) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'KUNING WSPDA';
                } else if($v1->alarm_status == 4) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'ORANGE SIAGA';
                } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'MERAH AWAS';
                } else if($v1->alarm_status == 8) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'UJI SIRINE';
                } else if($v1->alarm_status == 9) {
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['status'] = 'AMAN';
                }
                $qdp = Mst_hardware_d2::select('count_step', 'val_step', 'color_step')->where('kd_hardware', $v->kd_hardware)->where('kd_sensor', $v1->kd_sensor)->get();
                foreach($qdp as $k2 => $v2) {
                    $data_step1 = $v1->level0 . ',' . $v1->level2 . ',' . $v1->level3 . ',' . $v1->level4;
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['properties']['value_step'] = explode(",", $data_step1);
                    $data_step2 = 'hijau,kuning,oranye,merah';
                    $dataHardware[$k]['detail'][$v1->kd_sensor]['properties']['color_step'] = explode(",", $data_step2);
                }
            }
            $qews = Mst_ews::select('ews_sirine', 'ews_sirine_reply', 'ews_status', 'ews_sirine_level', 'ews_location')->where('kd_hardware', $v->kd_hardware)->get();
            foreach ($qews as $k1 => $v1) {
                $dataHardware[$k]['detail_ews'][$k1] = $v1;
            }
            $dataHardware[$k]['device_img'] = Trs_raw_d_img::select('date_capture', 'img_name', 'latitude', 'longitude')->where('kd_hardware', $v->kd_hardware)->orderBy('id', 'DESC')->first();
        }
        return response()->json(compact(['runningText', 'dataHardware', 'q_notif', 'notifText']));
    }

    public function getSinglekab(Request $request) {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_view.trs_view_single_kab_frm', compact(['request', 'plant']));
    }
    public function getSinglekabData(Request $request) {
        $plant = $request->plant;
        $hardware = $request->hid;        
        $qh = Mst_hardware::select('kd_hardware', 'uid', 'location', 'pos_name', 'latitude', 'longitude', 'condition', 'tlocal', 'plant')->where('kd_logger', '9')->where('kd_hardware', $hardware)->first();        
        $q_notif = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->where('kd_sensor', 'waterlevel')->first();
        if($q_notif->alarm_status >= 3){
            if($q_notif->alarm_status == 3) {
                $notifText = '1';
            } else if($q_notif->alarm_status == 4) {
                $notifText = '2';
            } else if($q_notif->alarm_status >= 5 && $q_notif->alarm_status < 8) {
                $notifText = '3';
            } else if($q_notif->alarm_status == 8) {
                $notifText = '8';
            } else if($q_notif->alarm_status == 9) {
                $notifText = '9';
            }
        } else {
            $notifText = "normal";
        }
        $qd1_rt = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->get();
        foreach ($qd1_rt as $k => $v) {
            $qs = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v->kd_sensor)->first();
            $runningText[$k]['data_view'] = $qs->sensor_name . ' : ' . number_format($v->value,1, ",", ".") . ' ' .$qs->units;
        }
        $dataHardware['hardware'] = $qh->kd_hardware;
        $dataHardware['uid'] = $qh->uid;
        $dataHardware['location'] = strlen($qh->location) > 100 ? substr($qh->location, 0, 100). ' ...' : $qh->location;
        $dataHardware['pos_name'] = strlen($qh->pos_name) > 100 ? substr($qh->pos_name, 0, 100). ' ...' : $qh->pos_name;
        $dataHardware['latitude'] = $qh->latitude;
        $dataHardware['longitude'] = $qh->longitude;
        $dataHardware['condition'] = $qh->condition;
        $dataHardware['time_local'] = date("d/m/'y H:i", strtotime($qh->tlocal));;
        $dataHardware['plant'] = $qh->plant;
        $qd1_dt = Mst_hardware_d1::select('kd_sensor', 'value', 'val_cum', 'val_min', 'val_max', 'alarm_status', 'btn_status', 'btn_type', 'level0', 'level1', 'level2', 'level3', 'level4')->where('kd_hardware', $hardware)->get();        
        foreach ($qd1_dt as $k1 => $v1) {
            $dataHardware['detail'][$v1->kd_sensor]['sensor'] = Mst_sensor::select('nm_sensor as sensor_name', 'satuan as units')->where('kd_sensor', $v1->kd_sensor)->first();
            $dataHardware['detail'][$v1->kd_sensor]['value'] = $v1->value == null ? 0 : number_format($v1->value,1, ",", ".");
            $dataHardware['detail'][$v1->kd_sensor]['val_cum'] = $v1->val_cum == null ? 0 : number_format($v1->val_cum,1, ",", ".");
            $dataHardware['detail'][$v1->kd_sensor]['val_min'] = $v1->val_min == null ? 0 : number_format($v1->val_min,1, ",", ".");
            $dataHardware['detail'][$v1->kd_sensor]['val_max'] = $v1->val_max == null ? 0 : number_format($v1->val_max,1, ",", ".");
            $dataHardware['detail'][$v1->kd_sensor]['alarm_status'] = $v1->alarm_status == null ? 0 : $v1->alarm_status;
            $dataHardware['detail'][$v1->kd_sensor]['btn_status'] = $v1->btn_status == null ? 'off' : $v1->btn_status;
            $dataHardware['detail'][$v1->kd_sensor]['btn_type'] = $v1->btn_type;
            $dataHardware['detail'][$v1->kd_sensor]['level0'] = $v1->level0 == null ? 0 : $v1->level0;
            $dataHardware['detail'][$v1->kd_sensor]['level1'] = $v1->level1 == null ? 0 : $v1->level1;
            $dataHardware['detail'][$v1->kd_sensor]['level2'] = $v1->level2 == null ? 0 : $v1->level2;
            $dataHardware['detail'][$v1->kd_sensor]['level3'] = $v1->level3 == null ? 0 : $v1->level3;
            $dataHardware['detail'][$v1->kd_sensor]['level4'] = $v1->level4 == null ? 0 : $v1->level4;
            if($v1->alarm_status < 3){
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'normal';
            } else if($v1->alarm_status == 3) {
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'KUNING WSPDA';
            } else if($v1->alarm_status == 4) {
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'ORANGE SIAGA';
            } else if($v1->alarm_status >= 5 && $v1->alarm_status < 8) {
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'MERAH AWAS';
            } else if($v1->alarm_status == 8) {
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'UJI SIRINE';
            } else if($v1->alarm_status == 9) {
                $dataHardware['detail'][$v1->kd_sensor]['status'] = 'AMAN';
            }
            $qdp = Mst_hardware_d2::select('count_step', 'val_step', 'color_step')->where('kd_hardware', $hardware)->where('kd_sensor', $v1->kd_sensor)->get();
            foreach($qdp as $k2 => $v2) {
                $data_step1 = $v1->level0 . ',' . $v1->level2 . ',' . $v1->level3 . ',' . $v1->level4;
                $dataHardware['detail'][$v1->kd_sensor]['properties']['value_step'] = explode(",", $data_step1);
                $data_step2 = 'hijau,kuning,oranye,merah';
                $dataHardware['detail'][$v1->kd_sensor]['properties']['color_step'] = explode(",", $data_step2);
            }
            $qews = Mst_ews::select('ews_sirine', 'ews_sirine_reply', 'ews_status', 'ews_sirine_level', 'ews_location')->where('kd_hardware', $hardware)->get();
            foreach ($qews as $k2 => $v2) {
                $dataHardware['detail_ews'][$k2] = $v2;
            }
            $dataHardware['device_img'] = Trs_raw_d_img::select('date_capture', 'img_name', 'latitude', 'longitude')->where('kd_hardware', $hardware)->orderBy('id', 'DESC')->first();
        }
        $time1 = date("Y-m-d H:i:s", strtotime('-12 hour'));
        $time2 = date("Y-m-d H:i:s");
        $q_all = "SELECT a.`id`, UNIX_TIMESTAMP(a.`tlocal`) AS `ts`, a.`tlocal`, b.`value`, b.`tlocal`, c.`nm_sensor`, c.`satuan`
            FROM trs_raw_h a
            INNER JOIN trs_raw_d_gpa b ON b.h_id = a.id
            INNER JOIN mst_sensor c ON c.kd_sensor = b.kd_sensor
            WHERE a.`kd_hardware` = '" . $hardware . "' AND b.`kd_sensor` = 'waterlevel'
            AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
            ORDER BY a.`tlocal` ASC";
        $raw_all = DB::select(DB::raw($q_all));
        $dataRealGraph = [];
        foreach ($raw_all as $k => $v) {
            $dataRealGraph[$k]['sensor'] = $v->nm_sensor;
            $dataRealGraph[$k]['units'] = $v->satuan;
            $dataRealGraph[$k]['label'] = $v->ts;
            $dataRealGraph[$k]['value'] = number_format($v->value,1, ",", ".");
        }
        $time['min_time'] = $time1;
        $time['max_time'] = $time2;
        return response()->json(compact(['runningText', 'dataHardware', 'notifText', 'time', 'dataRealGraph']));
    }
}
