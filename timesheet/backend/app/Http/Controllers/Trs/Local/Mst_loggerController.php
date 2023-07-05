<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_logger;
use App\Model\Trs\Local\Mst_hardware;
use Illuminate\Http\Request;
use App\Sf;
use Auth;
use DB;

class Mst_loggerController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_mst_logger', 'Mst_loggerController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.mst_logger.mst_logger_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_MST_LOGGER_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $request->q = str_replace(' ', '%', $request->q);
        if ($request->plant == '002') {
            $data = Mst_logger::where(function ($q) use ($request) {
                $q->orWhere('kd_logger', 'like', '%' . @$request->q . '%');
                $q->orWhere('nm_logger', 'like', '%' . @$request->q . '%');
            })->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_logger', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        } elseif ($request->plant != '002') {
            $data = Mst_hardware::select('mst_hardware.kd_logger', 'logg.nm_logger')
                ->distinct()
                ->where('mst_hardware.plant', $request->plant)
                ->where(function ($q) use ($request) {
                    $q->orWhere('mst_hardware.kd_logger', 'like', '%' . @$request->q . '%');
                })
                ->join(DB::raw('mst_logger as logg'), 'logg.kd_logger', '=', 'mst_hardware.kd_logger')
                ->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'mst_hardware.kd_logger', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
        $data = Mst_logger::select('kd_logger', 'nm_logger')
            ->where(function ($q) use ($request) {
                $q->orWhere('kd_logger', 'like', '%' . @$request->q . '%');
                $q->orWhere('nm_logger', 'like', '%' . @$request->q . '%');
            })
            ->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_logger', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getLookup2(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Mst_hardware::select('mst_hardware.kd_logger', 'log.nm_logger')
            ->where(function ($q) use ($request) {
                $q->orWhere( 'mst_hardware.kd_logger', 'like', '%' . @$request->q . '%');
                $q->orWhere('log.nm_logger', 'like', '%' . @$request->q . '%');
            })
            ->distinct()
            ->where('plant', $request->plant)
            ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
            ->orderBy('log.kd_logger', 'ASC');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 1000);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;

        try {
            $arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s'),]);
            if ($f->crud == 'c') {
                if (!Sf::allowed('TRS_LOCAL_MST_LOGGER_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = new Mst_logger();
                $arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'),]);
                $data->create($arr);
                $id = $h->kd_logger;
                Sf::log('trs_local_mst_logger', $id, 'Create Data Device (mst_logger) kd_logger : ' . $id, 'create');
                return 'created';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_LOGGER_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Mst_logger::find($h->kd_logger);
                $data->update($arr);
                $id = $data->kd_logger;
                Sf::log('trs_local_mst_logger', $id, 'Update Data Device (mst_logger) kd_logger : ' . $id, 'update');
                return 'updated';
            }
        } catch (\Exception $e) {
            return response()->json('Kode logger sudah ada', 401);
        }
    }

    public function edit($id)
    {
        $h = Mst_logger::where('kd_logger', $id)->withTrashed()->first();
        return response()->json(compact(['h']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Mst_logger::where('kd_logger', $id)->withTrashed()->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('TRS_LOCAL_MST_LOGGER_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log('trs_local_mst_logger', $id, 'Restore Data Device (mst_logger) kd_logger : ' . $id, 'restore');
                return 'restored';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_LOGGER_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log('trs_local_mst_logger', $id,  'Delete Data Device (mst_logger) kd_logger : ' . $id,  'delete');
                return 'deleted';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
