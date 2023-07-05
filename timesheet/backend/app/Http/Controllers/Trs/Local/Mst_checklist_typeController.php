<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_checklist_type;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_checklist_typeController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}
		Sf::log("trs_local_mst_checklist_type", "Mst_checklist_typeController@" . __FUNCTION__, "Open Page  ", "link");
		return view('trs.local.mst_checklist_type.mst_checklist_type_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_checklist_type::where(function ($q) use ($request) {
			$q->orWhere('kd_ct', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_ct', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_ct', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_checklist_type::select('kd_ct', 'nm_ct')->where(function ($q) use ($request) {
			$q->orWhere('kd_ct', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_ct', 'like', "%" . @$request->q . "%");
		})
		->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_ct', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function store(Request $request)
	{
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;
		
		try {
			$arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				$kd_ct = str_replace(str_split('\\/:.*?"<>|_ '), '', strtolower($h->nm_ct));
				$data = new Mst_checklist_type();
				$arr = array_merge($arr, ['kd_ct' => $kd_ct, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $kd_ct;
				Sf::log("trs_local_mst_checklist_type", $id, "Create Data checklist type (mst_checklist_type) kd_ct : " . $id, "create");
				return 'created';
			} else {
				$kd_ct = str_replace(str_split('\\/:.*?"<>|_ '), '', strtolower($h->nm_ct));
				$data = Mst_checklist_type::where('kd_ct', $h->kd_ct)->first();
				$data->update($arr);
				$id = $data->kd_ct;
				Sf::log("trs_local_mst_checklist_type", $id, "Update Data checklist type (mst_checklist_type) kd_ct : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json("Kode checklist type sudah ada", 401);
		}
	}

	public function edit($id)
	{
		$h = Mst_checklist_type::where('kd_ct', $id)->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_checklist_type::where('kd_ct', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				$data->restore();
				Sf::log("trs_local_mst_checklist_type", $id, "Restore Data checklist type (mst_checklist_type) kd_ct : " . $id, "restore");
				return 'restored';
			} else {
				$data->delete();
				Sf::log("trs_local_mst_checklist_type", $id, "Delete Data checklist type (mst_checklist_type) kd_ct : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
