<?php

namespace App;

use App\Model\Sys\Syaccess;
use App\Model\Sys\Sylink;
use App\Model\Sys\Sylog;
use App\Model\Sys\Syparsys;
use App\Model\Sys\Syplant;
use App\Model\Sys\Syuser;
use App\Model\Trs\Local\Nmobdev;
use Auth;
use DB;
use File;
use GuzzleHttp;
use Image;
use Session;
use Storage;

class Sf
{

	private static $strreason;

	public static function isPlant()
	{
		$plant = Session::get('plant', '');
		if ($plant == '') {
			if (Auth::check()) {
				$plant = Auth::user()->def_plant;
				$userid = Auth::user()->userid;

				$syplant = Syplant::whereIn('plant', function ($q) use ($userid) {
					$q->select('key2')->from('sylink')->where('rel', 'syuser-syplant')->where('key1', $userid);
				})->where('plant', $plant)
					->get();

				if ($syplant == []) {
					return false;
				}

				Session::put('plant', $plant);
				$syuser = Syuser::find(Auth::user()->userid);
				if ($syuser != false) {
					$syuser->def_plant = $plant;
					$syuser->save();
					return $plant;
				}
			}
			return false;
		}
		return $plant;
	}

	public static function autonumber($prefix, $length, $conn, $field, $table, $where = "")
	{
		if ($conn == "") {
			$conn = "mysql";
		}
		$query = "SELECT MAX(CONVERT(MID($field," . (strlen($prefix) + 1) . "," . ($length - strlen($prefix)) . "),UNSIGNED INTEGER))+1 AS NOMOR
                        FROM $table WHERE LEFT($field," . (strlen($prefix)) . ")='$prefix' $where";
		$data = DB::connection($conn)->select(DB::raw($query));

		if ($data == false) {
			$last = 0;
		} else {
			$last = @$data[0]->NOMOR;
		}

		$num = $length - strlen($prefix) - strlen($last);
		$zero = "";
		for ($i = 0; $i < $num; $i++) {
			$zero = $zero . "0";
		}
		return $prefix . $zero . $last;
	}

	public static function parseComboStrToArr($str)
	{
		//for string convertion with format : val1|label1, val2|label2, etc...
		$str = str_replace(array("\r\n", "\n", "\r"), ' ', $str);
		$arr = [];
		$part1 = explode(",", $str);
		foreach ($part1 as $key => $value) {
			$part2 = explode("|", $value);
			if (count($part2) > 1) {
				$arr[] = [$part2[0], $part2[1]];
			} else {
				$arr[] = [$value, $value];
			}
		}
		return $arr;
	}

	public static function selectPlant()
	{
		$userid = Auth::user()->userid;
		$syplant = Syplant::whereIn('plant', function ($q) use ($userid) {
			$q->select('key2')->from('sylink')->where('rel', 'syuser-syplant')->where('key1', $userid);
		})
			->get();
		return view('sys.system.utility.select_plant', compact(['syplant']));
	}

	public static function log($trs, $doc_no, $activity, $tag = '')
	{
		$sylog = new Sylog();
		$sylog->trs = $trs;
		$sylog->doc_no = $doc_no;
		$sylog->activity = $activity;
		$sylog->tag = $tag;
		$sylog->created_by = @Auth::user()->userid;
		$sylog->created_at = date('Y-m-d H:i:s');
		$sylog->updated_at = date('Y-m-d H:i:s');
		$sylog->save();
		return true;
	}

	public static function setJson($json, $key, $val)
	{
		try {
			$arr = json_decode($json, true);
		} catch (\Exception $e) {
			$arr = [];
		}
		if (!is_array($arr)) {
			$arr = [];
		}
		$arr[$key] = $val;
		return json_encode($arr);
	}

	public static function getJson($json, $key)
	{
		try {
			$arr = json_decode($json, true);
		} catch (\Exception $e) {
			$arr = [];
		}
		return isset($arr[$key]) ? $arr[$key] : '';
	}

	public static function getParsys($key, $plant = '')
	{
		$syparsys = Syparsys::find($key);
		if ($syparsys == false) {
			return "";
		}

		if ($syparsys->isplant == 1) {
			$val = Sf::getJson($syparsys->parvalue, $plant == '' ? Session::get('plant') : $plant);
		} else {
			$val = $syparsys->parvalue;
		}
		return $val;
	}

	public static function getPlantall($plant)
	{
		$syplant = Syplant::find($plant);
		$val = $syplant;
		return $val;
	}

	public static function getPlantname($plant)
	{
		$syplant = Syplant::find($plant);
		$val = $syplant;
		return $val->plantname;
	}

	public static function getAddr($plant)
	{
		$syplant = Syplant::find($plant);
		$val = $syplant;
		return $val->addr;
	}

