<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Syparsys;
use App\Sf;
use Auth;
use Illuminate\Http\Request;

class SyparsysController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		$syparsys = Syparsys::all();
		$arr1 = $syparsys->groupBy('pargroup');
		$arr = $arr1->split(2);

		$pargroups = Syparsys::select('pargroup')->groupBy('pargroup')->get();

		Sf::log("sys_syparsys", "SyparsysController@" . __FUNCTION__, "Open Page  ", "link");

		return view('sys.syparsys.syparsys_frm', compact(['request', 'plant', 'arr', 'pargroups']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYPARSYS_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Syparsys::where(function ($q) use ($request) {
			$q->orWhere('parid', 'like', "%" . @$request->q . "%");
			$q->orWhere('pargroup', 'like', "%" . @$request->q . "%");
			$q->orWhere('parname', 'like', "%" . @$request->q . "%");
			$q->orWhere('parnote', 'like', "%" . @$request->q . "%");
			$q->orWhere('input_type', 'like', "%" . @$request->q . "%");
			$q->orWhere('isplant', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'parid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Syparsys::where(function ($q) use ($request) {
			$q->orWhere('parid', 'like', "%" . @$request->q . "%");
			$q->orWhere('pargroup', 'like', "%" . @$request->q . "%");
			$q->orWhere('parname', 'like', "%" . @$request->q . "%");
			$q->orWhere('parnote', 'like', "%" . @$request->q . "%");
			$q->orWhere('input_type', 'like', "%" . @$request->q . "%");
			$q->orWhere('isplant', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'parid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('SYS_SYPARSYS_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Syparsys();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->parid;
				Sf::log("sys_syparsys", $id, "Create Menu (syparsys) parid : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYPARSYS_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Syparsys::find($h->parid);
				$data->update($arr);
				$id = $data->parid;
				Sf::log("sys_syparsys", $id, "Update Menu (syparsys) parid : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Syparsys::where('parid', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Syparsys::where('parid', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYPARSYS_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_syparsys", $id, "Restore Menu (syparsys) parid : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYPARSYS_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_syparsys", $id, "Delete Menu (syparsys) parid : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function getDisp(Request $request)
	{
		if (!Sf::allowed('SYS_SYPARSYS_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$syparsys = Syparsys::find($request->id);
		if ($syparsys == false) {
			$html = "File not found";
		} else {
			if ($syparsys->isplant == 1) {
				$val = Sf::getJson($syparsys->parvalue, $request->plant);
			} else {
				$val = $syparsys->parvalue;
			}
			$html = view('sys.syparsys.syparsys_disp', compact(['request', 'syparsys', 'val']));
		}
		return $html;
	}

	public function saveDash(Request $request)
	{
		try {

			if (!Sf::allowed('SYS_SYPARSYS_U')) {
				return response()->json(Sf::reason(), 401);
			}

			$syparsys = Syparsys::find($request->parid);
			if ($syparsys == false) {
				return response()->json('Data not found', 500);
			}

			if ($syparsys->isplant == 1) {
				$syparsys->parvalue = Sf::setJson($syparsys->parvalue, $request->plant, $request->parvalue);
			} else {
				$syparsys->parvalue = $request->parvalue;
			}
			$syparsys->save();
			Sf::log("sys_syparsys", $request->parid, "Change Parsys " . $request->plant . " Value to : " . substr($request->parvalue, 0, 50), "update");
			return 'Saved';
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
