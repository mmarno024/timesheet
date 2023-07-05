<?php

namespace App\Http\Controllers\Sys;

use Adldap\Laravel\Facades\Adldap;
use App\Http\Controllers\Controller;
use App\Model\Sys\Syuser;
use App\Sf;
use Auth;
use Config;
use Illuminate\Http\Request;

class SyuserController extends Controller
{

	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("sys_syuser", "SyuserController@" . __FUNCTION__, "Open Page  ", "link");

		return view('sys.syuser.syuser_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		$request->q = str_replace(" ", "%", $request->q);
		if (!Sf::allowed('SYS_SYUSER_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$data = Syuser::where('userid', '!=', '0067683')->where(function ($q) use ($request) {
			$q->orWhere('userid', 'like', "%" . @$request->q . "%");
			$q->orWhere('username', 'like', "%" . @$request->q . "%");
			$q->orWhere('email', 'like', "%" . @$request->q . "%");
			$q->orWhere('phone', 'like', "%" . @$request->q . "%");
		})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'userid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		if ($request->trash == 1) {
			$data = $data->onlyTrashed();
		}
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request)
	{
		$request->q = str_replace(" ", "%", @$request->q);
		$data = Syuser::select('userid', 'username', "email")
			->where('userid', '!=', '0067683')
			->where(function ($q) use ($request) {
				$q->orWhere('userid', 'like', "%" . @$request->q . "%");
				$q->orWhere('username', 'like', "%" . @$request->q . "%");
				$q->orWhere('email', 'like', "%" . @$request->q . "%");
			})
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'userid', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
		$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function store(Request $request)
	{
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;

		if (trim(@$h->password) != '') {
			if (@$h->password != @$h->repassword) {
				return response()->json("Password and Confirmation didn't match", 401);
			}
			$h->password = bcrypt(@$h->password);
		}

		try {
			$arr = array_merge((array) $h, ['updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				if (!Sf::allowed('SYS_SYUSER_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new Syuser();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
				$id = $h->userid;
				Sf::log("sys_syuser", $id, "Create Menu (syuser) userid : " . $id, "create");
				return response()->json('created');
			} else {
				if (!Sf::allowed('SYS_SYUSER_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = Syuser::find($h->userid);
				if (trim(@$h->password) == '') {
					$arr['password'] = @$data->password;
				}
				$data->update($arr);
				$id = $data->userid;
				Sf::log("sys_syuser", $id, "Update Menu (syuser) userid : " . $id, "update");
				return response()->json('updated');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id)
	{
		$h = Syuser::where('userid', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id, Request $request)
	{
		try {
			$data = Syuser::where('userid', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('SYS_SYUSER_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("sys_syuser", $id, "Restore Menu (syuser) userid : " . $id, "restore");
				return response()->json('restored');
			} else {
				if (!Sf::allowed('SYS_SYUSER_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("sys_syuser", $id, "Delete Menu (syuser) userid : " . $id, "delete");
				return response()->json('deleted');
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function userProfile(Request $request)
	{
		if (!isset($request->userid)) {
			$userid = Auth::user()->userid;
		} else {
			$userid = $request->userid;
		}
		$syuser = Syuser::find($userid);
		return view('sys.syuser.syuser_profile', compact(['request', 'syuser', 'userid']));
	}

	public function syncLdap(Request $request)
	{
		$admin_username = Config::get('adldap.connections.default.connection_settings.admin_username');
		$admin_password = Config::get('adldap.connections.default.connection_settings.admin_password');

		Adldap::auth()->attempt($admin_username, $admin_password, true);

		$all = Adldap::search()->users()->get();
		$i = 0;
		$a = 0;

		foreach ($all as $k => $v) {
			if (isset($v->samaccountname[0]) && $v->samaccountname[0] != null) {
				$a++;
				$syuser = Syuser::find($v->samaccountname[0]);
				if ($syuser == false) {
					set_time_limit(0);
					$syuser = new Syuser();
					$syuser->userid = $v->samaccountname[0];
					$syuser->username = $v->sn[0];
					$syuser->attr = json_encode(['ldap_distinguishedname' => $v->distinguishedname[0]]);
					$syuser->email = $v->mail[0] == '' ? $syuser->email : $v->mail[0];
					$syuser->phone = @$v->OfficePhone[0] == '' ? $syuser->phone : @$v->OfficePhone[0];
					$syuser->password = "";
					$syuser->created_by = Auth::check() ? Auth::user()->userid : '';
					$syuser->created_at = date('Y-m-d H:i:s');
					$syuser->updated_at = date('Y-m-d H:i:s');

					if ($syuser->save()) {
						$i++;
					}
				}
				Sf::log("SYS_SYUSER", $syuser->userid, "Sync LDAP user " . $syuser->userid, SyuserController::class . "@" . __FUNCTION__, "create");
			}
		}
		return "$i of " . (@$a) . " data syncronized";
	}

	public function changePass(Request $request)
	{
		$req = json_decode(request()->getContent());
		$x = $req->x;
		$userid = $request->userid;
		if (Auth::user()->userid != $userid) {
			return response()->json("You can only change your profile ", 401);
		}
		$syuser = Syuser::find($userid);
		if ($syuser == false) {
			return response()->json("User ID " . $userid . " not found", 401);
		}

		$hasher = app('hash');
		if (!$hasher->check($x->old_password, $syuser->password)) {
			return response()->json("Old password incorrect", 401);
		}

		if ($x->new_password != $x->confirm_password) {
			return response()->json("Confirm password din't match", 401);
		}

		$syuser->password = bcrypt($x->new_password);
		$syuser->save();
		return response()->json("Password Changed");
	}
}
