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

use App\Models\Trs_h;
use App\Models\Trs_d_service;
use App\Models\Trs_d_service_action;
use App\Models\Trs_d_service_investigasi;
use App\Models\Trs_d_service_kategori;
use App\Models\Trs_d_service_note;
use App\Models\Trs_d_service_pekerjaan;
use App\Models\Trs_d_service_problem;
use App\Models\Trs_d_service_spare_part;
use App\Models\Trs_d_service_stock_from;
use App\Models\Trs_d_image;

class ServiceController extends Controller
{
    public function daftarService()
    {
        $data_ts = Trs_h::where('jenis_ts', 'SERVICE')->with('rel_userid')->with('rel_d_service')->simplePaginate(10);
        return view('daftar_service', ['data_ts' => $data_ts]);
    }
    public function showFormInputService()
    {
        return view('input_service');
    }

    public function inputService(Request $request)
    {
        $simpan_h = Trs_h::insert([
            "jenis_ts" => "SERVICE",
            "kd_ts" => "TS-SERV-".date("YmdHi"),
            "userid" => Auth::user()->id,
            "tanggal_ts" => date("Y-m-d", strtotime($request->tanggal_ts)),
            "created_by" => Auth::user()->id,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
        $h_id = DB::getPdo()->lastInsertId();
        if($simpan_h) {
            $simpan_service = Trs_d_service::insert([
                "h_id" => $h_id,
                "konsumen" => $request->konsumen,
                "lokasi_pos" => $request->lokasi_pos,
                "alamat" => $request->alamat,
                "nama_alat" => $request->nama_alat,
                "serial_no" => $request->serial_no,
                "foot_mulai" => $request->foot_mulai,
                "foot_selesai" => $request->foot_selesai,
                "foot_ppic" => $request->foot_ppic,
                "foot_ttd_ppic" => $request->foot_ttd_ppic,
                "foot_pemeriksa" => $request->foot_pemeriksa,
                "foot_ttd_pemeriksa" => $request->foot_ttd_pemeriksa,
                "foot_nama_customer" => $request->foot_nama_customer,
                "foot_jabatan_customer" => $request->foot_jabatan_customer,
                "foot_ttd_customer" => $request->foot_ttd_customer,
                "foot_kualitas_pekerjaan" => $request->foot_kualitas_pekerjaan,
            ]);
            if($simpan_service) {
                $simpan_action = Trs_d_service_action::insert([
                    "h_id" => $h_id,
                    "call" => $request->call == "call" ? "yes" : NULL,
                    "warranty" => $request->warranty == "warranty" ? "yes" : NULL,
                    "maintenance" => $request->maintenance == "maintenance" ? "yes" : NULL,
                    "installation" => $request->installation == "installation" ? "yes" : NULL,
                    "training" => $request->training == "training" ? "yes" : NULL,
                    "delivery" => $request->delivery == "delivery" ? "yes" : NULL,
                    "demo" => $request->demo == "demo" ? "yes" : NULL,
                    "spare_part" => $request->spare_part == "spare_part" ? "yes" : NULL,
                    "repeat_service" => $request->repeat_service == "repeat_service" ? "yes" : NULL,
                    "routine_check" => $request->routine_check == "routine_check" ? "yes" : NULL,
                ]);
                if($simpan_action) {
                    $simpan_problem = Trs_d_service_problem::insert([
                        "h_id" => $h_id,
                        "problem1" => $request->problem1,
                        "problem2" => $request->problem2,
                        "problem3" => $request->problem3,
                    ]);
                    if($simpan_problem) {
                        $simpan_kategori = Trs_d_service_kategori::insert([
                            "h_id" => $h_id,
                            "mekanikal" => $request->mekanikal == "mekanikal" ? "yes" : NULL,
                            "elektrikal" => $request->elektrikal == "elektrikal" ? "yes" : NULL,
                            "sensor" => $request->sensor == "sensor" ? "yes" : NULL,
                            "software" => $request->software == "software" ? "yes" : NULL,
                            "power_supplay" => $request->power_supplay == "power_supplay" ? "yes" : NULL,
                            "logger" => $request->logger == "logger" ? "yes" : NULL,
                            "kelengkapan" => $request->kelengkapan == "kelengkapan" ? "yes" : NULL,
                            "modem" => $request->modem == "modem" ? "yes" : NULL,
                            "accessories" => $request->accessories == "accessories" ? "yes" : NULL,
                            "human_error" => $request->human_error == "human_error" ? "yes" : NULL,
                            "other" => $request->other,
                        ]);
                        if($simpan_kategori) {
                            $simpan_pekerjaan = Trs_d_service_pekerjaan::insert([
                                "h_id" => $h_id,
                                "ganti_part_modul" => $request->ganti_part_modul == "ganti_part_modul" ? "yes" : NULL,
                                "setting_kalibrasi" => $request->setting_kalibrasi == "setting_kalibrasi" ? "yes" : NULL,
                                "modification_upgrade" => $request->modification_upgrade == "modification_upgrade" ? "yes" : NULL,
                                "maintenance" => $request->maintenance == "maintenance" ? "yes" : NULL,
                                "installasi" => $request->installasi == "installasi" ? "yes" : NULL,
                                "training" => $request->training == "training" ? "yes" : NULL,
                                "pengiriman" => $request->pengiriman == "pengiriman" ? "yes" : NULL,
                                "observasi" => $request->observasi == "observasi" ? "yes" : NULL,
                            ]);
                            if($simpan_pekerjaan) {
                                $simpan_investigasi = Trs_d_service_investigasi::insert([
                                    "h_id" => $h_id,
                                    "investigasi1" => $request->investigasi1,
                                    "investigasi2" => $request->investigasi2,
                                    "investigasi3" => $request->investigasi3,
                                ]);
                                if($simpan_investigasi) {
                                    foreach($request->value as $k => $v) {
                                        $data_sensor[$k] = $v;
                                        if($v['part_number'] != NULL || $v['spare_part'] != NULL || $v['qty'] != NULL || $v['sf'] != NULL || $v['sn'] != NULL) {
                                            $simpan_spare_part = Trs_d_service_spare_part::insert([
                                            "h_id" => $h_id,
                                            "part_number" => $v['part_number'],
                                            "spare_part" => $v['spare_part'],
                                            "qty" => $v['qty'],
                                            "sf" => $v['sf'],
                                            "sn" => $v['sn'],
                                            ]);
                                            if($simpan_spare_part) {
                                                $simpan_note = Trs_d_service_note::insert([
                                                    "h_id" => $h_id,
                                                    "note1" => $request->note1,
                                                    "note2" => $request->note2,
                                                    "note3" => $request->note3,
                                                ]);
                                                if($simpan_note) {
                                                    $simpan_stock_from = Trs_d_service_stock_from::insert([
                                                        "h_id" => $h_id,
                                                        "main_store" => $request->main_store,
                                                        "logistik" => $request->logistik,
                                                        "customer" => $request->customer,
                                                    ]);
                                                    return redirect()->route('daftar_service');
                                                } else {
                                                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                                    return redirect()->route('input_service');
                                                }
                                            } else {
                                                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                                return redirect()->route('input_service');
                                            }
                                        }
                                    }
                                } else {
                                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                    return redirect()->route('input_service');
                                }
                            } else {
                                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                return redirect()->route('input_service');
                            }
                        } else {
                            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                            return redirect()->route('input_service');
                        }
                    } else {
                        Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                        return redirect()->route('input_service');
                    }
                } else {
                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                    return redirect()->route('input_service');
                }
            } else {
                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                return redirect()->route('input_service');
            }
        } else {
            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
            return redirect()->route('input_service');
        }
        $request->validate([
            'filename' => 'required',
        ]);
        if ($request->hasfile('filename')) {
            $images = $request->file('filename');
            foreach($images as $image) {
                $filename = date('YmdHis').''.$image->getClientOriginalName();
                $path = $image->storeAs('uploads', $filename, 'public');
                Trs_d_image::create([
                    'h_id' => $h_id,
                    'filename' => $filename,
                    'path' => '/storage/'.$path
                ]);
            }
        }
        return redirect()->route('daftar_service');
    }
    public function showFormEditService($id) {
        $cekData = Trs_h::findOrFail($id);
        if ($cekData) {
            $dataTs = Trs_h::where('id', $id)
            ->with('rel_d_service')
            ->with('rel_d_service_action')
            ->with('rel_d_service_investigasi')
            ->with('rel_d_service_kategori')
            ->with('rel_d_service_note')
            ->with('rel_d_service_pekerjaan')
            ->with('rel_d_service_problem')
            ->with('rel_d_service_spare_part')
            ->with('rel_d_service_stock_from')
            ->first();
        }
        $count = sizeOf($dataTs->rel_d_service_spare_part);
        $count_x = $count+1;
        return view('edit_service', ['dataTs' => $dataTs, 'count_x' => $count_x]);
    }
    public function updateService(Request $request){
        return response($request);
        $cek_h = Trs_h::where('id', $request->id)->first();
        return response($cek_h);
    }
}