	public static function allowed($accessid, $plant = '', $userid = '')
	{
		if ($userid == '') {
			$userid = Auth::user()->userid;
		}

		if ($plant == '') {
			$plant = Session::get('plant');
		}

		$syaccess = Syaccess::find($accessid);
		if ($syaccess == false) {
			self::$strreason = "Access Key $accessid not found";
			return false;
		}
		if ($syaccess->accessgroup == 'user') {
			$sylink = Sylink::where('rel', 'syuser-syaccess')
				->where('key1', $userid)
				->where('key2', $accessid);
		} else if ($syaccess->accessgroup == 'group') {
			$sylink = Sylink::where('rel', 'sygroup-syaccess')
				->whereIn('key1', function ($q) use ($userid) {
					$q->select('key2')->from('sylink')->where('rel', 'syuser-sygroup')->where('key1', $userid)->whereNull('deleted_at');
				})
				->where('key2', $accessid);
		}
		if ($syaccess->location == 1 || $syaccess->location == 2) {
			$sylink = $sylink->where('key3', $plant);
			$toplan = $plant;
		}
		$ttl = $sylink->count();
		if ($ttl > 0) {
			return true;
		} else {
			self::$strreason = "You have no " . $syaccess->accessgroup . " access  " . $syaccess->accessname . " $accessid " . @$toplant;
			Sf::log("sys_system", $accessid, "Failure access : " . $accessid, "auth");
			return false;
		}
	}

	public static function reason()
	{
		return self::$strreason;
	}

	public static function fileUpload($file, $path, $mime = ['image'])
	{

		// if (!Sf::allowed(strtoupper($path) . '_U')) {
		//     return false;
		// }

		$contents = File::get($file);
		$filename = $file->getClientOriginalName();
		$destination = $path . "/" . $filename;

		$mimetype = File::mimeType($file->getRealPath());
		$ex = explode("/", $mimetype);
		$prefix = isset($ex[0]) ? $ex[0] : '';

		if (!in_array($prefix, $mime)) {
			return false;
		}

		if (Storage::disk('ftp')->put($destination, $contents)) {
			return $path . "/" . $filename;
		} else {
			return false;
		}
	}

	public static function fileFtpUrl($filename = '')
	{
		return url('/libftp/' . $filename);
	}

	public static function fileFtpUrl2($filename = '')
	{
		return url('palu_media/' . $filename);
	}

	public static function fileFtpAuthUrl($filename = '')
	{
		return url('/libftp_auth/' . $filename);
	}

	public static function fileDelete($filename)
	{
		if (!Storage::disk('ftp')->exists($filename)) {
			return response("File Not Found : " . $filename, 404);
		}

		$file = Storage::disk('ftp')->delete($filename);

		return true;
	}

	public static function fileGet($filename, \Illuminate\Http\Request $request)
	{

		if (!Storage::disk('ftp')->exists($filename)) {
			return response("File Not Found : " . $filename, 404);
		}

		$file = Storage::disk('ftp')->get($filename);
		Storage::put("libftp/" . $filename, $file);
		$mime = Storage::mimeType("libftp/" . $filename);
		Storage::delete("libftp/" . $filename);

		if (isset($request->resize) && $request->resize == 1) {
			//sample : http://operation.com:8001/libftp/auth//uploads/sys_syuser/url_img/0012369/minidsngroup.jpg?resize=1&h=100&w=1000
			$file = Image::make($file)->resize($request->w, $request->h);
			return $file->response();
		}
		if (isset($request->fit) && $request->fit == 1) {
			//sample : http://operation.com:8001/libftp/auth//uploads/sys_syuser/url_img/0012369/minidsngroup.jpg?fit=1&h=100&w=1000
			$file = Image::make($file)->fit($request->w, $request->h);
			return $file->response();
		}

		return response($file)->header('Content-Type', $mime)->header('Cache-Control', 'max-age=2592000,public');
	}

	public static function fileList(\Illuminate\Http\Request $request)
	{
		$files = [];
		$data = Storage::disk('ftp')->files("uploads/" . $request->path);
		foreach ($data as $key => $file) {
			$files[$key]['name'] = $file;
			$part = explode("/", $file);
			$ext = explode(".", $file);
			$files[$key]['file_name'] = end($part);
			$files[$key]['extension'] = end($ext);
			$files[$key]['size'] = round(Storage::disk('ftp')->size($file) / 1024);
		}
		return response()->json(compact(['files']));
	}

	public static function strLike($key, $word)
	{
		if (strpos($key, $word) === false) {
			return false;
		} else {
			return true;
		}
	}

	public static function safeDiv($number, $devide_by)
	{
		if ($devide_by == 0) {
			return 0;
		} else {
			return $number / $devide_by;
		}
	}

