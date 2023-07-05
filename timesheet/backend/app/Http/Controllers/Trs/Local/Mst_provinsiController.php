<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_provinsi;
use Auth;
use App\Sf;
use Illuminate\Http\Request;

class Mst_provinsiController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}
		Sf::log("trs_local_mst_provinsi", "Mst_provinsiController@" . __FUNCTION__, "Open Page  ", "link");
		return view('trs.local.mst_provinsi.mst_provinsi_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		if (!Sf::allowed('TRS_LOCAL_MST_PROVINSI_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_provinsi::select('kd_provinsi', 'nm_provinsi')->where(function ($q) use ($request) {
			$q->orWhere('kd_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_provinsi', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_provinsi', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_provinsi::select('kd_provinsi', 'nm_provinsi')->where(function ($q) use ($request) {
			$q->orWhere('kd_provinsi', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_provinsi', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_provinsi', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('TRS_LOCAL_MST_PROVINSI_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Mst_provinsi();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->kd_provinsi;
				Sf::log("trs_local_mst_provinsi", $id, "Create Data Provinsi (mst_provinsi) kd_provinsi : " . $id, "create");
				return 'created';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_PROVINSI_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Mst_provinsi::find($h->kd_provinsi);
				$data->update($arr);
				$id = $data->kd_provinsi;
				Sf::log("trs_local_mst_provinsi", $id, "Update Data Provinsi (mst_provinsi) kd_provinsi : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Mst_provinsi::where('kd_provinsi', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_provinsi::where('kd_provinsi', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('TRS_LOCAL_MST_PROVINSI_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("trs_local_mst_provinsi", $id, "Restore Data Provinsi (mst_provinsi) kd_provinsi : " . $id, "restore");
				return 'restored';
			} else {
				if (!Sf::allowed('TRS_LOCAL_MST_PROVINSI_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("trs_local_mst_provinsi", $id, "Delete Data Provinsi (mst_provinsi) kd_provinsi : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
