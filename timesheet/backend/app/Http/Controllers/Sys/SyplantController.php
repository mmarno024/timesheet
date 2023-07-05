<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Syplant;
use App\Model\Sys\Syplant_d;
use App\Model\Sys\Syuser;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Trs_raw_h;
use App\Model\Trs\Local\Trs_raw_d_img;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;

class SyplantController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_syplant", "SyplantController@" . __FUNCTION__, "Open Page  ", "link");

		return view('sys.syplant.syplant_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYPLANT_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Syplant::where(function ($q) use ($request) {
			$q->orWhere('plant', 'like', "%" . @$request->q . "%");
			$q->orWhere('plantname', 'like', "%" . @$request->q . "%");
			$q->orWhere('com_code', 'like', "%" . @$request->q . "%");
			$q->orWhere('bus_area', 'like', "%" . @$request->q . "%");
			$q->orWhere('old_plant', 'like', "%" . @$request->q . "%");
			$q->orWhere('addr', 'like', "%" . @$request->q . "%");
			$q->orWhere('city', 'like', "%" . @$request->q . "%");
			$q->orWhere('provice', 'like', "%" . @$request->q . "%");
			$q->orWhere('state', 'like', "%" . @$request->q . "%");
			$q->orWhere('postcode', 'like', "%" . @$request->q . "%");
			$q->orWhere('area', 'like', "%" . @$request->q . "%");
			$q->orWhere('coordinate', 'like', "%" . @$request->q . "%");
			$q->orWhere('url_file', 'like', "%" . @$request->q . "%");
            $q->orWhere('note', 'like', '%' . @$request->q . '%');
		})
			->with('rel_com_code')
			->with('rel_provice')
			->with('rel_city')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'plant', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Syplant::select('plant as project', 'plantname as project_name', 'addr as address')
			->where(function ($q) use ($request) {
				$q->orWhere('plant', 'like', "%" . @$request->q . "%");
				$q->orWhere('plantname', 'like', "%" . @$request->q . "%");
				$q->orWhere('addr', 'like', "%" . @$request->q . "%");
			})
			->where('plant', '!=', '002')
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'plant', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function store(Request $request)
	{
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;
		$d = $req->d;
		$h->provice = empty($h->provice) ? '34' : $h->provice;
		$h->city = empty($h->city) ? '3404' : $h->city;
		$h->state = empty($h->state) ? '"3404130"' : $h->state;

		try {
			$arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				if (!Sf::allowed('SYS_SYPLANT_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Syplant();
				$plant_auto = Sf::autonumber('0', 3, 'mysql', 'plant', 'syplant', " AND plant like '0%'");
				$arr = array_merge($arr, ['plant' => $plant_auto, 'com_code' => '001', 'year' => date('Y'), 'created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $plant_auto;
				Sf::log("sys_syplant", $id, "Create Menu (syplant) plant : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYPLANT_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Syplant::find($h->plant);
				$data->update($arr);
				$id = $data->plant;
				Sf::log("sys_syplant", $id, "Update Menu (syplant) plant : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Syplant::where('plant', $id)->withTrashed()->first();
		$d = $h->rel_d;
		foreach ($d as $k => $v) {
			$d[$k] = @$v;
		}
		$d1 = $h->rel_provice;
		$d2 = $h->rel_city;
		$d3 = $h->rel_district;
		return response()->json(compact(['h', 'd', 'd1', 'd2', 'd3']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Syplant::where('plant', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYPLANT_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_syplant", $id, "Restore Menu (syplant) plant : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYPLANT_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_syplant", $id, "Delete Menu (syplant) plant : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function getCekdata(Request $request)
	{
		$userid = $request->userid;
		$cek_user = Syuser::select('def_plant')->where('userid', $userid)->first();
		$data_cek_plant = Syplant::where('plant', $cek_user->def_plant)->first();
		return response()->json(compact(['data_cek_plant']));
	}
}
