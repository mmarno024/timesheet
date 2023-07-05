<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Syguide;
use App\Model\Sys\Sylink;
use App\Model\Sys\Syplant;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;

class SyguideController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		$syplant = Syplant::all();

		$syguide_cat = Syguide::select('cat')->groupBy('cat')->get();

		Sf::log("sys_syguide", "SyguideController@" . __FUNCTION__, "Open Page  ", "link");

		return view('sys.syguide.syguide_frm', compact(['request', 'plant', 'syplant', 'syguide_cat']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYGUIDE_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Syguide::where(function ($q) use ($request) {
			$q->orWhere('id', 'like', "%" . @$request->q . "%");
			$q->orWhere('subj', 'like', "%" . @$request->q . "%");
			$q->orWhere('plant', 'like', "%" . @$request->q . "%");
			$q->orWhere('cat', 'like', "%" . @$request->q . "%");
			$q->orWhere('body', 'like', "%" . @$request->q . "%");
			$q->orWhere('tag', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		if (@$request->cat != '') {
			$data = $data->where('cat', @$request->cat);
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Syguide::where(function ($q) use ($request) {
			$q->orWhere('id', 'like', "%" . @$request->q . "%");
			$q->orWhere('subj', 'like', "%" . @$request->q . "%");
			$q->orWhere('plant', 'like', "%" . @$request->q . "%");
			$q->orWhere('cat', 'like', "%" . @$request->q . "%");
			$q->orWhere('body', 'like', "%" . @$request->q . "%");
			$q->orWhere('tag', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				if (!Sf::allowed('SYS_SYGUIDE_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Syguide();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = DB::getPdo()->lastInsertId();
				Sf::log("sys_syguide", $id, "Create Menu (syguide) id : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYGUIDE_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Syguide::find($h->id);
				$data->update($arr);
				$id = $data->id;
				Sf::log("sys_syguide", $id, "Update Menu (syguide) id : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Syguide::where('id', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function read(Request $request)
	{
		$h = Syguide::where('id', $request->id)->withTrashed()->first();
		$allowed = Sylink::where('rel', 'sygroup-syguide')
			->whereIn('key1', function ($q) {
				$q->select('key2')->where('rel', 'syuser-sygroup')
					->where('key1', Auth::check() ? Auth::user()->userid : '')->from('sylink');
			})
			->where('key2', $request->id)
			->count();
		$status = "success";
		$msg = "";
		if ($allowed == 0) {
			$status = "error";
			$msg = "Access Denied. Contact administrator to open this document";
			$h = false;
		}
		return response()->json(compact(['h', 'msg', 'status']));
	}

	public function readByTag(Request $request)
	{
		$data = Syguide::where('tag', $request->tag)->get();
		$counter = $data->count();
		if (@$request->counter_only == 1) {
			$data = [];
		}
		return response()->json(compact(['data', 'counter']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Syguide::where('id', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYGUIDE_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_syguide", $id, "Restore Menu (syguide) id : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYGUIDE_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_syguide", $id, "Delete Menu (syguide) id : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}
