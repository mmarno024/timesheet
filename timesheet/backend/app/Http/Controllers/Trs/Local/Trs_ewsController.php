<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Mst_hardware_ews;
use App\Model\Trs\Local\Mst_ews;
use App\Model\Trs\Local\Trs_log_activity_ews;
use Illuminate\Http\Request;

class Trs_ewsController extends Controller
{
    public function getStatus(Request $request)
    {
        $find_data = Mst_hardware_d1::where('kd_hardware', $request->hc)->where('kd_sensor', 'waterlevel')->first();
        $find_ews = Mst_hardware_ews::where('kd_hardware', $request->hc)->first();

        if($request->st == 'up'){
            Mst_ews::where('ews_id', $find_ews->ews_id)->update(['ews_d1_tlocal' => $find_data->actual_device, 'ews_value' => $find_data->value, 'ews_sirine' => 1, 'ews_sirine_time' => date('Y-m-d H:i:s', strtotime("+5 min")),  'ews_sirine_reply' => 0, 'ews_status' => 'onproccess', 'ews_sirine_level' => $request->sl]);
            Mst_hardware_d1::where('kd_hardware', $request->hc)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'on', 'btn_type' => 2]);
            Trs_log_activity_ews::insert(['ews_id' => $find_ews->ews_id, 'sender' => 'user', 'send_direct' => 2, 'send_type' => 0, 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_sirine_level' => $request->sl, 'ews_message' => 'Control EWS from user - On', 'kd_hardware' => $request->hc, 'created_at' => date('Y-m-d H:i:s')]);
        } else if($request->st == 'break') {
            Mst_ews::where('ews_id', $find_ews->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_time' => date('Y-m-d H:i:s'),  'ews_sirine_reply' => 0, 'ews_status' => $find_data->alarm_status > 2 ? 'warning' : 'normal', 'ews_sirine_level' => 0]);
            Mst_hardware_d1::where('kd_hardware', $request->hc)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 1]);
            Trs_log_activity_ews::insert(['ews_id' => $find_ews->ews_id, 'sender' => 'user', 'send_direct' => 2, 'send_type' => 0, 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_sirine_level' => $request->sl, 'ews_message' => 'Control EWS from user - Cancel', 'kd_hardware' => $request->hc, 'created_at' => date('Y-m-d H:i:s')]);
        } else if($request->st == 'down'){
            Mst_ews::where('ews_id', $find_ews->ews_id)->update(['ews_sirine' => 0, 'ews_sirine_time' => date('Y-m-d H:i:s', strtotime("+5 min")), 'ews_sirine_reply' => 1, 'ews_status' => 'offproccess', 'ews_sirine_level' => 0]);
            Mst_hardware_d1::where('kd_hardware', $request->hc)->where('kd_sensor', 'waterlevel')->update(['btn_status' => 'off', 'btn_type' => 5]);
            Trs_log_activity_ews::insert(['ews_id' => $find_ews->ews_id, 'sender' => 'user', 'send_direct' => 2, 'send_type' => 0, 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_sirine_level' => $request->sl, 'ews_message' => 'Control EWS from user - Off', 'kd_hardware' => $request->hc, 'created_at' => date('Y-m-d H:i:s')]);
        }
        return back();
    }
}
