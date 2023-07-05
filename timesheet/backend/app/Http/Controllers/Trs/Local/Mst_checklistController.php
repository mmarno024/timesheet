<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_checklist;
use App\Model\Trs\Local\Mst_checklist_d;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class Mst_checklistController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}
		Sf::log("trs_local_mst_checklist", "Mst_checklistController@" . __FUNCTION__, "Open Page  ", "link");
		return view('trs.local.mst_checklist.mst_checklist_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_checklist::where(function ($q) use ($request) {
			$q->orWhere('kd_checklist', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_checklist', 'like', "%" . @$request->q . "%");
		})
		->with('rel_kd_ct')
		->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_checklist', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		$data = Mst_checklist::where(function ($q) use ($request) {
			$q->orWhere('kd_checklist', 'like', "%" . @$request->q . "%");
			$q->orWhere('nm_checklist', 'like', "%" . @$request->q . "%");
		})
		->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'kd_checklist', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function store(Request $request)
	{
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;
        $d1 = $req->d1;

		try {
			$arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				$kd_checklist = str_replace(str_split('\\/:.*?"<>|_ '), '', strtolower($h->nm_checklist));
				$data = new Mst_checklist();
				$arr = array_merge($arr, ['kd_checklist' => $kd_checklist, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $kd_checklist;
				foreach ($d1 as $k1 => $v1) {
					if ($v1->nm_detail != '') {
						$detail_cek = Mst_checklist_d::where('kd_checklist', $id)->where('kd_detail', @$v1->kd_detail)->first();
						
						if(empty($detail_cek)){
							Mst_checklist_d::insert(['kd_checklist' => $id, 'kd_detail' => $id.''.$k1, 'nm_detail' => $v1->nm_detail, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
						} else {
							Mst_checklist_d::where('kd_checklist', $id)->where('kd_detail', $v1->kd_detail)->update(['nm_detail' => $v1->nm_detail, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
						}
					}
				}
				Sf::log("trs_local_mst_checklist", $id, "Create Data checklist (mst_checklist) kd_checklist : " . $id, "create");
				return 'created';
			} else {
				$kd_checklist = str_replace(str_split('\\/:.*?"<>|_ '), '', strtolower($h->nm_checklist));
				$data = Mst_checklist::where('kd_checklist', $h->kd_checklist)->first();
				$data->update($arr);
				$id = $data->kd_checklist;
				
				foreach ($d1 as $k1 => $v1) {
					if ($v1->nm_detail != '') {
						$detail_cek = Mst_checklist_d::where('kd_checklist', $id)->where('kd_detail', @$v1->kd_detail)->first();
						
						if(empty($detail_cek)){
							Mst_checklist_d::insert(['kd_checklist' => $id, 'kd_detail' => $id.''.$k1, 'nm_detail' => $v1->nm_detail, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
						} else {
							Mst_checklist_d::where('kd_checklist', $id)->where('kd_detail', $v1->kd_detail)->update(['nm_detail' => $v1->nm_detail, 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
						}
					}
				}

				Sf::log("trs_local_mst_checklist", $id, "Update Data checklist (mst_checklist) kd_checklist : " . $id, "update");
				return 'updated';
			}
		} catch (\Exception $e) {
			return response()->json("Kode checklist sudah ada", 401);
		}
	}

	public function edit($id)
	{
		$h = Mst_checklist::where('kd_checklist', $id)->first();

		$d1 = $h->rel_d;
        foreach ($d1 as $k => $v) {
            $d1[$k] = @$v;
        }

		return response()->json(compact(['h', 'd1']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Mst_checklist::where('kd_checklist', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				$data->restore();
				Sf::log("trs_local_mst_checklist", $id, "Restore Data checklist (mst_checklist) kd_checklist : " . $id, "restore");
				return 'restored';
			} else {
				$data->delete();
				Sf::log("trs_local_mst_checklist", $id, "Delete Data checklist (mst_checklist) kd_checklist : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
