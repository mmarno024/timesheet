<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Trs_raw_d_img;
use App\Sf;
use DB;
use Illuminate\Http\Request;

class Trs_imgController extends Controller
{
	public function index(Request $request)
	{
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}
		Sf::log("trs_local_trs_img", "Trs_imgController@" . __FUNCTION__, "Open Page  ", "link");
		return view('trs.local.trs_img.trs_img_frm', compact(['request', 'plant']));
	}

	public function getList(Request $request)
	{
		if (!Sf::allowed('TRS_LOCAL_TRS_IMG_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$time1 = $request->t1;
		$time2 = $request->t2;
		$request->q = str_replace(" ", "%", $request->q);
		$imgData = Trs_raw_d_img::where(function ($q) use ($request) {
			$q->orWhere('trs_raw_d_img.kd_logger', 'like', "%" . @$request->q . "%");
			$q->orWhere('trs_raw_d_img.kd_hardware', 'like', "%" . @$request->q . "%");
			$q->orWhere('trs_raw_d_img.location', 'like', "%" . @$request->q . "%");
		})
			->where('hard.plant', '!=', NULL)
			->whereBetween('trs_raw_d_img.date_capture', array($time1, $time2))
			->join(DB::raw('mst_hardware as hard'), 'hard.kd_hardware', '=', 'trs_raw_d_img.kd_hardware')
			->orderBy('trs_raw_d_img.id', $request->order_by);
		if ($request->plant != '002') {
			$imgData = $imgData->where('hard.plant', $request->plant);
		}
		if ($request->qplant != '' || $request->qplant != NULL) {
			$imgData = $imgData->where('hard.plant', $request->qplant);
		}
		if ($request->hw != '' || $request->hw != NULL) {
			$imgData = $imgData->where('trs_raw_d_img.kd_hardware', $request->hw);
		}
		$imgData = $imgData->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'trs_raw_d_img.kd_logger');
		$imgData = $imgData->get();
		return response()->json(compact(['imgData']));
	}
}
