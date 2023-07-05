<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Sycom;
use App\Sf;
use Auth;
use Illuminate\Http\Request;

class SycomController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_sycom", "SycomController@" . __FUNCTION__, "Open Page  ", "link");
		return view('sys.sycom.sycom_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYCOM_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Sycom::where(function ($q) use ($request) {
			$q->orWhere('com_code', 'like', "%" . @$request->q . "%");
			$q->orWhere('com_name', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'com_code', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Sycom::where(function ($q) use ($request) {
			$q->orWhere('com_code', 'like', "%" . @$request->q . "%");
			$q->orWhere('com_name', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'com_code', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('SYS_SYCOM_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Sycom();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->com_code;
				Sf::log("sys_sycom", $id, "Create Menu (sycom) com_code : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYCOM_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Sycom::find($h->com_code);
				$data->update($arr);
				$id = $data->com_code;
				Sf::log("sys_sycom", $id, "Update Menu (sycom) com_code : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Sycom::where('com_code', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Sycom::where('com_code', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYCOM_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_sycom", $id, "Restore Menu (sycom) com_code : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYCOM_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_sycom", $id, "Delete Menu (sycom) com_code : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
