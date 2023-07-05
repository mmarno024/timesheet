<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Sygroup;
use App\Sf;
use Auth;
use Illuminate\Http\Request;

class SygroupController extends Controller
{

	public function index(Request $request)
	{
		$data = [];
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_sygroup", "SygroupController@" . __FUNCTION__, "Open Page  ", "link");
		return view('sys.sygroup.sygroup_frm', compact(['request', 'data']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYGROUP_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Sygroup::where('group_id', '!=', 'ADMIN')->where(function ($q) use ($request) {
			$q->orWhere('group_id', 'like', "%" . @$request->q . "%");
			$q->orWhere('group_name', 'like', "%" . @$request->q . "%");
			$q->orWhere('note', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'group_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Sygroup::select('group_id', 'group_name', 'note')
			->where('group_id', '!=', 'ADMIN')
			->where(function ($q) use ($request) {
				$q->orWhere('group_id', 'like', "%" . @$request->q . "%");
				$q->orWhere('group_name', 'like', "%" . @$request->q . "%");
				$q->orWhere('note', 'like', "%" . @$request->q . "%");
			})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'group_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('SYS_SYGROUP_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Sygroup();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->group_id;
				Sf::log("sys_sygroup", $id, "Create Menu (sygroup) group_id : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYGROUP_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Sygroup::find($h->group_id);
				$data->update($arr);
				$id = $data->group_id;
				Sf::log("sys_sygroup", $id, "Update Menu (sygroup) group_id : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Sygroup::where('group_id', '!=', 'ADMIN')->where('group_id', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Sygroup::where('group_id', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYGROUP_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_sygroup", $id, "Restore Menu (sygroup) group_id : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYGROUP_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_sygroup", $id, "Delete Menu (sygroup) group_id : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
