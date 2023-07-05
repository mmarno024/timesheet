<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Syaccess;
use App\Sf;
use Auth;
use Illuminate\Http\Request;

class SyaccessController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_syaccess", "SyaccessController@" . __FUNCTION__, "Open Page  ", "link");
		return view('sys.syaccess.syaccess_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYACCESS_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Syaccess::where(function ($q) use ($request) {
			$q->orWhere('accessid', 'like', "%" . @$request->q . "%");
			$q->orWhere('accessname', 'like', "%" . @$request->q . "%");
			$q->orWhere('accessgroup', 'like', "%" . @$request->q . "%");
			$q->orWhere('location', 'like', "%" . @$request->q . "%");
			$q->orWhere('note', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'accessid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Syaccess::where(function ($q) use ($request) {
			$q->orWhere('accessid', 'like', "%" . @$request->q . "%");
			$q->orWhere('accessname', 'like', "%" . @$request->q . "%");
			$q->orWhere('accessgroup', 'like', "%" . @$request->q . "%");
			$q->orWhere('location', 'like', "%" . @$request->q . "%");
			$q->orWhere('note', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'accessid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
			$arr['accessid'] = strtoupper($arr['accessid']);
			if ($f->crud == 'c') {
				if (!Sf::allowed('SYS_SYACCESS_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Syaccess();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->accessid;
				Sf::log("sys_syaccess", $id, "Create Menu (syaccess) accessid : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYACCESS_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Syaccess::find($h->accessid);
				$data->update($arr);
				$id = $data->accessid;
				Sf::log("sys_syaccess", $id, "Update Menu (syaccess) accessid : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Syaccess::where('accessid', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Syaccess::where('accessid', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYACCESS_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_syaccess", $id, "Restore Menu (syaccess) accessid : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYACCESS_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_syaccess", $id, "Delete Menu (syaccess) accessid : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
