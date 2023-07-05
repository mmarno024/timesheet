<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_desa;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_desaController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("trs_local_mst_desa", "Mst_desaController@" . __FUNCTION__, "Open Page  ", "link");

		return view('trs.local.mst_desa.mst_desa_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		if (!Sf::allowed('TRS_LOCAL_MST_DESA_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_desa::select('mst_desa.kd_desa', 'prov.nm_provinsi', 'kab.nm_kabupaten', 'kec.nm_kecamatan', 'mst_desa.nm_desa')->where(function ($q) use ($request) {
			$q->orWhere('mst_desa.kd_desa', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('kab.nm_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('kec.nm_kecamatan', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_desa.nm_desa', 'like', "%" . @$request->q . "%");
		})
			->join(DB::raw('mst_kecamatan as kec'), 'kec.kd_kecamatan', '=', 'mst_desa.kd_kecamatan')
			->join(DB::raw('mst_kabupaten as kab'), 'kab.kd_kabupaten', '=', 'kec.kd_kabupaten')
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'kab.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_desa', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_desa::select('mst_desa.kd_desa', 'prov.nm_provinsi', 'kab.nm_kabupaten', 'kec.nm_kecamatan', 'mst_desa.nm_desa')->where(function ($q) use ($request) {
			$q->orWhere('mst_desa.kd_desa', 'like', "%" . @$request->q . "%");
			$q->orWhere('prov.nm_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('kab.nm_kabupaten', 'like', "%" . @$request->q . "%");
			$q->orWhere('kec.nm_kecamatan', 'like', "%" . @$request->q . "%");
			$q->orWhere('mst_desa.nm_desa', 'like', "%" . @$request->q . "%");
		})
			->where('mst_desa.kd_kecamatan', $request->kecamatan)
			->join(DB::raw('mst_kecamatan as kec'), 'kec.kd_kecamatan', '=', 'mst_desa.kd_kecamatan')
			->join(DB::raw('mst_kabupaten as kab'), 'kab.kd_kabupaten', '=', 'kec.kd_kabupaten')
			->join(DB::raw('mst_provinsi as prov'), 'prov.kd_provinsi', '=', 'kab.kd_provinsi')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_desa', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('TRS_LOCAL_MST_DESA_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Mst_desa();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->kd_desa;
				Sf::log("trs_local_mst_desa", $id, "Create Data Desa (mst_desa) kd_desa : " . $id, "create");
				return 'created';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_DESA_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Mst_desa::find($h->kd_desa);
				$data->update($arr);
				$id = $data->kd_desa;
				Sf::log("trs_local_mst_desa", $id, "Update Data Desa (mst_desa) kd_desa : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Mst_desa::where('kd_desa', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_desa::where('kd_desa', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('TRS_LOCAL_MST_DESA_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("trs_local_mst_desa", $id, "Restore Data Desa (mst_desa) kd_desa : " . $id, "restore");
				return 'restored';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_DESA_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("trs_local_mst_desa", $id, "Delete Data Desa (mst_desa) kd_desa : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
