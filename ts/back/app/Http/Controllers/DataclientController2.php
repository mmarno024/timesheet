<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_api;
use App\Models\Users_api_ip;
use App\Models\Users_api_is;
use App\Models\Users_api_hw;
use App\Models\User;
use Auth;
use DB;

class DataclientController extends Controller
{
    public function index()
    {
        return "Page not available access";
    }

    public function viewData(request $request)
    {
        // $indicesServer = [
        //     'GATEWAY_INTERFACE', 'SERVER_ADDR', 'SERVER_NAME', 'REQUEST_METHOD', 'REQUEST_TIME', 'REQUEST_TIME_FLOAT', 'HTTP_ACCEPT', 'HTTP_CONNECTION', 'HTTP_HOST', 'HTTP_USER_AGENT', 'REMOTE_ADDR'
        // ];
        // $responses = [];
        // foreach ($indicesServer as $arg) {
        //     if (isset($_SERVER[$arg])) {
        //         $responses[] = $arg . ' = ' . $_SERVER[$arg];
        //     } else {
        //         $responses[] = $arg;
        //     }
        // }

        // $ip_address = $request->ip();
        // return response()->json(compact(['responses','ip_address']));

        $today = date("Y-m-d");
        $user = substr($request->pt, 9);
        $token = substr($request->pt, 0, 8);
        $hardware = $request->dev;
        $ip_address = $request->ip();
        $cek_user = Users_api::where('user', $user)->where('token', $token)->where('status', '!=', NULL)->first();
        if ($cek_user) {
            if ($cek_user->status == 'Aktif') {
                if ($cek_user->expired_date >= $today) {
                    // $cek_ip = Users_api_ip::where('users_api', $cek_user->id)->where('ip_address', $ip_address)->first();
                    // if ($cek_ip) {
                    $cek_hw = Users_api_hw::where('users_api', $cek_user->id)->where('hardware', $hardware)->first();
                    if ($cek_hw) {
                        $q = "SELECT
                            a.`id_instansi`,a.`nm_instansi`,
                            b.`id_stasiun`,b.`nm_stasiun`,b.`nm_lokasi`,b.`nm_desa`,
                            b.`nm_kecamatan`,b.`utm_y`,b.`utm_x`,
                            c.`id_logger`,c.`id_hardware`,c.`tipe_device`,
                            d.`id_channel`,d.`id_sensor`,d.`id_port`,d.`nm_channel`,
                            d.`lvl_alarm0`,d.`lvl_alarm1`,d.`lvl_alarm2`,d.`lvl_alarm3`,d.`lvl_alarm4`,
                            d.`level_skrg`,d.`satuan`,d.`marker`,d.`tgl_update`,
                            e.`capture`,e.`data_sampel`,e.`data_aktual`,e.`data_harian`,
                            f.`kd_device`,f.`nm_device`,
                            g.`kd_propinsi`,g.`kd_kabupaten`,g.`nm_kabupaten`,h.`nm_propinsi`
                            FROM `ms_instansi` a
                            INNER JOIN `ms_stasiun` b ON b.`id_instansi`=a.`id_instansi`
                            INNER JOIN `ms_logger` c ON c.`id_stasiun`=b.`id_stasiun`
                            INNER JOIN `ms_channel` d ON d.`id_logger`=c.`id_logger`
                            INNER JOIN `tr_data` e ON e.`id_channel`=d.`id_channel`
                            INNER JOIN `jn_device` f ON f.`kd_device`=c.`tipe_device`
                            INNER JOIN `ms_kabupaten` g ON g.`kd_kabupaten`=b.`kd_kabupaten`
                            INNER JOIN `ms_propinsi` h ON h.`kd_propinsi`=g.`kd_propinsi`
                            WHERE e.`id_hardware` = '" . $hardware . "'
                            ORDER BY e.`wkt_terima` DESC LIMIT 1";
                        $raw = DB::connection('wmdb')->select(DB::raw($q));
                        $data = [];
                        foreach ($raw as $k => $v) {
                            $data['id_instansi'] = $v->id_instansi;
                            $data['nm_instansi'] = $v->nm_instansi;
                            $data['id_stasiun'] = $v->id_stasiun;
                            $data['nm_stasiun'] = $v->nm_stasiun;
                            $data['nm_lokasi'] = $v->nm_lokasi;
                            $data['nm_desa'] = $v->nm_desa;
                            $data['nm_kecamatan'] = $v->nm_kecamatan;
                            $data['nm_kabupaten'] = $v->nm_kabupaten;
                            $data['nm_provinsi'] = $v->nm_propinsi;
                            $data['utm_y'] = $v->utm_y;
                            $data['utm_x'] = $v->utm_x;
                            $data['id_logger'] = $v->id_logger;
                            $data['id_hardware'] = $v->id_hardware;
                            $data['tipe_device'] = $v->tipe_device;
                            $data['id_channel'] = $v->id_channel;
                            $data['id_sensor'] = $v->id_sensor;
                            $data['id_port'] = $v->id_port;
                            $data['nm_channel'] = $v->nm_channel;
                            $data['lvl_alarm0'] = $v->lvl_alarm0;
                            $data['lvl_alarm1'] = $v->lvl_alarm1;
                            $data['lvl_alarm2'] = $v->lvl_alarm2;
                            $data['lvl_alarm3'] = $v->lvl_alarm3;
                            $data['lvl_alarm4'] = $v->lvl_alarm4;
                            $data['level_skrg'] = $v->level_skrg;
                            $data['satuan'] = $v->satuan;
                            $data['marker'] = $v->marker;
                            $data['tgl_update'] = $v->tgl_update;
                            $data['capture'] = $v->capture;
                            $data['data_sample'] = $v->data_sampel;
                            $data['data_aktual'] = $v->data_aktual;
                            $data['data_harian'] = $v->data_harian;
                            $date = date('Y-m-d %');
                            $q2 = "SELECT
                            MAX(`data_harian`) AS max_dh,
                            MIN(`data_harian`) AS min_dh,
                            SUM(`data_harian`) AS sum_dh,
                            AVG(`data_harian`) AS avg_dh
                            FROM tr_data
                            WHERE `id_hardware`='" . $v->id_hardware . "' AND `wkt_terima` LIKE '" . $date . "'";
                            $raw2 = DB::connection('wmdb')->select(DB::raw($q2));
                            $data2 = [];
                            foreach ($raw2 as $k2 => $v2) {
                                $data['harian_min'] = $v2->min_dh;
                                $data['harian_max'] = $v2->max_dh;
                                if ($v->kd_device == '1') {
                                    $data['harian_avg'] = $v2->avg_dh;
                                } else {
                                    $data['harian_sum'] = $v2->sum_dh;
                                }
                            }

                            // $data['instansi'] = $v->nm_instansi;
                            // $data['stasiun'] = $v->nm_stasiun;
                            // $data['sensor'] = $v->id_sensor;
                            // $data['hardware'] = $v->id_hardware;
                            // $data['waktu_terima'] = $v->wkt_terima;
                            // $data['nilai_level'] = $v->level;
                            // $data['satuan'] = $v->satuan;
                            // $data['longitude'] = $v->longitude;
                            // $data['latitude'] = $v->latitude;
                        }
                    } else {
                        $data = 'Device is not registered';
                    }
                    // } else {
                    //     $data = 'IP Address is not registered';
                    // }
                } else {
                    $data = 'User activation is expired';
                }
            } else {
                $data = 'User is not registered';
            }
            return response()->json($data);
        }
    }
}
