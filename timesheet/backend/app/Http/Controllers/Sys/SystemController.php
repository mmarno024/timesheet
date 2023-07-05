<?php

namespace App\Http\Controllers\Sys;

use Adldap\Laravel\Facades\Adldap;
use App\Http\Controllers\Controller;
use App\Model\Sys\Sylink;
use App\Model\Sys\Symenu;
use App\Model\Sys\Syplant;
use App\Model\Sys\Syuser;
use Illuminate\Http\Request;
use App\Sf;
use Auth;
use Config;
use Hash;
use PDF;
use Session;
use Storage;

class SystemController extends Controller
{

	public function sfLogin(Request $request)
	{
		$direct = @$request->direct;
		$msg = "";
		return view('sys.system.sflogin', compact(['request', 'msg', 'direct']));
	}

	public function sfPersonalFile(Request $request)
	{
		return view('sys.system.sfpersonalfile', compact(['request']));
	}

	public function sfAbout(Request $request)
	{
		return view('sys.system.sfabout', compact(['request']));
	}

	public function sfLoginAuth(Request $request)
	{
		$cek_user = Syuser::find($request->userid);
		if ($cek_user->def_plant == '002') {
			$direct = isset($request->direct) ? $request->direct : url('home');
		} else {
			$direct = isset($request->direct) ? $request->direct : url('home');
			// $direct = isset($request->direct) ? $request->direct : url('client');
		}
		$cleanDirect = false;
		if ($direct == url('/')) {
			$direct = url('home');
			$cleanDirect = true;
		}

		if (Config::get('auth.auth_mode') == 'ldap') {
			try {

				if (Adldap::auth()->attempt($request->userid, $request->password, $bindAsUser = true)) {
					// Credentials were correct.
					$ldap = Adldap::search()->where('samaccountname', '=', $request->userid)->first();
					$old = Syuser::find($request->userid);
					$syuser = Syuser::find($request->userid);

					if (!$syuser) {

						$syuser = new Syuser();
						$syuser->userid = $request->userid;
						$syuser->created_by = $syuser->userid;
						$syuser->created_at = date('Y-m-d H:i:s');
						$syuser->updated_at = date('Y-m-d H:i:s');

						if ($syuser->save()) {
							//log here
						}
					}
					//update last user in local database
					$syuser->userid = $request->userid;
					$syuser->username = $ldap->sn[0];
					$syuser->attr = Sf::setJson($syuser->attr, 'ldap_distinguishedname', $ldap->distinguishedname[0]); //json_encode(['ldap_distinguishedname' => $ldap->distinguishedname[0]]);
					$syuser->email = @$ldap->mail[0] == '' ? @$syuser->email : @$ldap->mail[0];
					$syuser->password = Hash::make($request->password);
					$syuser->updated_at = date('Y-m-d H:i:s');

					if ($syuser->save()) {
						Session::put('userid', $syuser->userid);
						Session::put('username', $syuser->username);
						Session::put('plant', "");
						Session::put('login_type', Config::get('auth.auth_mode'));
						Session::put('login_date', date('Y-m-d H:i:s'));

						if (Auth::attempt(['userid' => $request->userid, 'password' => $request->password], $request->rememberme)) {

							if (($default_plant = Sf::getJson($syuser->attr, 'default_plant')) != '') {
								$this->selectPlantSet($default_plant);
							}

							Sf::log("SF_LOGIN", $syuser->userid, "Login application success (" . $syuser->userid . ")", HomeController::class . "@" . __FUNCTION__);

							$default_menu = Sf::getJson($syuser->attr, 'default_menu');
							if ($default_menu != '' && $cleanDirect == true) {
								$direct = $default_menu;
							}

							// \App\Sf::waSend($request->userid, "🔰 *Security Alert* 🔰 \nAnda baru saja login aplikasi *" . \App\Sf::getParsys('APP_DESC') . "* milik DSN Wood Product \nPada " . date('d F Y  H:i:s'), $default_plant, 'sys_system', $request->userid);

							return redirect($direct);
						} else {
							$msg = "Attempt failure.";
							return view('sys.system.sflogin', compact(['msg', 'direct']));
						}
					} else {
						$msg = "Update from LDAP Server failure.";
						return view('sys.system.sflogin', compact(['msg', 'direct']));
					}
				} else {
					$msg = "Credentials were incorrect.";
					return view('sys.system.sflogin', compact(['msg', 'direct']));
				}
			} catch (\Adldap\Exceptions\Auth\UsernameRequiredException $e) {
				$msg = "LDAP Credentials were incorrect.";
				return view('sys.login', compact(['msg', 'direct']));
			}
		}

		if (Auth::attempt(['userid' => @$request->userid, 'password' => @$request->password], @$request->rememberme)) {
			Sf::log("sys_system", @$request->userid, "Login success : " . @$request->userid, "auth");
			// \App\Sf::waSend($request->userid, "🔰 *Security Alert* 🔰 \nAnda baru saja login aplikasi *" . \App\Sf::getParsys('APP_DESC') . "* milik DSN Wood Product \nPada " . date('d F Y  H:i:s'), @$default_plant, 'sys_system', $request->userid);
			return redirect($direct);
		} else {
			Sf::log("sys_system", @$request->userid, "Login failure : " . @$request->userid, "auth");
			$msg = "Authentication failure.";
			return view('sys.system.sflogin', compact(['request', 'msg', 'direct']));
		}
	}

