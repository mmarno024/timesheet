<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_ews;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_ews;
use App\Model\Trs\Local\Trs_log_activity_ews;
use App\Sf;
use Auth;
use Illuminate\Http\Request;

class Mst_ewsController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_mst_ews', 'Mst_ewsController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.mst_ews.mst_ews_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_MST_EWS_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_ews::where(function ($q) use ($request) {
            $q->orWhere('mst_ews.ews_id', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_ews.ews_location', 'like', '%' . @$request->q . '%');
        })
            ->with('rel_kd_hardware')
            ->orderBy('mst_ews.created_at', 'desc');
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
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

    public function getLookup(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_ews::select('ews_id', 'ews_location', 'ews_latitude', 'ews_longitude')->where(function ($q) use ($request) {
            $q->orWhere('ews_id', 'like', '%' . @$request->q . '%');
            $q->orWhere('ews_location', 'like', '%' . @$request->q . '%');
        })
            ->where('kd_hardware', NULL)
            ->orderBy('created_at', 'desc');
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
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getLookup2(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_ews::select('ews_id', 'ews_location', 'ews_latitude', 'ews_longitude')->where(function ($q) use ($request) {
            $q->orWhere('ews_id', 'like', '%' . @$request->q . '%');
            $q->orWhere('ews_location', 'like', '%' . @$request->q . '%');
        })
            ->orderBy('created_at', 'desc');
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
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;
        try {
            $arr = array_merge((array) $h, ['plant' => NULL, 'updated_at' => date('Y-m-d H:i:s'),]);
            if ($f->crud == 'c') {
                if (!Sf::allowed('TRS_LOCAL_MST_EWS_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                @$cek_ews = Mst_ews::where('ews_id', $h->ews_id)->first();
                if (empty($cek_ews)) {
                    $data = new Mst_ews();
                    $arr = array_merge($arr, ['sender' => 'user', 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_d1_tlocal' => date('Y-m-d H:i:s'), 'ews_sirine' => 0, 'ews_sirine_time' => date('Y-m-d H:i:s'), 'ews_sirine_reply' => 0, 'ews_sirine_reply_time' => date('Y-m-d H:i:s'), 'ews_status' => 'normal', 'ews_level' => 0, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_by' => 'Admin:' . Auth::user()->userid]);
                    $data->create($arr);
                    $id = $h->ews_id;
                    Sf::log('trs_local_mst_ews', $id, 'Create Data ews (mst_ews) ews_id : ' .  $id, 'create');
                    Trs_log_activity_ews::insert(['ews_id' => $h->ews_id, 'sender' => 'user', 'ews_tlocal' => date('Y-m-d H:i:s'), 'ews_message' => 'User ' . Auth::user()->userid . ' create new ews id']);
                    return 'created';
                } else {
                    return response()->json('EWS ID sudah ada', 401);
                }
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_EWS_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Mst_ews::find($h->ews_id);
                $arr = array_merge($arr, ['updated_by' => 'Admin:' . Auth::user()->userid,]);
                $data->update($arr);
                $id = $data->ews_id;
                Sf::log('trs_local_mst_ews', $id, 'Update Data ews (mst_ews) ews_id : ' . $id, 'update');
                Trs_log_activity_ews::insert(['ews_id' => $data->ews_id, 'sender' => 'user', 'ews_tlocal' => $data['ews_tlocal'], 'ews_message' => 'User ' . Auth::user()->userid . ' updated ews id']);
                return 'updated';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        $h = Mst_ews::where('ews_id', $id)->withTrashed()->first();
        $h->hardware = $h->rel_kd_hardware;
        return response()->json(compact(['h']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Mst_ews::where('ews_id', $id)
                ->withTrashed()
                ->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('TRS_LOCAL_MST_EWS_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log('trs_local_mst_ews', $id, 'Restore Data ews (mst_ews) ews_id : ' . $id, 'restore');
                return 'restored';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_EWS_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log('trs_local_mst_ews', $id, 'Delete Data ews (mst_ews) ews_id : ' . $id, 'delete');
                return 'deleted';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
