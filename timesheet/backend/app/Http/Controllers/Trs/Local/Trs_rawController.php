<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_hardware;
use App\Model\Trs\Local\Mst_hardware_d1;
use App\Model\Trs\Local\Trs_raw_d_img;
use App\Model\Trs\Local\Trs_raw_h;
use App\Model\Trs\Local\Mst_sensor;
use App\Sf;
use DB;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class Trs_rawController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_trs_raw', 'Trs_rawController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.trs_raw.trs_raw_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_TRS_RAW_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $time1 = $request->t1;
        $time2 = $request->t2;
        $request->q = str_replace(' ', '%', $request->q);
        $data = Trs_raw_h::select('trs_raw_h.browser', 'trs_raw_h.buka_pintu', 'trs_raw_h.created_at', 'trs_raw_h.updated_at', 'trs_raw_h.created_by', 'trs_raw_h.id', 'trs_raw_h.sender', 'trs_raw_h.timeutc', 'trs_raw_h.timelocal', 'trs_raw_h.timestamp', 'trs_raw_h.tlocal', 'trs_raw_h.tzone', 'hard.kd_logger', 'hard.kd_hardware', 'hard.latitude', 'hard.location', 'hard.longitude', 'hard.penjumlahan', 'hard.perkalian', 'hard.plant', 'hard.pos_name')
        ->where('trs_raw_h.kd_logger', '!=', '5')
        ->where(function ($q) use ($request) {
            $q->orWhere('trs_raw_h.id', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs_raw_h.kd_logger', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs_raw_h.kd_hardware', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs_raw_h.uid', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs_raw_h.location', 'like', '%' . @$request->q . '%');
        })
        ->with('rel_d_gpa')
        ->with('rel_kd_logger')
        ->with('rel_plant')
        ->whereBetween('trs_raw_h.tlocal', [$time1, $time2])
        ->join(DB::raw('mst_hardware as hard'),'hard.kd_hardware', '=', 'trs_raw_h.kd_hardware')
        ->groupBy(['trs_raw_h.kd_hardware', 'trs_raw_h.tlocal'])
        ->orderBy('trs_raw_h.id', $request->order_by);
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        if ($request->plant != '002') {
            $data = $data->where('hard.plant', $request->plant);
        }
        if ($request->qplant != '' || $request->qplant != null) {
            $data = $data->where('hard.plant', $request->qplant);
        }
        if ($request->lg != '' || $request->lg != null) {
            $data = $data->where('trs_raw_h.kd_logger', $request->lg);
        }
        if ($request->hw != '' || $request->hw != null) {
            $data = $data->where('trs_raw_h.kd_hardware', $request->hw);
        }

        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function edit($id)
    {
        $cek = Trs_raw_h::select('kd_logger')->where('id', $id)->first();
        $h = Trs_raw_h::where('id', $id)
        ->with(['rel_d_gpa' => function ($q) {
            $q->with('rel_sensor');
        }])
        ->withTrashed()
        ->first();
        return response()->json(compact(['h']));
    }

    public function getSensor(Request $request)
    {
        $kd_hardware = $request->hw;
        $q = Mst_hardware_d1::where('kd_hardware', $kd_hardware)->get();
        $sensorData = [];
        foreach ($q as $k => $v) {
            $sensorData[$k]['kd_sensor'] = $v->kd_sensor;
            $sensorData[$k]['nm_sensor'] = $v->rel_sensor->nm_sensor;
        }
        return response()->json(compact('sensorData'));
    }

    public function getDetail(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_raw.trs_raw_frm_detail', compact(['request', 'plant']));
    }

    public function getDetailList(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_logger = $request->lg;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        $colors = ['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6', '#DD4477', '#66AA00', '#B82E2E', '#316395', '#994499', '#22AA99', '#AAAA11', '#6633CC', '#E67300', '#8B0707', '#329262', '#5574A6', '#651067'];
        $data_logger = Mst_hardware::select('log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
        ->where('mst_hardware.kd_hardware', $kd_hardware)
        ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
        ->first();
        $date_first = '2022-01-01 00:00:00';
        $interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;
        $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
        ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
        ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
        ->get();
        foreach ($cek_sensor as $kx => $vx) {
            if($vx->kd_type == 'rain') {
                $q = "SELECT 
                a.`id`,
                DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, c.`satuan`, 
                MAX(b.`value`) as `value`,
                a.`location`,
                COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY tlocal, b.`kd_sensor`
                ORDER BY tlocal ASC";
            } else {
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            }
        }
        $raw = DB::select(DB::raw($q));
        if ($raw == '' || $raw == null) {
            $note = 'kosong';
            return response()->json(compact(['data_logger', 'note']));
        } else {
            $h_id = [];
            foreach ($raw as $k => $v) {
                if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                    $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                } elseif ($vqmode == 'Perjam') {
                    $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                    $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                } elseif ($vqmode == 'Harian') {
                    $group_view = date('Y-m-d', strtotime($v->tlocal));
                    $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                } elseif ($vqmode == 'Bulanan') {
                    $group_view = date('Y-m', strtotime($v->tlocal));
                    $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                }
            }
            $arr_data = [];
            foreach ($h_id as $k1 => $v1) {
                foreach ($v1 as $k2 => $v2) {
                    $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                    ->where('kd_sensor', $k2)
                    ->first();
                    $sum_val = [];
                    foreach ($v2 as $k3 => $v3) {
                        $sum_val[$k3] = $v3->value;
                    }
                    if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                        $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                    } else {
                        $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                    }
                }
            }
            $arr_table = [];
            foreach ($arr_data as $k1 => $v1) {
                $arr_table[$k1]['date_act'] = $k1;
                $arr_table[$k1]['sensor'] = $v1;
            }
            $data_table = [];
            foreach ($arr_table as $k1 => $v1) {
                $data_table[] = $v1;
            }
            $data_graph = [];
            foreach ($arr_data as $k1 => $v1) {
                $data_graph['graph']['label'][$k1]['date'] = $k1;
                $no = 0;
                foreach ($arr_data[$k1] as $k2 => $v2) {
                    $data_graph['graph']['data'][$k2]['nilai'][] = $arr_data[$data_graph['graph']['label'][$k1]['date']][$k2]['value'];
                    $data_graph['graph']['data'][$k2]['properties'] = $arr_data[$data_graph['graph']['label'][$k1]['date']][$k2]['properties'];
                    $data_graph['graph']['data'][$k2]['properties']->color = $colors[$no++];
                }
            }
            foreach ($data_graph as $k1 => $v1) {
                $data_graph['datax'][$k1] = @$data_graph['datax'][$k1] = $v1['data'];
            }
            $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                ->whereBetween('tlocal', [$time1, $time2])
                ->with('rel_kd_logger')
                ->with('rel_kd_hardware')
                ->orderBy('id', 'DESC')
                ->get();
            $data_img = [];
            foreach ($raw as $k => $v) {
                $data_img[$k] = $v;
            }
            return response()->json(compact(['data_logger', 'data_graph', 'data_table', 'data_img']));
        }
    }

    public function getDetailAll(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        return view('trs.local.trs_raw.trs_raw_frm_detail_all', compact(['request', 'plant']));
    }

    public function getDetailListAll(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        if(isset($kd_hardware)){
            $colors = ['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6', '#DD4477', '#66AA00', '#B82E2E', '#316395', '#994499', '#22AA99', '#AAAA11', '#6633CC', '#E67300', '#8B0707', '#329262', '#5574A6', '#651067'];
            $data_logger = Mst_hardware::select('log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
            ->where('mst_hardware.kd_hardware', $kd_hardware)
            ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
            ->first();
            @$kd_logger = $data_logger->kd_logger;
            $date_first = '2022-01-01 00:00:00';
            @$interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;            
            $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
            ->where('mst_hardware_d1.kd_hardware',$data_logger->kd_hardware)
            ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
            ->get();
            foreach ($cek_sensor as $kx => $vx) {
                if($vx->kd_type == 'rain') {
                    $q = "SELECT 
                    a.`id`,
                    DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                    (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                    ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                    a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                    b.`kd_sensor`, c.`satuan`, 
                    MAX(b.`value`) as `value`,
                    a.`location`,
                    COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                    FROM trs_raw_h a
                    INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                    INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                    WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                    AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                    GROUP BY tlocal, b.`kd_sensor`
                    ORDER BY tlocal ASC";
                } else {
                    $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                    b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                    FROM trs_raw_h a
                    INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                    INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                    WHERE a.`kd_logger` = '" . $kd_logger . "' 
                    AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                    GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                }
            }
            $raw = DB::select(DB::raw($q));
            if ($raw == '' || $raw == null) {
                $note = 'kosong';
                return response()->json(compact(['data_logger', 'note']));
            } else {
                $h_id = [];
                foreach ($raw as $k => $v) {
                    if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                        $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Perjam') {
                        $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Harian') {
                        $group_view = date('Y-m-d', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Bulanan') {
                        $group_view = date('Y-m', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    }
                }
                $arr_data = [];
                foreach ($h_id as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                        ->where('kd_sensor', $k2)
                        ->first();
                        $sum_val = [];
                        foreach ($v2 as $k3 => $v3) {
                            $sum_val[$k3] = $v3->value;
                        }
                        if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                        } else {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                        }
                    }
                }
                $arr_table = [];
                foreach ($arr_data as $k1 => $v1) {
                    $arr_table[$k1]['date_act'] = $k1;
                    $arr_table[$k1]['sensor'] = $v1;
                }

                $data_table = [];
                foreach ($arr_table as $k1 => $v1) {
                    $data_table[] = $v1;
                }

                $data_graph = [];
                foreach ($arr_data as $k1 => $v1) {
                    $data_graph['graph']['label'][$k1]['date'] = $k1;
                    $no = 0;
                    foreach ($arr_data[$k1] as $k2 => $v2) {
                        $data_graph['graph']['data'][$k2]['nilai'][] = $arr_data[$data_graph['graph']['label'][$k1]['date']][$k2]['value'];
                        $data_graph['graph']['data'][$k2]['properties'] = $arr_data[$data_graph['graph']['label'][$k1]['date']][$k2]['properties'];
                        $data_graph['graph']['data'][$k2]['properties']->color = $colors[$no++];
                    }
                }
                foreach ($data_graph as $k1 => $v1) {
                    $data_graph['datax'][$k1] = @$data_graph['datax'][$k1] = $v1['data'];
                }

                $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                    ->whereBetween('tlocal', [$time1, $time2])
                    ->with('rel_kd_logger')
                    ->with('rel_kd_hardware')
                    ->orderBy('id', 'DESC')
                    ->get();
                $data_img = [];
                foreach ($raw as $k => $v) {
                    $data_img[$k] = $v;
                }

                return response()->json(compact(['data_logger', 'data_graph', 'data_table', 'data_img']));
            }
        }
    }

    public function getDetailPdf(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_logger = $request->lg;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        $data_logger = Mst_hardware::select('log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
        ->where('mst_hardware.kd_hardware', $kd_hardware)
        ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
        ->first();
        $date_first = '2022-01-01 00:00:00';
        $interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;
        if ($kd_logger == 5) {
            $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                ->whereBetween('tlocal', [$time1, $time2])
                ->with('rel_kd_logger')
                ->with('rel_kd_hardware')
                ->orderBy('id', 'DESC')
                ->get();
            $data_img = [];
            foreach ($raw as $k => $v) {
                $data_img[$k] = $v;
            }
            return response()->json(compact('data_img'));
        } else {
            if ($kd_logger == 1) {
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_wl b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 2){
                $q = "SELECT 
                a.`id`,
                DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, c.`satuan`, 
                MAX(b.`value`) as `value`,
                a.`location`,
                COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_ch b ON b.`h_id` = a.`id` 
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "' 
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY tlocal
                ORDER BY tlocal ASC";
            } else if ($kd_logger == 3){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_extenso b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 4){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_suhu b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 5){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_img b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 8){
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            } else {
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            }
            $raw = DB::select(DB::raw($q));
            if ($raw == '' || $raw == null) {
                $note = 'kosong';
                return response()->json(compact(['data_logger', 'note']));
            } else {
                $h_id = [];
                foreach ($raw as $k => $v) {
                    if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                        $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Perjam') {
                        $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Harian') {
                        $group_view = date('Y-m-d', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Bulanan') {
                        $group_view = date('Y-m', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    }
                }
                $arr_data = [];
                foreach ($h_id as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                        ->where('kd_sensor', $k2)
                        ->first();
                        $sum_val = [];
                        foreach ($v2 as $k3 => $v3) {
                            $sum_val[$k3] = $v3->value;
                        }
                        if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                        } else {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                        }
                    }
                }
                $arr_table = [];
                foreach ($arr_data as $k1 => $v1) {
                    $arr_table[$k1]['date_act'] = $k1;
                    $arr_table[$k1]['sensor'] = $v1;
                }

                $data_table = [];
                foreach ($arr_table as $k1 => $v1) {
                    $data_table[] = $v1;
                }

                $pdf = PDF::loadview('trs.local.trs_raw.trs_raw_frm_detail_pdf', ['time1' => $time1, 'time2' => $time2, 'data_logger' => $data_logger, 'data_table' => $data_table]);
                return $pdf->download('laporan-detail-logger.pdf');
            }
        }
    }

    public function getDetailPdfAll(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        $data_logger = Mst_hardware::select('pl.plantname', 'log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
        ->where('mst_hardware.kd_hardware', $kd_hardware)
        ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
        ->join(DB::raw('syplant as pl'), 'pl.plant', '=', 'mst_hardware.plant')
        ->first();
        @$kd_logger = $data_logger->kd_logger;
        $date_first = '2022-01-01 00:00:00';
        @$interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;
        if ($kd_logger == 5) {
            $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                ->whereBetween('tlocal', [$time1, $time2])
                ->with('rel_kd_logger')
                ->with('rel_kd_hardware')
                ->orderBy('id', 'DESC')
                ->get();
            $data_img = [];
            foreach ($raw as $k => $v) {
                $data_img[$k] = $v;
            }
            return response()->json(compact('data_img'));
        } else {
            if ($kd_logger == 1) {
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_wl b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 2){
                $q = "SELECT 
                a.`id`,
                DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, c.`satuan`, 
                MAX(b.`value`) as `value`,
                a.`location`,
                COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_ch b ON b.`h_id` = a.`id` 
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "' 
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY tlocal
                ORDER BY tlocal ASC";
            } else if ($kd_logger == 3){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_extenso b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 4){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_suhu b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 5){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_img b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 8){
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            } else {
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            }
            $raw = DB::select(DB::raw($q));
            if ($raw == '' || $raw == null) {
                $note = 'kosong';
                return response()->json(compact(['data_logger', 'note']));
            } else {
                $h_id = [];
                foreach ($raw as $k => $v) {
                    if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                        $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Perjam') {
                        $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Harian') {
                        $group_view = date('Y-m-d', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Bulanan') {
                        $group_view = date('Y-m', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    }
                }
                $arr_data = [];
                foreach ($h_id as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                        ->where('kd_sensor', $k2)
                        ->first();
                        $sum_val = [];
                        foreach ($v2 as $k3 => $v3) {
                            $sum_val[$k3] = $v3->value;
                        }
                        if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                        } else {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                        }
                    }
                }
                $arr_table = [];
                foreach ($arr_data as $k1 => $v1) {
                    $arr_table[$k1]['date_act'] = $k1;
                    $arr_table[$k1]['sensor'] = $v1;
                }

                $data_table = [];
                foreach ($arr_table as $k1 => $v1) {
                    $data_table[] = $v1;
                }

                $pdf = PDF::loadview('trs.local.trs_raw.trs_raw_frm_detail_all_pdf', ['time1' => $time1, 'time2' => $time2, 'data_logger' => $data_logger, 'data_table' => $data_table]);
                return $pdf->download('laporan-detail-logger.pdf');
            }
        }
    }

    public function getDetailXls(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_logger = $request->lg;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        $data_logger = Mst_hardware::select('log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
        ->where('mst_hardware.kd_hardware', $kd_hardware)
        ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
        ->first();
        $date_first = '2022-01-01 00:00:00';
        $interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;
        if ($kd_logger == 5) {
            $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                ->whereBetween('tlocal', [$time1, $time2])
                ->with('rel_kd_logger')
                ->with('rel_kd_hardware')
                ->orderBy('id', 'DESC')
                ->get();
            $data_img = [];
            foreach ($raw as $k => $v) {
                $data_img[$k] = $v;
            }
            return response()->json(compact('data_img'));
        } else {
            if ($kd_logger == 1) {
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_wl b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 2){
                $q = "SELECT 
                a.`id`,
                DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, c.`satuan`, 
                MAX(b.`value`) as `value`,
                a.`location`,
                COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_ch b ON b.`h_id` = a.`id` 
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "' 
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY tlocal
                ORDER BY tlocal ASC";
            } else if ($kd_logger == 3){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_extenso b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 4){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_suhu b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 5){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_img b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 8){
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            } else {
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            }
            $raw = DB::select(DB::raw($q));
            if ($raw == '' || $raw == null) {
                $note = 'kosong';
                return response()->json(compact(['data_logger', 'note']));
            } else {
                $h_id = [];
                foreach ($raw as $k => $v) {
                    if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                        $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Perjam') {
                        $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Harian') {
                        $group_view = date('Y-m-d', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Bulanan') {
                        $group_view = date('Y-m', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    }
                }
                $arr_data = [];
                foreach ($h_id as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                        ->where('kd_sensor', $k2)
                        ->first();
                        $sum_val = [];
                        foreach ($v2 as $k3 => $v3) {
                            $sum_val[$k3] = $v3->value;
                        }
                        if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                        } else {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                        }
                    }
                }
                
                $arr_table = [];
                $no = 1;
                foreach ($arr_data as $k1 => $v1) {
                    $arr_table[$k1]['no'] = $no++;
                    $arr_table[$k1]['kode_alat']=$data_logger->kd_hardware;
                    $arr_table[$k1]['lokasi']=$data_logger->location;
                    $arr_table[$k1]['koordinat']=$data_logger->latitude .' ,'. $data_logger->longitude;
                    $arr_table[$k1]['waktu']=$k1;
                    foreach($v1 as $k2 => $v2) {
                        $arr_table[$k1][$v2['properties']->nm_sensor . ' (' .$v2['properties']->satuan .')'] = (String)$v2['value'];
                    }
                }
                foreach($arr_table as $k1 => $v1) {
                    $export[] = $v1;
                }
                Excel::create('Export Data Excel',function($excel) use ($export){
                    $excel->sheet('Sheet 1',function($sheet) use ($export){
                        $sheet->fromArray($export);
                    });
                })->export('xlsx');
            }
        }
    }

    public function getDetailXlsAll(Request $request)
    {
        $time1 = $request->t1;
        $time2 = $request->t2;
        $kd_hardware = $request->hw;
        $vqmode = $request->vq;
        $data_logger = Mst_hardware::select('log.kd_logger', 'log.nm_logger', 'mst_hardware.kd_hardware', 'mst_hardware.location', 'mst_hardware.latitude', 'mst_hardware.longitude', 'mst_hardware.tlocal', 'mst_hardware.send_interval', 'mst_hardware.reset_interval')
        ->where('mst_hardware.kd_hardware', $kd_hardware)
        ->join(DB::raw('mst_logger as log'), 'log.kd_logger', '=', 'mst_hardware.kd_logger')
        ->first();
        @$kd_logger = $data_logger->kd_logger;
        $date_first = '2022-01-01 00:00:00';
        $interval = $data_logger->send_interval == null || $data_logger->send_interval == '' ? 60 : $data_logger->send_interval;
        if ($kd_logger == 5) {
            $raw = Trs_raw_d_img::where('kd_hardware', $kd_hardware)
                ->whereBetween('tlocal', [$time1, $time2])
                ->with('rel_kd_logger')
                ->with('rel_kd_hardware')
                ->orderBy('id', 'DESC')
                ->get();
            $data_img = [];
            foreach ($raw as $k => $v) {
                $data_img[$k] = $v;
            }
            return response()->json(compact('data_img'));
        } else {
            if ($kd_logger == 1) {
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_wl b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 2){
                $q = "SELECT 
                a.`id`,
                DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, c.`satuan`, 
                MAX(b.`value`) as `value`,
                a.`location`,
                COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_ch b ON b.`h_id` = a.`id` 
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "' 
                AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY tlocal
                ORDER BY tlocal ASC";
            } else if ($kd_logger == 3){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_extenso b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 4){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_suhu b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 5){
                $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                FROM trs_raw_h a
                INNER JOIN trs_raw_d_img b ON b.`h_id` = a.`id`
                INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                WHERE a.`kd_logger` = '" . $kd_logger . "' 
                AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
            } else if ($kd_logger == 8){
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_ftp b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            } else {
                $cek_sensor = Mst_hardware_d1::select('mst_hardware_d1.kd_sensor','stype.kd_type')
                    ->where('mst_hardware_d1.kd_hardware',$kd_hardware)
                    ->join(DB::raw('mst_sensor as stype'), 'stype.kd_sensor', '=', 'mst_hardware_d1.kd_sensor')
                    ->get();
                foreach ($cek_sensor as $kx => $vx) {
                    if($vx->kd_type == 'rain') {
                        $q = "SELECT 
                        a.`id`,
                        DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE) AS `tlocal`,
                        (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts1`, 
                        ROUND(UNIX_TIMESTAMP(DATE_ADD('". $date_first ."', INTERVAL FLOOR(TIMESTAMPDIFF(MINUTE, '". $date_first ."', a.`tlocal`) / $interval) * $interval MINUTE))) AS `ts`,  
                        a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, c.`satuan`, 
                        MAX(b.`value`) as `value`,
                        a.`location`,
                        COUNT(DISTINCT (a.`kd_hardware`)) AS distinct_tlocal
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id` 
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' AND a.`kd_hardware` = '" . $kd_hardware . "'
                        AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY tlocal, b.`kd_sensor`
                        ORDER BY tlocal ASC";
                    } else {
                        $q = "SELECT a.`id`, a.`tlocal`, (UNIX_TIMESTAMP(a.`tlocal`)) AS `ts`, a.`created_at`, a.`kd_logger`, a.`kd_hardware`,
                        b.`kd_sensor`, b.`value`, c.`satuan`, a.`location`
                        FROM trs_raw_h a
                        INNER JOIN trs_raw_d_gpa b ON b.`h_id` = a.`id`
                        INNER JOIN mst_sensor c ON c.`kd_sensor` = b.`kd_sensor`
                        WHERE a.`kd_logger` = '" . $kd_logger . "' 
                        AND a.`kd_hardware` = '" . $kd_hardware . "' AND a.`tlocal` BETWEEN '" . $time1 . "' AND '" . $time2 . "'
                        GROUP BY a.`tlocal`, b.`kd_sensor` ORDER BY a.`tlocal` ASC";
                    }
                }
            }
            $raw = DB::select(DB::raw($q));
            if ($raw == '' || $raw == null) {
                $note = 'kosong';
                return response()->json(compact(['data_logger', 'note']));
            } else {
                $h_id = [];
                foreach ($raw as $k => $v) {
                    if (empty($vqmode) || $vqmode == '' || $vqmode == 'Interval Kirim') {
                        $h_id[$v->tlocal][$v->kd_sensor][$k] = @$h_id[$v->tlocal][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Perjam') {
                        $group_view = date('Y-m-d H:00', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Harian') {
                        $group_view = date('Y-m-d', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    } elseif ($vqmode == 'Bulanan') {
                        $group_view = date('Y-m', strtotime($v->tlocal));
                        $h_id[$group_view][$v->kd_sensor][$k] = @$h_id[$group_view][$v->kd_sensor][$k] = $v;
                    }
                }
                $arr_data = [];
                foreach ($h_id as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $arr_data[$k1][$k2]['properties'] = Mst_sensor::select('cumulative', 'kd_sensor', 'kd_type', 'nm_sensor', 'satuan')
                        ->where('kd_sensor', $k2)
                        ->first();
                        $sum_val = [];
                        foreach ($v2 as $k3 => $v3) {
                            $sum_val[$k3] = $v3->value;
                        }
                        if ($arr_data[$k1][$k2]['properties']->kd_type == 'rain') {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val), 3);
                        } else {
                            $arr_data[$k1][$k2]['value'] = round(array_sum($sum_val) / count($sum_val), 3);
                        }
                    }
                }
                
                $arr_table = [];
                $no = 1;
                foreach ($arr_data as $k1 => $v1) {
                    $arr_table[$k1]['no'] = $no++;
                    $arr_table[$k1]['kode_alat']=$data_logger->kd_hardware;
                    $arr_table[$k1]['lokasi']=$data_logger->location;
                    $arr_table[$k1]['koordinat']=$data_logger->latitude .' ,'. $data_logger->longitude;
                    $arr_table[$k1]['waktu']=$k1;
                    foreach($v1 as $k2 => $v2) {
                        $arr_table[$k1][$v2['properties']->nm_sensor . ' (' .$v2['properties']->satuan .')'] = (String)$v2['value'];
                    }
                }
                foreach($arr_table as $k1 => $v1) {
                    $export[] = $v1;
                }
                Excel::create('Export Data Excel',function($excel) use ($export){
                    $excel->sheet('Sheet 1',function($sheet) use ($export){
                        $sheet->fromArray($export);
                    });
                })->export('xlsx');
            }
        }
    }
}
