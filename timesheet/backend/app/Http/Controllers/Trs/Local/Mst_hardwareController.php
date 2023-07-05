<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Mst_hardware_d2;
use App\Model\Trs\Local\Mst_hardware_ews;
use App\Model\Trs\Local\Mst_ews;
use App\Model\Trs\Local\Mst_sensor;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;

class Mst_hardwareController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_mst_hardware', 'Mst_hardwareController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.mst_hardware.mst_hardware_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_MST_HARDWARE_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::where(function ($q) use ($request) {
            $q->orWhere('mst_hardware.kd_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.uid', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.plant', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.location', 'like', '%' . @$request->q . '%');
        })
            ->with('rel_kd_logger')
            ->with('rel_plant')
            ->orderBy('mst_hardware.created_at', 'desc');

        if ($request->plant != '002') {
            $data = $data->where('mst_hardware.plant', $request->plant);
        }
        if (!empty($request->qplant)) {
            $data = $data->where('mst_hardware.plant', $request->qplant);
        }
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function getLookup(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::where(function ($q) use ($request) {
            $q->orWhere('kd_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('plant', 'like', '%' . @$request->q . '%');
        })
            ->orderBy('created_at', 'desc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getLookup2(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::select('logg.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude')
        ->where(function ($q) use ($request) {
            $q->orWhere('logg.nm_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.plant', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.location', 'like', '%' . @$request->q . '%');
        })
        ->join(DB::raw('mst_logger as logg'), 'logg.kd_logger', '=', 'mst_hardware.kd_logger')
        ->orderBy('mst_hardware.created_at', 'desc');
        if ($request->plant != '002') {
            $data = $data->where('plant', $request->plant);
        }
        if ($request->plantx != 'undefined') {
            $data = $data->where('mst_hardware.plant', $request->plantx);
        }
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getLookup3(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::select('logg.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude')
        ->where(function ($q) use ($request) {
            $q->orWhere('logg.nm_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.location', 'like', '%' . @$request->q . '%');
        })
        ->where('mst_hardware.plant', null)
        ->join(DB::raw('mst_logger as logg'), 'logg.kd_logger', '=', 'mst_hardware.kd_logger')
        ->orderBy('mst_hardware.created_at', 'desc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getLookup4(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::select('mst_hardware.kd_hardware', 'mst_hardware.uid', 'mst_hardware.location', 'plant.plantname AS project')
        ->where(function ($q) use ($request) {
            $q->orWhere('plant.plantname', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.kd_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('mst_hardware.plant', 'like', '%' . @$request->q . '%');
        })
        ->where('mst_hardware.plant', $request->plant)
        ->join(DB::raw('syplant as plant'), 'plant.plant', '=', 'mst_hardware.plant')
        ->orderBy('mst_hardware.created_at', 'desc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getTotaldata(Request $request)
    {
        $plant = $request->plant;
        $data_total_hardware = $plant == '002' ? Mst_hardware::count() : Mst_hardware::where('plant', $plant)->count();
        $data_total_ews = $plant == '002' ? Mst_ews::count() : Mst_ews::where('plant', $plant)->join(DB::raw('mst_hardware as hard'), 'hard.kd_hardware', '=', 'mst_ews.kd_hardware')->where('hard.plant', $plant)->count();
        $data_hardware = $plant == '002' ? Mst_hardware::select('kd_hardware', 'location', 'latitude', 'longitude')->get() : Mst_hardware::select('kd_hardware', 'location', 'latitude', 'longitude')->where('plant', $plant)->get();
        $q1 = $plant == '002' ? Mst_ews::select('ews_id', 'kd_hardware', 'ews_location', 'ews_latitude', 'ews_longitude')->get() : Mst_ews::select('mst_ews.ews_id', 'mst_ews.kd_hardware', 'mst_ews.ews_location', 'mst_ews.ews_latitude', 'mst_ews.ews_longitude')->join(DB::raw('mst_hardware as hard'), 'hard.kd_hardware', '=', 'mst_ews.kd_hardware')->where('hard.plant', $plant)->get();
        foreach($q1 as $k => $v) {
            $data1[$k]['device'] = $v->ews_id;
            $data1[$k]['location'] = $v->ews_location;
            $data1[$k]['latitude'] = $v->ews_latitude;
            $data1[$k]['longitude'] = $v->ews_longitude;
            $data1[$k]['type'] = 'ews';
        }
        $q2 = $plant == '002' ? Mst_hardware::select('kd_hardware', 'location', 'latitude', 'longitude')->get() : Mst_hardware::select('kd_hardware', 'location', 'latitude', 'longitude')->where('plant', $plant)->get();
        foreach($q2 as $k => $v) {
            $data2[$k]['device'] = $v->kd_hardware;
            $data2[$k]['location'] = $v->location;
            $data2[$k]['latitude'] = $v->latitude;
            $data2[$k]['longitude'] = $v->longitude;
            $data2[$k]['type'] = 'gpa';
        }
        $data_device = array_merge($data1, $data2);
        return response()->json(compact(['data_total_hardware', 'data_total_ews', 'data_hardware', 'data_device']));
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;
        $d1 = $req->d1;
        $d2 = $req->d2;
        $d3 = $req->d3;
        try {
            $arr = array_merge((array) $h, ['plant' => $h->plant, 'updated_at' => date('Y-m-d H:i:s'),]);
            if ($f->crud == 'c') {
                if (!Sf::allowed('TRS_LOCAL_MST_HARDWARE_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                @$cek_hardware = Mst_hardware::where('kd_hardware', $h->kd_hardware)->first();
                if (empty($cek_hardware)) {
                    $uid = Sf::autonumber(date('Y') . '' . $h->plant . '' . $h->kd_logger, 12, 'mysql', 'uid', 'mst_hardware', "AND uid like '" .  date('Y') . '' . $h->plant . '' . $h->kd_logger . "%'");
                    @$cek_uid = Mst_hardware::where('uid', $uid)->first();
                    if (empty($cek_uid)) {
                        $data = new Mst_hardware();
                        $arr = array_merge($arr, ['uid' => $uid, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_by' => 'Admin:' . Auth::user()->userid,]);
                        $data->create($arr);
                        $id = $h->kd_hardware;
                        $this->saveD1($id, $d1, $f->crud);
                        $this->saveD2($id, $d2, $f->crud);
                        $this->saveD3Ews($id, $d3, $f->crud);
                        Sf::log('trs_local_mst_hardware', $id, 'Create Data hardware (mst_hardware) kd_hardware : ' .  $id, 'create');
                        return 'created';
                    } else {
                        return response()->json('UID sudah ada', 401);
                    }
                } else {
                    return response()->json('Kode hardware sudah ada', 401);
                }
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_HARDWARE_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Mst_hardware::find($h->kd_hardware);
                $arr = array_merge($arr, ['updated_by' => 'Admin:' . Auth::user()->userid,]);
                $data->update($arr);
                $id = $data->kd_hardware;
                $this->saveD1($id, $d1, $f->crud);
                $this->saveD2($id, $d2, $f->crud);
                $this->saveD3Ews($id, $d3, $f->crud);
                Sf::log('trs_local_mst_hardware', $id, 'Update Data hardware (mst_hardware) kd_hardware : ' . $id, 'update');
                return 'updated';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    private function saveD1($id, $d1)
    {
        foreach($d1 as $k => $v){
            $sensor_data[$k] = $v->kd_sensor;
        }
        $d1db = Mst_hardware_d1::where('kd_hardware', $id)->get();
        foreach($d1db as $k => $v){
            $d1_db[$k] = $v->kd_sensor;
        }
        $d2db = Mst_hardware_d1::where('kd_hardware', $id)->get();
        foreach($d2db as $k => $v){
            $d2_db[$k] = $v->kd_sensor;
        }
        $arr_d1 = array_diff($d1_db, $sensor_data,);
        if(!empty($arr_d1)){
            Mst_hardware_d1::where('kd_hardware', $id)->whereIn('kd_sensor', $arr_d1)->forceDelete();
        }
        $arr_d2 = array_diff($d2_db, $sensor_data,);
        if(!empty($arr_d2)){
            Mst_hardware_d2::where('kd_hardware', $id)->whereIn('kd_sensor', $arr_d2)->forceDelete();
        }
        foreach ($d1 as $k1 => $v1) {
            if (@$v1->kd_sensor != '') {
                $sensor_cek = Mst_hardware_d1::where('kd_hardware', $id)->where('kd_sensor', $v1->kd_sensor)->first();
                if(empty($sensor_cek)){
                    Mst_hardware_d1::insert(['kd_hardware' => $id, 'kd_sensor' => @$v1->kd_sensor, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    Mst_hardware_d1::where('kd_hardware', $id)->where('kd_sensor', $v1->kd_sensor)->update(['kd_hardware' => $id, 'kd_sensor' => @$v1->kd_sensor, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                }
            }
        }
        foreach ($d1 as $k2 => $v2) {
            if (@$v2->kd_sensor != '') {
                $sensor_cek = Mst_hardware_d2::where('kd_hardware', $id)->where('kd_sensor', $v2->kd_sensor)->first();
                if(empty($sensor_cek)){
                    $sensor_detail = Mst_sensor::where('kd_sensor', $v2->kd_sensor)->first();
                    $count_step = $sensor_detail->kd_type == 'rain' ? 2 : 5;
                    $val_step = $sensor_detail->kd_type == 'rain' ? '0,100' : '0,50,100,150,200';
                    $color_step = $sensor_detail->kd_type == 'rain' ? 'biru,merah' : 'biru,hijau,kuning,oranye,merah';
                    Mst_hardware_d2::insert(['kd_hardware' => $id, 'kd_sensor' => @$v2->kd_sensor, 'count_step' => $count_step, 'val_step' => $val_step, 'color_step' => $color_step, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    $sensor_detail = Mst_sensor::where('kd_sensor', $v2->kd_sensor)->first();
                    $count_step = $sensor_cek->count_step == NULL && $sensor_detail->kd_type == 'rain' ? 2 : 5;
                    $val_step = $sensor_cek->count_step == NULL && $sensor_detail->kd_type == 'rain' ? '0,100' : '0,50,100,150,200';
                    $color_step = $sensor_cek->count_step == NULL && $sensor_detail->kd_type == 'rain' ? 'biru,merah' : 'biru,hijau,kuning,oranye,merah';
                    Mst_hardware_d2::where('kd_hardware', $id)->where('kd_sensor', $v2->kd_sensor)->update(['count_step' => $count_step, 'val_step' => $val_step, 'color_step' => $color_step, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                }
            }
        }
    }

    private function saveD2($id, $d2)
    {
        foreach ($d2 as $k2 => $v2) {
            $count_step = explode(',', @$v2->val_step);
            $count_step = count($count_step);
            Mst_hardware_d2::where('kd_hardware', $id)->where('kd_sensor', $v2->kd_sensor)->update(['count_step' => $count_step, 'val_step' => @$v2->val_step, 'color_step' => @$v2->color_step, 'updated_at' => date('Y-m-d H:i:s')]);
        }
    }

    private function saveD3Ews($id, $d3)
    {
        Mst_hardware_ews::where('kd_hardware', $id)->forceDelete();
        foreach ($d3 as $k => $v) {
			if ($v->ews_id != '') {
				$data = new Mst_hardware_ews();
				$data->kd_hardware = $id;
				$data->ews_id = $v->ews_id;
				$data->save();
                Mst_ews::where('ews_id', $v->ews_id)->update(['kd_hardware' => $id]);
			}
		}
		$cek_ews = DB::select(DB::raw("SELECT ews_id FROM mst_ews WHERE ews_id NOT IN (SELECT ews_id FROM mst_hardware_ews)"));
		foreach ($cek_ews as $k => $v) {
			Mst_ews::where('ews_id', $v->ews_id)->update(['kd_hardware' => null]);
		}
    }

    public function edit($id)
    {
        $h = Mst_hardware::where('kd_hardware', $id)->withTrashed()->first();
        $h->nm_provinsi = $h->rel_provinsi->nm_provinsi;
        $h->nm_kabupaten = $h->rel_kabupaten->nm_kabupaten;
        $h->nm_kecamatan = $h->rel_kecamatan->nm_kecamatan;
        $h->nm_desa = $h->rel_desa->nm_desa;
        $d1 = $h->rel_d1;
        foreach ($d1 as $k => $v) {
            $d1[$k] = @$v->rel_sensor;
        }
        $d2 = $h->rel_d2;
        foreach ($d2 as $k => $v) {
            $d2[$k] = @$v;
        }
        $d3 = $h->rel_d3_ews;
        foreach ($d3 as $k => $v) {
            $d3[$k] = @$v->rel_ews;
        }
        return response()->json(compact(['h', 'd1', 'd2', 'd3']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Mst_hardware::where('kd_hardware', $id)
                ->withTrashed()
                ->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('TRS_LOCAL_MST_HARDWARE_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log('trs_local_mst_hardware', $id, 'Restore Data hardware (mst_hardware) kd_hardware : ' . $id, 'restore');
                return 'restored';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_HARDWARE_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log('trs_local_mst_hardware', $id, 'Delete Data hardware (mst_hardware) kd_hardware : ' . $id, 'delete');
                return 'deleted';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function forceDeleteHardware(Request $request)
    {
        $code = $request->code;
        try {
            $data = Mst_hardware::where('kd_hardware', $code)->where('deleted_at', '!=', null);
            $data->forceDelete();
            Sf::log('trs_local_mst_hardware_fdel', $code, 'Force Delete Data hardware (mst_hardware) kd_hardware : ' . $code, 'force delete');
            return 'force deleted';
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
