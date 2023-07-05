<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Symenu;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;

class SymenuController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_symenu", "SymenuController@" . __FUNCTION__, "Open Page  ", "link");
		return view('sys.symenu.symenu_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYMENU_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Symenu::where(function ($q) use ($request) {
			$q->orWhere('menu_id', 'like', "%" . @$request->q . "%");
			$q->orWhere('label', 'like', "%" . @$request->q . "%");
			$q->orWhere('url', 'like', "%" . @$request->q . "%");
			$q->orWhere('redirect', 'like', "%" . @$request->q . "%");
			$q->orWhere('parent', 'like', "%" . @$request->q . "%");
			$q->orWhere('icon', 'like', "%" . @$request->q . "%");
			$q->orWhere('note', 'like', "%" . @$request->q . "%");
			$q->orWhere('order_no', 'like', "%" . @$request->q . "%");
		})->with(['rel_parent' => function ($q) {
			$q->with(['rel_parent' => function ($q1) {
				$q1->with(['rel_parent' => function ($q2) {
					$q2->with(['rel_parent']);
				}]);
			}]);
		}])
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'menu_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Symenu::select('menu_id', 'label', 'url', 'redirect', 'parent', 'note')
			->where(function ($q) use ($request) {
				$q->orWhere('menu_id', 'like', "%" . @$request->q . "%");
				$q->orWhere('label', 'like', "%" . @$request->q . "%");
				$q->orWhere('url', 'like', "%" . @$request->q . "%");
				$q->orWhere('redirect', 'like', "%" . @$request->q . "%");
				$q->orWhere('parent', 'like', "%" . @$request->q . "%");
				$q->orWhere('icon', 'like', "%" . @$request->q . "%");
				$q->orWhere('note', 'like', "%" . @$request->q . "%");
				$q->orWhere('order_no', 'like', "%" . @$request->q . "%");
			})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'menu_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
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
				$exist = Symenu::where('label', $h->label)->where('parent', @$h->parent)->where('url', @$h->url)->count();
				if ($exist > 0) {
					return response()->json("Menu already exist", 500);
				}
				if (!Sf::allowed('SYS_SYMENU_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Symenu();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = DB::getPdo()->lastInsertId();
				Sf::log("sys_symenu", $id, "Create Menu (symenu) menu_id : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYMENU_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Symenu::find($h->menu_id);
				$data->update($arr);
				$id = $data->menu_id;
				Sf::log("sys_symenu", $id, "Update Menu (symenu) menu_id : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Symenu::where('menu_id', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Symenu::where('menu_id', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYMENU_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_symenu", $id, "Restore Menu (symenu) menu_id : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYMENU_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_symenu", $id, "Delete Menu (symenu) menu_id : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function getAutocompleteParent(Request $request)
	{
		$data = Symenu::where('label', 'like', "%" . @$request->q . "%")
			->orderBy('label')
			->limit(isset($request->limit) ? $request->limit : 10)->get();
		foreach ($data as $k => $v) {
			$data[$k]->value = $v->menu_id;
			$data[$k]->html = "<b>" . $v->menu_id . "</b> | " . $v->label . " <i>(Parent : " . $v->parent . ")</i>";
		}
		return response()->json($data);
	}
}
