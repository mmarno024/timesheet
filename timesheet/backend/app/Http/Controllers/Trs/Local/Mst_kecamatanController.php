<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_kecamatan;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_kecamatanController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("trs_local_mst_kecamatan", "Mst_kecamatanController@" . __FUNCTION__, "Open Page  ", "link");

		return view('trs.local.mst_kecamatan.mst_kecamatan_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		if (!Sf::allowed('TRS_LOCAL_MST_KECAMATAN_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_kecamatan::select('mst_kecamatan.kd_kecamatan', 'prov.nm_provinsi', 'kab.nm_kabupaten', 'mst_kecamatan.nm_kecamatan')->where(function ($q) use ($request) {
			$q->orWhere('mst_kecamatan.kd_kecamatan', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('kab.nm_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_kecamatan.nm_kecamatan', 'like', "%" . @$request->q . "%");
		})
			->join(DB::raw('mst_kabupaten as kab'), 'kab.kd_kabupaten', '=', 'mst_kecamatan.kd_kabupaten')
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'kab.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_kecamatan', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_kecamatan::select('mst_kecamatan.kd_kecamatan', 'prov.nm_provinsi', 'kab.nm_kabupaten', 'mst_kecamatan.nm_kecamatan')->where(function ($q) use ($request) {
			$q->orWhere('mst_kecamatan.kd_kecamatan', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('kab.nm_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_kecamatan.nm_kecamatan', 'like', "%" . @$request->q . "%");
		})
			->where('mst_kecamatan.kd_kabupaten', $request->kabupaten)
			->join(DB::raw('mst_kabupaten as kab'), 'kab.kd_kabupaten', '=', 'mst_kecamatan.kd_kabupaten')
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'kab.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_kecamatan', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('TRS_LOCAL_MST_KECAMATAN_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Mst_kecamatan();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->kd_kecamatan;
				Sf::log("trs_local_mst_kecamatan", $id, "Create Data Kecamatan (mst_kecamatan) kd_kecamatan : " . $id, "create");
				return 'created';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_KECAMATAN_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Mst_kecamatan::find($h->kd_kecamatan);
				$data->update($arr);
				$id = $data->kd_kecamatan;
				Sf::log("trs_local_mst_kecamatan", $id, "Update Data Kecamatan (mst_kecamatan) kd_kecamatan : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Mst_kecamatan::where('kd_kecamatan', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_kecamatan::where('kd_kecamatan', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('TRS_LOCAL_MST_KECAMATAN_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("trs_local_mst_kecamatan", $id, "Restore Data Kecamatan (mst_kecamatan) kd_kecamatan : " . $id, "restore");
				return 'restored';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_KECAMATAN_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("trs_local_mst_kecamatan", $id, "Delete Data Kecamatan (mst_kecamatan) kd_kecamatan : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