	public static function arrToLineChart($arr, $labelKey, $arrKeys, $title, $subtitle = "", $arrHorizontal = [], $arrVertical = [], $arrConfig = [])
	{
		$arr = json_decode(json_encode($arr), 1);
		$category = [];
		foreach ($arr as $k => $v) {
			$category[] = ["label" => @$v[$labelKey] . " "];
			if (in_array(@$v[$labelKey], $arrVertical)) {
				$category[] = ["label" => "Line", "vline" => "true", "color" => "#F2726F"];
			}
		}
		$dataset = [];
		foreach ($arrKeys as $key => $value) {
			if (is_array($value)) {
				$str1 = @$value[0];
				$str2 = @$value[1];
			} else {
				$str1 = @$value;
				$str2 = @$value;
			}
			$temp = [];
			foreach ($arr as $k => $v) {
				$temp[] = ["value" => $v[$str1]];
			}
			$dataset[] = [
				'seriesname' => $str2,
				'data' => $temp,
				'anchorAlpha' => 0,
			];
		}

		$trendlines = [];
		foreach ($arrHorizontal as $key => $value) {
			if (is_array($value)) {
				$trendlines[] = json_decode('
                {
                    "line": [{
                        "startvalue": "' . @$value[0] . '",
                        "color": "' . (@$value[2] == '' ? '#62B58F' : @$value[2]) . '",
                        "valueOnRight": "1",
                        "displayvalue": "' . (@$value[1] == '' ? 'Normal' : @$value[1]) . '"
                    }]
                }');
			} else {
				$trendlines[] = json_decode('
                {
                    "line": [{
                        "startvalue": "' . $value . '",
                        "color": "#62B58F",
                        "valueOnRight": "1",
                        "displayvalue": "Normal"
                    }]
                }');
			}
		}

		// dd($trendlines);

		$def = '{
        "chart": {
            "theme": "fusion",
            "caption": "' . $title . '",
            "subCaption": "' . $subtitle . '",
            "setAdaptiveXMin":"1",
            "xAxisName": ""
        },
        "categories": [{
            "category":' . json_encode($category) . '
        }],
        "dataset": ' . json_encode($dataset) . ',
        "trendlines": ' . json_encode($trendlines) . '
    }';

		return json_decode($def);
	}

	public static function apiGet($url, &$status = '')
	{
		$client = new GuzzleHttp\Client();
		$res = $client->request('GET', $url);
		$status = $res->getStatusCode(); // 200
		$body = $res->getBody()->getContents();
		return $body;
	}

	public static function convertArrayToSapApi($arr, $delimiter = "__|__", $type = "D:")
	{
		$str = "";
		if (!count($arr) == 0) {
			$str = "H:";
			foreach ($arr[0] as $k => $v) {
				$str .= $delimiter . str_replace($delimiter, "?", $k);
			}
			$str .= "\n";
			foreach ($arr as $k => $v) {
				$str .= $type;
				foreach ($v as $k1 => $v1) {
					$v1 = preg_replace('~[\r\n]+~', '', $v1);
					$str .= $delimiter . str_replace($delimiter, "?", $v1);
				}
				$str .= "\n";
			}
		}
		return $str;
	}

	public static function dateFromSap($date, $intFormat = 1)
	{
		$thn = substr($date, 0, 4);
		$bln = substr($date, 4, 2);
		$tgl = substr($date, 6, 2);
		$monthName = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ags', 'Sep', 'Oct', 'Nov', 'Dec');
		switch ($intFormat) {
			case 1: // from 20131231 output 2013-12-31
				$result = $thn . "-" . $bln . "-" . $tgl;
				break;
			case 2: // from 20131231 output 31-12-2013
				$result = $tgl . "-" . $bln . "-" . $thn;
				break;
			case 3: // from 20131231 output 31 Dec 2013
				$result = $tgl . " " . $monthName[(int) $bln] . " " . $thn;
				break;
			case 4: // from 2013/12/31 output 31.12.2013
				$arr = explode("/", $date);
				$result = $arr[2] . "." . $arr[1] . "." . $arr[0];
				break;
			case 5: // from 2013-12-31 output 31.12.2013
				$arr = explode("-", $date);
				$result = $arr[2] . "." . $arr[1] . "." . $arr[0];
				break;
		}
		return $result;
	}

	public static function utcToDate($utc, $format = 'Y-m-d')
	{
		return date($format, strtotime($utc));
	}

	public static function waSend($userid, $msg, $plant, $app, $trs_key)
	{
		// $url = url('api/wa/send');

		$url = Sf::getParsys('API_SMART') . 'wa/send';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array(
			'userid' => $userid,
			'msg' => $msg,
			'plant' => $plant,
			'app' => $app,
			'trs_key' => $trs_key,
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	//function mobile
	public static function checkAPIKEY($device_id, $uuid, $apikey, $userid)
	{
		$result = true;

		$data = Nmobdev::where('uuid', $uuid)->where('apikey', $apikey)->where('userid', $userid)->where('device_id', $device_id)->first();
		if (!$data) {
			$result = false;
		}

		return $result;
	}

	public static function generateRandomString($len)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_{}?';
		$randstring = '';
		for ($i = 0; $i < $len; $i++) {
			$randstring .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randstring;
	}

	public static function dateFormatID($date)
	{
		$day = [
			'null',
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		];
		$month = [
			'null',
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		];

		return $day[(int)date('N', strtotime($date))] . ", " . date('d', strtotime($date)) . " " . $month[(int)date('m', strtotime($date))] . " " . date('Y', strtotime($date));
	}

	public static function getDbName($schema)
	{
		$value = config('database.connections.' . $schema . '.database');
		return $value;
	}
}
