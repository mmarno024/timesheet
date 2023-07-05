<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Trs_raw_d_img;
use App\Model\Trs\Local\Trs_raw_h;
use App\Model\Trs\Local\Mst_sensor;
use App\Sf;
use DB;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class Trs_timesheetController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_trs_timesheet', 'Trs_timesheetController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.trs_timesheet.trs_timesheet_frm', compact(['request', 'plant']));
    }

    // public function getList(Request $request)
    // {
    //     if (!Sf::allowed('TRS_LOCAL_TRS_RAW_R')) {
    //         return response()->json(Sf::reason(), 401);
    //     }
    //     $time1 = $request->t1;
    //     $time2 = $request->t2;
    //     $request->q = str_replace(' ', '%', $request->q);
    //     $data = Trs_raw_h::select('trs_raw_h.browser', 'trs_raw_h.buka_pintu', 'trs_raw_h.created_at', 'trs_raw_h.updated_at', 'trs_raw_h.created_by', 'trs_raw_h.id', 'trs_raw_h.sender', 'trs_raw_h.timeutc', 'trs_raw_h.timelocal', 'trs_raw_h.timestamp', 'trs_raw_h.tlocal', 'trs_raw_h.tzone', 'hard.kd_logger', 'hard.kd_hardware', 'hard.latitude', 'hard.location', 'hard.longitude', 'hard.penjumlahan', 'hard.perkalian', 'hard.plant', 'hard.pos_name')
    //     ->where('trs_raw_h.kd_logger', '!=', '5')
    //     ->where(function ($q) use ($request) {
    //         $q->orWhere('trs_raw_h.id', 'like', '%' . @$request->q . '%');
    //         $q->orWhere('trs_raw_h.kd_logger', 'like', '%' . @$request->q . '%');
    //         $q->orWhere('trs_raw_h.kd_hardware', 'like', '%' . @$request->q . '%');
    //         $q->orWhere('trs_raw_h.uid', 'like', '%' . @$request->q . '%');
    //         $q->orWhere('trs_raw_h.location', 'like', '%' . @$request->q . '%');
    //     })
    //     ->with('rel_d_gpa')
    //     ->with('rel_kd_logger')
    //     ->with('rel_plant')
    //     ->whereBetween('trs_raw_h.tlocal', [$time1, $time2])
    //     ->join(DB::raw('mst_hardware as hard'),'hard.kd_hardware', '=', 'trs_raw_h.kd_hardware')
    //     ->groupBy(['trs_raw_h.kd_hardware', 'trs_raw_h.tlocal'])
    //     ->orderBy('trs_raw_h.id', $request->order_by);
    //     if ($request->trash == 1) {
    //         $data = $data->onlyTrashed();
    //     }
    //     if ($request->plant != '002') {
    //         $data = $data->where('hard.plant', $request->plant);
    //     }
    //     if ($request->qplant != '' || $request->qplant != null) {
    //         $data = $data->where('hard.plant', $request->qplant);
    //     }
    //     if ($request->lg != '' || $request->lg != null) {
    //         $data = $data->where('trs_raw_h.kd_logger', $request->lg);
    //     }
    //     if ($request->hw != '' || $request->hw != null) {
    //         $data = $data->where('trs_raw_h.kd_hardware', $request->hw);
    //     }

    //     $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
    //     return response()->json(compact(['data']));
    // }

    // public function edit($id)
    // {
    //     $cek = Trs_raw_h::select('kd_logger')->where('id', $id)->first();
    //     $h = Trs_raw_h::where('id', $id)
    //     ->with(['rel_d_gpa' => function ($q) {
    //         $q->with('rel_sensor');
    //     }])
    //     ->withTrashed()
    //     ->first();
    //     return response()->json(compact(['h']));
    // }
}
