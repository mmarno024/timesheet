<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use Session;
use DateTime;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Models\Trs_h;
use App\Models\Trs_d_instalasi;
use App\Models\Trs_d_instalasi_note;
use App\Models\Trs_d_instalasi_sending;
use App\Models\Trs_d_instalasi_sensor_pasang;
use App\Models\Trs_d_instalasi_setup_setting;
use App\Models\Trs_d_image;

class InstalasiController extends Controller
{
    public function daftarInstalasi() {
        $data_ts = Trs_h::where('jenis_ts', 'INSTALLATION')->with('rel_userid')->with('rel_d_instalasi')->simplePaginate(10);
        return view('daftar_instalasi', ['data_ts' => $data_ts]);
    }
    public function showFormInputInstalasi() {
        return view('input_instalasi');
    }

    public function inputInstalasi(Request $request) {
        $simpan_h = Trs_h::insert([
            "jenis_ts" => "INSTALLATION",
            "kd_ts" => "TS-INST-".date("YmdHi"),
            "userid" => Auth::user()->id,
            "tanggal_ts" => date("Y-m-d", strtotime($request->tanggal_ts)),
            "created_by" => Auth::user()->id,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
        $h_id = DB::getPdo()->lastInsertId();
        if($simpan_h){
            $simpan_instalasi = Trs_d_instalasi::insert([
                "h_id" => $h_id,
                "konsumen" => $request->konsumen,
                "nama_alat" => $request->nama_alat,
                "nama_pos" => $request->nama_pos,
                "no_hp_pos" => $request->no_hp_pos,
                "kabupaten" => $request->kabupaten,
                "kecamatan" => $request->kecamatan,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "foot_mulai" => $request->foot_mulai,
                "foot_selesai" => $request->foot_selesai,
                "foot_instansi_customer" => $request->foot_instansi_customer,
                "foot_nama_customer" => $request->foot_nama_customer,
                "foot_jabatan_customer" => $request->foot_jabatan_customer,
                "foot_teknisi1" => $request->foot_teknisi1,
                "foot_ttd_teknisi1" => $request->foot_ttd_teknisi1,
                "foot_teknisi2" => $request->foot_teknisi2,
                "foot_ttd_teknisi2" => $request->foot_ttd_teknisi2,
                "foot_ttd_customer" => $request->foot_ttd_customer,
                "foot_kualitas_pekerjaan" => $request->foot_kualitas_pekerjaan,
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
            if($simpan_instalasi){
                $simpan_setup_setting = Trs_d_instalasi_setup_setting::insert([
                    "h_id" => $h_id,
                    "solar_panel" => $request->solar_panel == "solar_panel" ? "yes" : NULL,
                    "solar_panel_note" => $request->solar_panel_note,
                    "accu" => $request->accu == "accu" ? "yes" : NULL,
                    "accu_note" => $request->accu_note,
                    "solar_charge" => $request->solar_charge == "solar_charge" ? "yes" : NULL,
                    "solar_charge_note" => $request->solar_charge_note,
                    "box_panel" => $request->box_panel == "box_panel" ? "yes" : NULL,
                    "box_panel_note" => $request->box_panel_note,
                    "logger" => $request->logger == "logger" ? "yes" : NULL,
                    "logger_note" => $request->logger_note,
                    "gsm_modem" => $request->gsm_modem == "gsm_modem" ? "yes" : NULL,
                    "gsm_modem_note" => $request->gsm_modem_note,
                    "interval_simpan" => $request->interval_simpan == "interval_simpan" ? "yes" : NULL,
                    "interval_simpan_note" => $request->interval_simpan_note,
                    "kalibrasi_resolusi" => $request->kalibrasi_resolusi == "kalibrasi_resolusi" ? "yes" : NULL,
                    "kalibrasi_resolusi_note" => $request->kalibrasi_resolusi_note,
                    "level_awal" => $request->level_awal == "level_awal" ? "yes" : NULL,
                    "level_awal_note" => $request->level_awal_note,
                    "aktivasi_alarm" => $request->aktivasi_alarm == "aktivasi_alarm" ? "yes" : NULL,
                    "aktivasi_alarm_note" => $request->aktivasi_alarm_note,
                    "cek_pembacaan" => $request->cek_pembacaan == "cek_pembacaan" ? "yes" : NULL,
                    "cek_pembacaan_note" => $request->cek_pembacaan_note,
                    "sms_server" => $request->sms_server == "sms_server" ? "yes" : NULL,
                    "sms_server_note" => $request->sms_server_note,
                    "web_server" => $request->web_server == "web_server" ? "yes" : NULL,
                    "web_server_note" => $request->web_server_note,
                    "mail_server" => $request->mail_server == "mail_server" ? "yes" : NULL,
                    "mail_server_note" => $request->mail_server_note,
                    "jwt_ftp_http_server" => $request->jwt_ftp_http_server == "jwt_ftp_http_server" ? "yes" : NULL,
                    "jwt_ftp_http_server_note" => $request->jwt_http_server_note,
                    "capture_mms" => $request->capture_mms == "capture_mms" ? "yes" : NULL,
                    "capture_mms_note" => $request->capture_mms_note,
                    "no_user1" => $request->no_user1,
                    "no_user2" => $request->no_user2,
                    "no_user3" => $request->no_user3,
                    "no_user4" => $request->no_user4,
                    "no_user5" => $request->no_user5,
                    "updated_at" => date("Y-m-d H:i:s"),
                ]);
                if($simpan_setup_setting){
                    $simpan_sending = Trs_d_instalasi_sending::insert([
                        "h_id" => $h_id,
                        "status_setup_server1" => $request->status_setup_server1,
                        "status_setup_server2" => $request->status_setup_server2,
                        "status_setup_server3" => $request->status_setup_server3,
                        "address1" => $request->address1,
                        "address2" => $request->address2,
                        "address3" => $request->address3,
                        "username1" => $request->username1,
                        "username2" => $request->username2,
                        "username3" => $request->username3,
                        "password1" => $request->password1,
                        "password2" => $request->password2,
                        "password3" => $request->password3,
                        "interval_data1" => $request->interval_data1,
                        "interval_data2" => $request->interval_data2,
                        "interval_data3" => $request->interval_data3,
                        "status_photo_web1" => $request->status_photo_web1,
                        "status_photo_web2" => $request->status_photo_web2,
                        "status_photo_web3" => $request->status_photo_web3,
                        "interval_photo1" => $request->interval_photo1,
                        "interval_photo2" => $request->interval_photo2,
                        "interval_photo3" => $request->interval_photo3,
                        "updated_at" => date("Y-m-d H:i:s"),
                    ]);
                    if($simpan_sending){
                        $simpan_note = Trs_d_instalasi_note::insert([
                            "h_id" => $h_id,
                            "note1" => $request->note1,
                            "updated_at" => date("Y-m-d H:i:s"),
                        ]);
                        if($simpan_note){
                            foreach($request->value as $v) {
                                $data_sensor[] = $v;
                                if($v['nama'] != NULL || $v['sn'] != NULL || $v['spek_rentang_ukur'] != NULL || $v['nilai_kalibrasi'] != NULL) {
                                    $simpan_sensor_pasang = Trs_d_instalasi_sensor_pasang::insert([
                                    "h_id" => $h_id,
                                    "nama" => $v['nama'],
                                    "sn" => $v['sn'],
                                    "spek_rentang_ukur" => $v['spek_rentang_ukur'],
                                    "nilai_kalibrasi" => $v['nilai_kalibrasi'],
                                    ]);
                                }
                            }
                            if ($request->hasfile('filename')) {
                                $images = $request->file('filename');
                                foreach($images as $image) {
                                    $filename = date('YmdHis').''.$image->getClientOriginalName();
                                    $path = $image->storeAs('uploads', $filename, 'uploads');
                                    $name = $image->getClientOriginalName();
                                    Trs_d_image::create([
                                        'h_id' => $h_id,
                                        'filename' => $name,
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'path' => $path
                                    ]);
                                }
                            }
                            return redirect()->route('daftar_instalasi');
                        } else {
                            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                            return redirect()->route('input_instalasi');
                        }
                    } else {
                        Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                        return redirect()->route('input_instalasi');
                    }
                } else {
                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                    return redirect()->route('input_instalasi');
                }
            } else {
                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                return redirect()->route('input_instalasi');
            }
        }else {
            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
            return redirect()->route('input_instalasi');
        }
        // $request->validate([
        //     'filename' => 'required',
        // ]);
        // if ($request->hasfile('filename')) {
        //     $images = $request->file('filename');
        //     foreach($images as $image) {
        //         $filename = date('YmdHis').''.$image->getClientOriginalName();
        //         $path = $image->storeAs('uploads', $filename, 'public');
        //         Trs_d_image::create([
        //             'h_id' => $h_id,
        //             'filename' => $filename,
        //             'path' => '/storage/'.$path
        //         ]);
        //     }
        // }
        return redirect()->route('daftar_instalasi');
    }
    public function showFormEditInstalasi($id) {
        $cekData = Trs_h::findOrFail($id);
        if ($cekData) {
            $dataTs = Trs_h::where('id', $id)
            ->with('rel_d_instalasi')
            ->with('rel_d_instalasi_note')
            ->with('rel_d_instalasi_sending')
            ->with('rel_d_instalasi_sensor_pasang')
            ->with('rel_d_instalasi_setup_setting')
            ->with('rel_d_img')
            ->first();
        }
        $count = sizeOf($dataTs->rel_d_instalasi_sensor_pasang);
        $count_x = $count+1;
        return view('edit_instalasi', ['dataTs' => $dataTs, 'count_x' => $count_x]);
    }
    public function updateInstalasi(Request $request){
        $cek_h = Trs_h::where('id', $request->id)->first();
        $update_h = Trs_h::where('id', $cek_h->id)->update([
            "tanggal_ts" => date("Y-m-d", strtotime($request->tanggal_ts)),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
        if($update_h){
            Trs_d_instalasi::where('h_id', $cek_h->id)->forceDelete();
            $update_instalasi = Trs_d_instalasi::insert([
                'h_id' => $cek_h->id,
                "konsumen" => $request->konsumen,
                "nama_alat" => $request->nama_alat,
                "nama_pos" => $request->nama_pos,
                "no_hp_pos" => $request->no_hp_pos,
                "kabupaten" => $request->kabupaten,
                "kecamatan" => $request->kecamatan,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "foot_mulai" => $request->foot_mulai,
                "foot_selesai" => $request->foot_selesai,
                "foot_instansi_customer" => $request->foot_instansi_customer,
                "foot_nama_customer" => $request->foot_nama_customer,
                "foot_jabatan_customer" => $request->foot_jabatan_customer,
                "foot_teknisi1" => $request->foot_teknisi1,
                "foot_ttd_teknisi1" => $request->foot_ttd_teknisi1,
                "foot_teknisi2" => $request->foot_teknisi2,
                "foot_ttd_teknisi2" => $request->foot_ttd_teknisi2,
                "foot_ttd_customer" => $request->foot_ttd_customer,
                "foot_kualitas_pekerjaan" => $request->foot_kualitas_pekerjaan,
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
            if($update_instalasi){
                Trs_d_instalasi_setup_setting::where('h_id', $cek_h->id)->forceDelete();
                $update_setup_setting = Trs_d_instalasi_setup_setting::insert([
                    'h_id' => $cek_h->id,
                    "solar_panel" => $request->solar_panel == "solar_panel" ? "yes" : NULL,
                    "solar_panel_note" => $request->solar_panel_note,
                    "accu" => $request->accu == "accu" ? "yes" : NULL,
                    "accu_note" => $request->accu_note,
                    "solar_charge" => $request->solar_charge == "solar_charge" ? "yes" : NULL,
                    "solar_charge_note" => $request->solar_charge_note,
                    "box_panel" => $request->box_panel == "box_panel" ? "yes" : NULL,
                    "box_panel_note" => $request->box_panel_note,
                    "logger" => $request->logger == "logger" ? "yes" : NULL,
                    "logger_note" => $request->logger_note,
                    "gsm_modem" => $request->gsm_modem == "gsm_modem" ? "yes" : NULL,
                    "gsm_modem_note" => $request->gsm_modem_note,
                    "interval_simpan" => $request->interval_simpan == "interval_simpan" ? "yes" : NULL,
                    "interval_simpan_note" => $request->interval_simpan_note,
                    "kalibrasi_resolusi" => $request->kalibrasi_resolusi == "kalibrasi_resolusi" ? "yes" : NULL,
                    "kalibrasi_resolusi_note" => $request->kalibrasi_resolusi_note,
                    "level_awal" => $request->level_awal == "level_awal" ? "yes" : NULL,
                    "level_awal_note" => $request->level_awal_note,
                    "aktivasi_alarm" => $request->aktivasi_alarm == "aktivasi_alarm" ? "yes" : NULL,
                    "aktivasi_alarm_note" => $request->aktivasi_alarm_note,
                    "cek_pembacaan" => $request->cek_pembacaan == "cek_pembacaan" ? "yes" : NULL,
                    "cek_pembacaan_note" => $request->cek_pembacaan_note,
                    "sms_server" => $request->sms_server == "sms_server" ? "yes" : NULL,
                    "sms_server_note" => $request->sms_server_note,
                    "web_server" => $request->web_server == "web_server" ? "yes" : NULL,
                    "web_server_note" => $request->web_server_note,
                    "mail_server" => $request->mail_server == "mail_server" ? "yes" : NULL,
                    "mail_server_note" => $request->mail_server_note,
                    "jwt_ftp_http_server" => $request->jwt_ftp_http_server == "jwt_ftp_http_server" ? "yes" : NULL,
                    "jwt_ftp_http_server_note" => $request->jwt_ftp_http_server_note,
                    "capture_mms" => $request->capture_mms == "capture_mms" ? "yes" : NULL,
                    "capture_mms_note" => $request->capture_mms_note,
                    "no_user1" => $request->no_user1,
                    "no_user2" => $request->no_user2,
                    "no_user3" => $request->no_user3,
                    "no_user4" => $request->no_user4,
                    "no_user5" => $request->no_user5,
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);
                if($update_setup_setting){
                    Trs_d_instalasi_sending::where('h_id', $cek_h->id)->forceDelete();
                    $update_sending = Trs_d_instalasi_sending::insert([
                        'h_id' => $cek_h->id,
                        "status_setup_server1" => $request->status_setup_server1,
                        "status_setup_server2" => $request->status_setup_server2,
                        "status_setup_server3" => $request->status_setup_server3,
                        "address1" => $request->address1,
                        "address2" => $request->address2,
                        "address3" => $request->address3,
                        "username1" => $request->username1,
                        "username2" => $request->username2,
                        "username3" => $request->username3,
                        "password1" => $request->password1,
                        "password2" => $request->password2,
                        "password3" => $request->password3,
                        "interval_data1" => $request->interval_data1,
                        "interval_data2" => $request->interval_data2,
                        "interval_data3" => $request->interval_data3,
                        "status_photo_web1" => $request->status_photo_web1,
                        "status_photo_web2" => $request->status_photo_web2,
                        "status_photo_web3" => $request->status_photo_web3,
                        "interval_photo1" => $request->interval_photo1,
                        "interval_photo2" => $request->interval_photo2,
                        "interval_photo3" => $request->interval_photo3,
                        "updated_at" => date('Y-m-d H:i:s'),
                    ]);
                    if($update_sending){
                        Trs_d_instalasi_note::where('h_id', $cek_h->id)->forceDelete();
                        $update_note = Trs_d_instalasi_note::insert([
                            'h_id' => $cek_h->id,
                            "note1" => $request->note1,
                            "updated_at" => date('Y-m-d H:i:s'),
                        ]);
                        if($update_note){
                            Trs_d_instalasi_sensor_pasang::where('h_id', $cek_h->id)->forceDelete();
                            foreach($request->value as $v) {
                                $data_sensor[] = $v;
                                if($v['nama'] != NULL || $v['sn'] != NULL || $v['spek_rentang_ukur'] != NULL || $v['nilai_kalibrasi'] != NULL) {
                                    $update_sensor_pasang = Trs_d_instalasi_sensor_pasang::insert([
                                    'h_id' => $cek_h->id,
                                    "nama" => $v['nama'],
                                    "sn" => $v['sn'],
                                    "spek_rentang_ukur" => $v['spek_rentang_ukur'],
                                    "nilai_kalibrasi" => $v['nilai_kalibrasi'],
                                    "updated_at" => date('Y-m-d H:i:s'),
                                    ]);
                                }
                            }
                            if ($request->hasfile('filename')) {
                                Trs_d_image::where('h_id', $cek_h->id)->forceDelete();
                                $images = $request->file('filename');
                                foreach($images as $image) {
                                    $filename = date('YmdHis').''.$image->getClientOriginalName();
                                    $path = $image->storeAs('uploads', $filename, 'uploads');
                                    $name = $image->getClientOriginalName();
                                    Trs_d_image::create([
                                        'h_id' => $cek_h->id,
                                        'filename' => $name,
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'path' => $path
                                    ]);
                                }
                            }
                            return redirect()->route('daftar_instalasi');
                        } else {
                            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                            return redirect()->route('daftar_instalasi');
                        }
                    } else {
                        Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                        return redirect()->route('daftar_instalasi');
                    }
                } else {
                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                    return redirect()->route('daftar_instalasi');
                }
            } else {
                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                return redirect()->route('daftar_instalasi');
            }
        } else {
            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
            return redirect()->route('daftar_instalasi');
        }
        return response($cek_h);
    }
}
