<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_location;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_locationController extends Controller
{

    public function index(Request $request)
    {
        if (!$plant = Sf::isPlant()) {
            return Sf::selectPlant();
        }

        Sf::log("trs_local_mst_location", "Mst_locationController@" . __FUNCTION__, "Open Page  ", "link");

        return view('trs.local.mst_location.mst_location_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_MST_LOCATION_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $request->q = str_replace(" ", "%", $request->q);
        $data = Mst_location::select('mst_location.kd_location', 'mst_location.plant', 'mst_location.location', 'prov.nm_provinsi', 'kab.nm_kabupaten', 'kec.nm_kecamatan')->where(function ($q) use ($request) {
            $q->orWhere('mst_location.kd_location', 'like', "%" . @$request->q . "%");
            $q->orWhere('mst_location.location', 'like', "%" . @$request->q . "%");
        })
            ->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'mst_location.kd_provinsi')
            ->join(DB::raw('mst_kabupaten as kab'), 'kab.kd_kabupaten', '=', 'mst_location.kd_kabupaten')
            ->join(DB::raw('mst_kecamatan as kec'), 'kec.kd_kecamatan', '=', 'mst_location.kd_kecamatan')
            ->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'mst_location.kd_location', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function getLookup(Request $request)
    {
        $request->q = str_replace(" ", "%", $request->q);
        $data = Mst_location::select('kd_location', 'location')->where(function ($q) use ($request) {
            $q->orWhere('kd_location', 'like', "%" . @$request->q . "%");
            $q->orWhere('location', 'like', "%" . @$request->q . "%");
        })
            ->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_location', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;

        try {
            $arr = array_merge((array) $h, ['plant' => $f->plant, 'updated_at' => date('Y-m-d H:i:s')]);
            if ($f->crud == 'c') {
                if (!Sf::allowed('TRS_LOCAL_MST_LOCATION_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = new Mst_location();
                $arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
                $data->create($arr);
                $id = $h->kd_location;
                Sf::log("trs_local_mst_location", $id, "Create Data Location (mst_location) kd_location : " . $id, "create");
                return 'created';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_LOCATION_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Mst_location::find($h->kd_location);
                $data->update($arr);
                $id = $data->kd_location;
                Sf::log("trs_local_mst_location", $id, "Update Data Location (mst_location) kd_location : " . $id, "update");
                return 'updated';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        $h = Mst_location::where('kd_location', $id)->withTrashed()->first();
        $h->nm_provinsi = $h->rel_provinsi->nm_provinsi;
        $h->nm_kabupaten = $h->rel_kabupaten->nm_kabupaten;
        $h->nm_kecamatan = $h->rel_kecamatan->nm_kecamatan;
        return response()->json(compact(['h']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Mst_location::where('kd_location', $id)->withTrashed()->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('TRS_LOCAL_MST_LOCATION_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log("trs_local_mst_location", $id, "Restore Data Location (mst_location) kd_location : " . $id, "restore");
                return 'restored';
            } else {
                if (!Sf::allowed('TRS_LOCAL_MST_LOCATION_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log("trs_local_mst_location", $id, "Delete Data Location (mst_location) kd_location : " . $id, "delete");
                return 'deleted';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
