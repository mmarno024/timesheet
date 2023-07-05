<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Syaccess;
use App\Model\Sys\Sygroup;
use App\Model\Sys\Syguide;
use App\Model\Sys\Sylink;
use App\Model\Sys\Symenu;
use App\Model\Sys\Syplant;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class SylinkController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_sylink", "SylinkController@" . __FUNCTION__, "Open Page  ", "link");

		return view('sys.sylink.sylink_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYLINK_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Sylink::where(function ($q) use ($request) {
			$q->orWhere('id', 'like', "%" . @$request->q . "%");
			$q->orWhere('rel', 'like', "%" . @$request->q . "%");
			$q->orWhere('key1', 'like', "%" . @$request->q . "%");
			$q->orWhere('key2', 'like', "%" . @$request->q . "%");
			$q->orWhere('key3', 'like', "%" . @$request->q . "%");
			$q->orWhere('key4', 'like', "%" . @$request->q . "%");
			$q->orWhere('key5', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl1', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl2', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl3', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl4', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl5', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Sylink::where(function ($q) use ($request) {
			$q->orWhere('id', 'like', "%" . @$request->q . "%");
			$q->orWhere('rel', 'like', "%" . @$request->q . "%");
			$q->orWhere('key1', 'like', "%" . @$request->q . "%");
			$q->orWhere('key2', 'like', "%" . @$request->q . "%");
			$q->orWhere('key3', 'like', "%" . @$request->q . "%");
			$q->orWhere('key4', 'like', "%" . @$request->q . "%");
			$q->orWhere('key5', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl1', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl2', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl3', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl4', 'like', "%" . @$request->q . "%");
			$q->orWhere('tbl5', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function getDash(Request $request)
	{
		$d = json_decode($request->d);
		$sylink = Sylink::where('rel', $d->rel)->where('key1', @$d->key1)->where(function ($q) {
			$q->orWhereIn('key3', ['', Session::get('plant')]);
			$q->orWhereNull('key3');
		})->get();
		$arrlink = [];
		foreach ($sylink as $k => $v) {
			$arrlink[$v->key2] = $v;
		}
		switch ($d->tbl2) {
			case 'syplant':
				$data = Syplant::where(function ($q) use ($request) {
					$q->orWhere('plant', 'like', "%" . @$request->q . "%");
					$q->orWhere('plantname', 'like', "%" . @$request->q . "%");
				})
					->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'plant', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc')
					->paginate(isset($request->limit) ? $request->limit : 10);

				foreach ($data as $k => $v) {
					if (array_key_exists($v->plant, $arrlink)) {
						$data[$k]->flag = 1;
					} else {
						$data[$k]->flag = 0;
					}
				}
				break;
			case 'sygroup':
				$data = Sygroup::where('group_id', '!=', 'ADMIN')->where(function ($q) use ($request) {
					$q->orWhere('group_id', 'like', "%" . @$request->q . "%");
					$q->orWhere('group_name', 'like', "%" . @$request->q . "%");
				})
					->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'group_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc')
					->paginate(isset($request->limit) ? $request->limit : 10);

				foreach ($data as $k => $v) {
					if (array_key_exists($v->group_id, $arrlink)) {
						$data[$k]->flag = 1;
					} else {
						$data[$k]->flag = 0;
					}
				}
				break;
			case 'symenu':
				$data = Symenu::where(function ($q) use ($request) {
					$q->orWhere('url', 'like', "%" . @$request->q . "%");
					$q->orWhere('label', 'like', "%" . @$request->q . "%");
				})
					->with(['rel_parent' => function ($q) {
						$q->with(['rel_parent' => function ($q1) {
							$q1->with(['rel_parent' => function ($q2) {
								$q2->with(['rel_parent']);
							}]);
						}]);
					}])
					->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'menu_id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc')
					->paginate(isset($request->limit) ? $request->limit : 10);

				foreach ($data as $k => $v) {
					if (array_key_exists($v->menu_id, $arrlink)) {
						$data[$k]->flag = 1;
					} else {
						$data[$k]->flag = 0;
					}
				}
				break;
			case 'syaccess':
				$sylink = Sylink::where('rel', $d->rel)->where('key1', @$d->key1)->where(function ($q) use ($d) {
					$q->orWhereIn('key3', ['', @$d->dept, Session::get('plant')]);
					$q->orWhereNull('key3');
				})->get();
				$arrlink = [];
				foreach ($sylink as $k => $v) {
					$arrlink[$v->key2][$v->key3] = $v;
				}
				$data = Syaccess::where(function ($q) use ($request) {
					$q->orWhere('accessid', 'like', "%" . @$request->q . "%");
					$q->orWhere('accessname', 'like', "%" . @$request->q . "%");
				});
				if ($d->tbl2 == 'syaccess' && $d->tbl1 == 'syuser') {
					$data = $data->where('accessgroup', 'user');
				} else {
					$data = $data->where('accessgroup', 'group');
				}
				if (@$request->bydept == 1) {
					$data = $data->where('location', 2);
				} else {
					$data = $data->whereIn('location', [0, 1, null]);
				}
				$data = $data->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'accessid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc')
					->paginate(isset($request->limit) ? $request->limit : 10);
				// return response()->json($data->toSql());
				// return response()->json($arrlink);
				foreach ($data as $k => $v) {
					if (array_key_exists($v->accessid, $arrlink)) {
						if ($v->location == 1) {
							$var_key3 = Session::get('plant');
						} else if ($v->location == 2) {
							$var_key3 = @$d->dept;
						} else {
							$var_key3 = '';
						}
						// dd($var_key3);
						if (array_key_exists($var_key3, $arrlink[$v->accessid])) {
							$data[$k]->flag = 1;
						} else {
							$data[$k]->flag = 0;
						}
					} else {
						$data[$k]->flag = 0;
					}
				}
				break;
			case 'syguide':
				$data = Syguide::where(function ($q) use ($request) {
					$q->orWhere('subj', 'like', "%" . @$request->q . "%");
					$q->orWhere('cat', 'like', "%" . @$request->q . "%");
				})
					->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc')
					->paginate(isset($request->limit) ? $request->limit : 10);

				foreach ($data as $k => $v) {
					if (array_key_exists($v->id, $arrlink)) {
						$data[$k]->flag = 1;
					} else {
						$data[$k]->flag = 0;
					}
				}
				break;

			default:
				# code...
				break;
		}
		return response()->json(compact(['data']));
	}

	public function store(Request $request)
	{
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;

		$sylink = Sylink::where('rel', @$h->rel)
			->where('key1', @$h->key1)
			->where('key2', @$h->key2)
			->where('key3', isset($h->key3) ? $h->key3 : '')
			->where('tbl1', @$h->tbl1)
			->where('tbl2', @$h->tbl2)
			->where('tbl3', @$h->tbl3)
			->withTrashed();
		if ($h->flag == 0) {
			$sylink->first()->delete();
			return response()->json('deleted');
		} else {
			if ($sylink->count() > 0) {
				$sylink->first()->restore();
				return response()->json('restored');
			}
		}

		try {
			$arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				if (!Sf::allowed('SYS_SYLINK_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Sylink();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = DB::getPdo()->lastInsertId();
				Sf::log("sys_sylink", $id, "Create Menu (sylink) id : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYLINK_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Sylink::find($h->id);
				$data->update($arr);
				$id = $data->id;
				Sf::log("sys_sylink", $id, "Update Menu (sylink) id : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Sylink::where('id', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Sylink::where('id', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYLINK_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_sylink", $id, "Restore Menu (sylink) id : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYLINK_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_sylink", $id, "Delete Menu (sylink) id : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function getAudit(Request $request)
	{
		$req = json_decode(request()->getContent());
		$r = $req->r;
		$f = $req->f;

		$userid = $r->userid;
		$user_plant = Sylink::where('rel', 'syuser-syplant')
			->where('key1', $userid)
			->whereHas('rel_key2_plant')
			->with(['rel_key2_plant'])
			->get();
		$user_group = Sylink::where('rel', 'syuser-sygroup')
			->where('key1', $userid)
			->whereHas('rel_key2_group')
			->with(['rel_key2_group'])
			->get();
		$arrGroup = [];
		foreach ($user_group as $key => $v) {
			$arrGroup[] = $v->key2;
		}
		$user_access = Sylink::where('rel', 'syuser-syaccess')
			->where('key1', $userid)
			->whereHas('rel_key2_access')
			->with(['rel_key2_access'])
			->get();
		$group_menu = Sylink::where('rel', 'sygroup-symenu')
			->whereIn('key1', $arrGroup)
			->whereHas('rel_key2_menu')
			->with(['rel_key2_menu'])
			->groupBy('key2')
			->get();
		$group_access = Sylink::where('rel', 'sygroup-syaccess')
			->whereIn('key1', $arrGroup)
			->whereHas('rel_key2_access')
			->with(['rel_key2_access'])
			->groupBy('key2')
			->groupBy('key3')
			->get();
		return response()->json(compact(['user_plant', 'user_group', 'user_access', 'group_menu', 'group_access', 'arrGroup']));
	}

	public function getMember(Request $request)
	{
		$data = Sylink::where('rel', $request->rel)
			->where('key2', $request->key2)
			->with(['rel_key1_group', 'rel_key1_user'])
			->get();
		return response()->json(compact(['data']));
	}

	public function cleanUp(Request $request)
	{
		$syuser1 = Sylink::where('tbl1', 'syuser')
			->doesnthave('rel_key1_user')
			->delete();

		$sygroup1 = Sylink::where('tbl1', 'sygroup')
			->doesnthave('rel_key1_group')
			->delete();

		$syplant2 = Sylink::where('tbl2', 'syplant')
			->doesnthave('rel_key2_plant')
			->delete();

		$sygroup2 = Sylink::where('tbl2', 'sygroup')
			->doesnthave('rel_key2_group')
			->delete();

		$syaccess2 = Sylink::where('tbl2', 'syaccess')
			->doesnthave('rel_key2_access')
			->delete();

		$symenu2 = Sylink::where('tbl2', 'symenu')
			->doesnthave('rel_key2_menu')
			->delete();

		return response()->json(compact(['syuser1', 'sygroup1', 'syplant2', 'sygroup2', 'syaccess2', 'symenu2']));
	}
}