	public function getSfDialog(Request $request)
	{
		return view('sys.system.dialog.sfdialog', compact(['request']));
	}

	public static function getListMenus()
	{
		$data = Symenu::whereNull('parent')
			->with(['rel_symenu'])
			->get();

		return $data;
	}

	public static function getListMenu()
	{
		$userid = Auth::user()->userid;
		$recMenu = Sylink::select('key2')->where('rel', 'sygroup-symenu')->whereIn('key1', function ($q2) use ($userid) {
			$q2->select('key2')->from('sylink')->where('rel', 'syuser-sygroup')->where('key1', $userid)->whereNull('deleted_at');
		})->whereNull('deleted_at')->get();
		$arrMenu = [];
		foreach ($recMenu as $key => $v) {
			$arrMenu[] = $v->key2;
		}
		$data = Symenu::whereNull('parent')
			->with(['rel_symenu' => function ($q1) use ($arrMenu) {
				$q1->whereIn('menu_id', $arrMenu)->with(['rel_symenu' => function ($q2) use ($arrMenu) {
					$q2->whereIn('menu_id', $arrMenu)->with(['rel_symenu' => function ($q3) use ($arrMenu) {
						$q3->whereIn('menu_id', $arrMenu)->with(['rel_symenu'])->whereNull('deleted_at');
					}])->whereNull('deleted_at');
				}])->whereNull('deleted_at');
			}])->whereNull('deleted_at')
			->whereIn('menu_id', $arrMenu)
			->orderBy('order_no')
			->get();
		return $data;
	}

	public function selectPlant()
	{
		$default = Auth::user()->def_plant;
		$syplant = Syplant::find($default);
		if (!$syplant == false) {
			$this->selectPlantSet($syplant->plant);
		}
		return Sf::selectPlant();
	}
	public function selectPlantSet($plant)
	{
		if ($plant != '') {
			Session::put('plant', $plant);
			$syuser = Syuser::find(Auth::user()->userid);
			if ($syuser != false) {
				$syuser->def_plant = $plant;
				$syuser->save();
			}
			return "Success";
		} else {
			return response("Failure", 500);
		}
	}

	public function setUserAttr(Request $request)
	{
		$syuser = Syuser::find(Auth::user()->userid);
		if ($syuser != false) {
			$syuser->attr = Sf::setJson($syuser->attr, @$request->attr_id, @$request->attr_value);
			$syuser->save();
			return $request->attr_value . " set as default";
		}
		return response("Failure", 500);
	}

	public function srcPage(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		return view('sys.system.utility.src_page', compact(['request', 'plant']));
	}

	public function srcResult(Request $request)
	{
		$f = json_decode($request->f);
		$data = Symenu::where(function ($q) use ($f) {
			$q->orWhere('label', 'like', "%" . @$f->q . "%");
			$q->orWhere('url', 'like', "%" . @$f->q . "%");
		})
			->whereNotNull('url')
			->where('url', '<>', '')
			->with(['rel_parent' => function ($q) {
				$q->with(['rel_parent' => function ($q1) {
					$q1->with(['rel_parent' => function ($q2) {
						$q2->with(['rel_parent']);
					}]);
				}]);
			}])
			->get();

		return response()->json(compact(['data']));
	}

	public function uploadFile(Request $request)
	{
		if (!Auth::check()) {
			return response()->json("Session expired, Please re-login", 500);
		}
		$mime = [];
		/** kirim dengan parameter s
		 * t : text
		 * i : image
		 * a : audio
		 * v : video
		 * p : application
		 * x : all mime
		 * */

		$arrMime = ['t' => 'text', 'i' => 'image', 'a' => 'audio', 'v' => 'video', 'p' => 'application'];

		foreach ($arrMime as $k => $v) {
			if (Sf::strLike(@$request->s, $k) || Sf::strLike(@$request->s, 'x')) {
				$mime[] = $v;
			}
		}

		if (isset($request->file)) {
			$path = "/uploads/" . @$request->path . "/" . @$request->id . "/";
			$upload = Sf::fileUpload($request->file, $path, $mime);
			if ($upload == false) {
				return response()->json("Failure when upload file => " . json_encode($mime), 500);
			}
			Sf::log(@$request->path, @$request->id, "Upload file : " . @$upload, "file");

			return $upload; //berisi url file terupload
		}
	}

	public function deleteFile(Request $request)
	{
		Storage::disk('ftp')->delete($request->file_name);
		return response()->json("Deleted");
	}

	public function exportPdf(Request $request)
	{
		$url = $request->url;
		$html = Sf::apiGet($url, $status);
		$pdf = PDF::loadHTML($html);
		return $pdf->download(date('YmdHis') . '_export.pdf');
	}

	public function sfLogout()
	{
		if (Auth::check()) {
			Auth::logout();
		}
		return redirect("/login");
	}
}
