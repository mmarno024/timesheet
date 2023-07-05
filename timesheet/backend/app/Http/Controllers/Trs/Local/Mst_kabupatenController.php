<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_kabupaten;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_kabupatenController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("trs_local_mst_kabupaten", "Mst_kabupatenController@" . __FUNCTION__, "Open Page  ", "link");

		return view('trs.local.mst_kabupaten.mst_kabupaten_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		if (!Sf::allowed('TRS_LOCAL_MST_KABUPATEN_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_kabupaten::select('mst_kabupaten.kd_kabupaten', 'prov.nm_provinsi', 'mst_kabupaten.nm_kabupaten')->where(function ($q) use ($request) {
			$q->orWhere('mst_kabupaten.kd_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_kabupaten.nm_kabupaten', 'like', "%" . @$request->q . "%");
		})
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'mst_kabupaten.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'mst_kabupaten.kd_kabupaten', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_kabupaten::select('mst_kabupaten.kd_kabupaten', 'prov.nm_provinsi', 'mst_kabupaten.nm_kabupaten')->where(function ($q) use ($request) {
			$q->orWhere('mst_kabupaten.kd_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_kabupaten.nm_kabupaten', 'like', "%" . @$request->q . "%");
		})
			->where('mst_kabupaten.kd_provinsi', $request->provinsi)
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'mst_kabupaten.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_kabupaten', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('TRS_LOCAL_MST_KABUPATEN_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Mst_kabupaten();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->kd_kabupaten;
				Sf::log("trs_local_mst_kabupaten", $id, "Create Data Kabupaten (mst_kabupaten) kd_kabupaten : " . $id, "create");
				return 'created';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_KABUPATEN_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Mst_kabupaten::find($h->kd_kabupaten);
				$data->update($arr);
				$id = $data->kd_kabupaten;
				Sf::log("trs_local_mst_kabupaten", $id, "Update Data Kabupaten (mst_kabupaten) kd_kabupaten : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Mst_kabupaten::where('kd_kabupaten', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_kabupaten::where('kd_kabupaten', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('TRS_LOCAL_MST_KABUPATEN_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("trs_local_mst_kabupaten", $id, "Restore Data Kabupaten (mst_kabupaten) kd_kabupaten : " . $id, "restore");
				return 'restored';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_KABUPATEN_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("trs_local_mst_kabupaten", $id, "Delete Data Kabupaten (mst_kabupaten) kd_kabupaten : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
