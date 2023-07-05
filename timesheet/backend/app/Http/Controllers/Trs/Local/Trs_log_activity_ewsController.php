<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Trs_log_activity_ews;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_ews;
use App\Sf;
use DB;
use Illuminate\Http\Request;
use PDF;

class Trs_log_activity_ewsController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_trs_log_activity_ews', 'Trs_log_activity_ewsController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.trs_log_activity_ews.trs_log_activity_ews_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_TRS_LOG_EWS_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $time1 = $request->t1;
        $time2 = $request->t2;
        $request->q = str_replace(' ', '%', $request->q);
        $data = Trs_log_activity_ews::where(function ($q) use ($request) {
                $q->orWhere('ews_id', 'like', '%' . @$request->q . '%');
                $q->orWhere('ews_location', 'like', '%' . @$request->q . '%');
            })
            ->with('rel_ews_id')
            ->with('rel_kd_hardware')
            ->whereBetween('ews_tlocal', [$time1, $time2])
            ->orderBy('id', 'DESC');
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        if ($request->ewsid != '' || $request->ewsid != null) {
            $data = $data->where('ews_id', $request->ewsid);
        }
        $data = $request->vq != '' || $request->vq != null ? $data->where('sender', $request->vq) : $data->where('sender', 'device');
        if ($request->plant != '002') {
            $cek_hardware = Mst_hardware::select('kd_hardware')->where('plant', $request->plant)->get();
            $kd_hardware = [];
            foreach($cek_hardware as $k1 => $v1) {
                $kd_hardware[] = $v1->kd_hardware;
            }
            $cek_ews = Mst_hardware_ews::whereIn('kd_hardware', $kd_hardware)->get();
            $ews_id = [];
            foreach($cek_ews as $k1 => $v1) {
                $ews_id[] = $v1->ews_id;
            }
            $data = $data->whereIn('ews_id', $ews_id);
        }

        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function edit($id)
    {
        $h = Trs_log_activity_ews::where('id', $id)->withTrashed()->first();
        $h->ews = $h->rel_ews_id;
        $h->hardware = $h->rel_kd_hardware;
        return response()->json(compact(['h']));
    }
}
