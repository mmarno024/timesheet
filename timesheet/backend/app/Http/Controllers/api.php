<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Model\Trs\Local\Mst_hardware;


class api extends Controller
{
	public function index()
	{
		$id = request()->segment(2);
		$cek_id_hardware = Mst_hardware::find($id);
		if (!empty($cek_id_hardware)) {
			$q = "SELECT  a.`jenis_loger`, a.`no_seri_data_loger`, a.`lokasi`, a.`latitude`, a.`longitude`, a.`created_at`, 
				c.`nm_sensor`, a.`baca_sensor_level`, a.`nilai_curah_hujan`, a.`baca_sensor_rekahan`, b.`satuan` 
				FROM `trs_raw` a
				LEFT JOIN `mst_hardware` b ON a.`no_seri_data_loger`=b.`kd_hardware`
				LEFT JOIN `mst_sensor` c ON b.`kd_sensor`=c.`kd_sensor`
				WHERE a.`no_seri_data_loger`='" . $id . "'
				ORDER BY a.`created_at` DESC LIMIT 1";

			$data = DB::select(DB::raw($q));
			if (@$data[0]->jenis_loger == 1 || @$data[0]->jenis_loger == 9) {
				$level = @$data[0]->baca_sensor_level;
			} else if (@$data[0]->jenis_loger == 2) {
				$level = @$data[0]->nilai_curah_hujan;
			} else {
				$level = @$data[0]->baca_sensor_rekahan;
			}
			$result['loggers'] = array(
				'id' => @$data[0]->no_seri_data_loger,
				'name' => @$data[0]->lokasi,
				'latitude' => @$data[0]->latitude,
				'longitude' => @$data[0]->longitude,
				'time' => @$data[0]->created_at,
				'sensor' => @$data[0]->nm_sensor,
				'level' => @$level,
				'sat' => @$data[0]->satuan
			);
		} else {
			$result['loggers'] = array('id' => 'Not available');
		}

		$json_string = json_encode($result);
		echo $json_string;
	}
}
