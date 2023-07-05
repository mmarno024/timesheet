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
use App\Models\Trs_d_timesheet;
use App\Models\Trs_d_timesheet_img0;
use App\Models\Trs_d_timesheet_img25;
use App\Models\Trs_d_timesheet_img50;
use App\Models\Trs_d_timesheet_img75;
use App\Models\Trs_d_timesheet_img100;
use App\Models\Trs_d_timesheet_imgx;

class TimesheetController extends Controller
{
    public function daftarTimesheet() {
        $data_ts = Trs_h::with('rel_userid')->simplePaginate(10);
        return view('daftar_timesheet', ['data_ts' => $data_ts]);
    }
    public function inputTimesheet() {
        return view('input_timesheet');
    }
    public function insertTimesheet(Request $request) {
        $save_h = Trs_h::insert([
            "jenis_ts" => $request->jenis_ts,
            "kd_ts" => $request->jenis_ts == 'INSTALLATION' ? 'TS-INST-' . date('YmdHi') :  'TS-SERV-' . date('YmdHi'),
            "userid" => Auth::user()->id,
            "tanggal_ts" => date("Y-m-d", strtotime($request->tanggal_ts)),
            "customer" => $request->customer,
            "created_by" => Auth::user()->id,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
        $h_id = DB::getPdo()->lastInsertId();
        if($save_h){
            if ($request->hasfile('form_lk')) {
                $file_lk = $request->file('form_lk');
                $filename_lk = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_lk->getClientOriginalName();
                $path_lk = $file_lk->storeAs('form', $filename_lk, 'uploads');
                $name_lk = $file_lk->getClientOriginalName();
                $ext_lk = pathinfo($filename_lk, PATHINFO_EXTENSION);
                if ($request->hasfile('form_instal_service')) {
                    $file_instal_service = $request->file('form_instal_service');
                    $filename_instal_service = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_instal_service->getClientOriginalName();
                    $path_instal_service = $file_instal_service->storeAs('form', $filename_instal_service, 'uploads');
                    $name_instal_service = $file_instal_service->getClientOriginalName();
                    $ext_instal_service = pathinfo($filename_instal_service, PATHINFO_EXTENSION);
                    if ($request->hasfile('form_checklist')) {
                        $file_checklist = $request->file('form_checklist');
                        $filename_checklist = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_checklist->getClientOriginalName();
                        $path_checklist = $file_checklist->storeAs('form', $filename_checklist, 'uploads');
                        $name_checklist = $file_checklist->getClientOriginalName();
                        $ext_checklist = pathinfo($filename_checklist, PATHINFO_EXTENSION);
                        $save_d_timesheet = Trs_d_timesheet::create([
                            'h_id' => $h_id,
                            'form_lk' => $filename_lk,
                            'path_lk' => $path_lk,
                            'ext_lk' => $ext_lk,
                            'form_instal_service' => $filename_instal_service,
                            'path_instal_service' => $path_instal_service,
                            'ext_instal_service' => $ext_instal_service,
                            'form_checklist' => $filename_checklist,
                            'path_checklist' => $path_checklist,
                            'ext_checklist' => $ext_checklist,
                            'note' => $request->note,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
                if($save_d_timesheet) {
                    if ($request->hasfile('foto0')) {
                        $file_fotos = $request->file('foto0');
                        foreach($file_fotos as $file_foto0) {
                            $filename_foto0 = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_foto0->getClientOriginalName();
                            $path_foto0 = $file_foto0->storeAs('foto', $filename_foto0, 'uploads');
                            $name_foto0 = $file_foto0->getClientOriginalName();
                            $ext_foto0 = pathinfo($filename_foto0, PATHINFO_EXTENSION);
                            $save_d_timesheet_img0 = Trs_d_timesheet_img0::create([
                                'h_id' => $h_id,
                                'foto' => $filename_foto0,
                                'path' => $path_foto0,
                                'ext' => $ext_foto0,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                    if($save_d_timesheet_img0) {
                        if ($request->hasfile('foto25')) {
                            $file_fotos = $request->file('foto25');
                            foreach($file_fotos as $file_foto25) {
                                $filename_foto25 = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_foto25->getClientOriginalName();
                                $path_foto25 = $file_foto25->storeAs('foto', $filename_foto25, 'uploads');
                                $name_foto25 = $file_foto25->getClientOriginalName();
                                $ext_foto25 = pathinfo($filename_foto25, PATHINFO_EXTENSION);
                                $save_d_timesheet_img25 = Trs_d_timesheet_img25::create([
                                    'h_id' => $h_id,
                                    'foto' => $filename_foto25,
                                    'path' => $path_foto25,
                                    'ext' => $ext_foto25,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]);
                            }
                        }
                        if($save_d_timesheet_img25) {
                            if ($request->hasfile('foto50')) {
                                $file_fotos = $request->file('foto50');
                                foreach($file_fotos as $file_foto50) {
                                    $filename_foto50 = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_foto50->getClientOriginalName();
                                    $path_foto50 = $file_foto50->storeAs('foto', $filename_foto50, 'uploads');
                                    $name_foto50 = $file_foto50->getClientOriginalName();
                                    $ext_foto50 = pathinfo($filename_foto50, PATHINFO_EXTENSION);
                                    $save_d_timesheet_img50 = Trs_d_timesheet_img50::create([
                                        'h_id' => $h_id,
                                        'foto' => $filename_foto50,
                                        'path' => $path_foto50,
                                        'ext' => $ext_foto50,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                            }
                            if($save_d_timesheet_img50) {
                                if ($request->hasfile('foto75')) {
                                    $file_fotos = $request->file('foto75');
                                    foreach($file_fotos as $file_foto75) {
                                        $filename_foto75 = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_foto75->getClientOriginalName();
                                        $path_foto75 = $file_foto75->storeAs('foto', $filename_foto75, 'uploads');
                                        $name_foto75 = $file_foto75->getClientOriginalName();
                                        $ext_foto75 = pathinfo($filename_foto75, PATHINFO_EXTENSION);
                                        $save_d_timesheet_img75 = Trs_d_timesheet_img75::create([
                                            'h_id' => $h_id,
                                            'foto' => $filename_foto75,
                                            'path' => $path_foto75,
                                            'ext' => $ext_foto75,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ]);
                                    }
                                }
                                if($save_d_timesheet_img75) {
                                    if ($request->hasfile('foto100')) {
                                        $file_fotos = $request->file('foto100');
                                        foreach($file_fotos as $file_foto100) {
                                            $filename_foto100 = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_foto100->getClientOriginalName();
                                            $path_foto100 = $file_foto100->storeAs('foto', $filename_foto100, 'uploads');
                                            $name_foto100 = $file_foto100->getClientOriginalName();
                                            $ext_foto100 = pathinfo($filename_foto100, PATHINFO_EXTENSION);
                                            $save_d_timesheet_img100 = Trs_d_timesheet_img100::create([
                                                'h_id' => $h_id,
                                                'foto' => $filename_foto100,
                                                'path' => $path_foto100,
                                                'ext' => $ext_foto100,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s'),
                                            ]);
                                        }
                                    }
                                    if($save_d_timesheet_img100) {
                                        if ($request->hasfile('fotox')) {
                                            $file_fotos = $request->file('fotox');
                                            foreach($file_fotos as $file_fotox) {
                                                $filename_fotox = Auth::user()->name . '-' . date('YmdHis') . '-' . $file_fotox->getClientOriginalName();
                                                $path_fotox = $file_fotox->storeAs('foto', $filename_fotox, 'uploads');
                                                $name_fotox = $file_fotox->getClientOriginalName();
                                                $ext_fotox = pathinfo($filename_fotox, PATHINFO_EXTENSION);
                                                $save_d_timesheet_imgx = Trs_d_timesheet_imgx::create([
                                                    'h_id' => $h_id,
                                                    'foto' => $filename_fotox,
                                                    'path' => $path_fotox,
                                                    'ext' => $ext_fotox,
                                                    'created_at' => date('Y-m-d H:i:s'),
                                                    'updated_at' => date('Y-m-d H:i:s'),
                                                ]);
                                            }
                                        }
                                        if($save_d_timesheet_imgx) {
                                            return redirect()->route('daftar_timesheet');
                                        } else {
                                            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                            return redirect()->route('input_timesheet');
                                        }
                                    } else {
                                        Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                        return redirect()->route('input_timesheet');
                                    }
                                } else {
                                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                    return redirect()->route('input_timesheet');
                                }
                            } else {
                                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                                return redirect()->route('input_timesheet');
                            }
                        } else {
                            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                            return redirect()->route('input_timesheet');
                        }
                    } else {
                        Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                        return redirect()->route('input_timesheet');
                    }
                } else {
                    Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                    return redirect()->route('input_timesheet');
                }
            } else {
                Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
                return redirect()->route('input_timesheet');
            }
        } else {
            Session::flash('errors', ['' => 'Input data gagal! Silahkan ulangi lagi']);
            return redirect()->route('input_timesheet');
        }
    }

    public function editTimesheet($id) {
        $cekData = Trs_h::findOrFail($id);
        if ($cekData) {
            $dataTs = Trs_h::where('id', $id)
            ->with('rel_d_timesheet')
            ->with('rel_d_timesheet')
            ->with('rel_d_timesheet_img0')
            ->with('rel_d_timesheet_img25')
            ->with('rel_d_timesheet_img50')
            ->with('rel_d_timesheet_img75')
            ->with('rel_d_timesheet_img100')
            ->with('rel_d_timesheet_imgx')
            ->first();
        }
        return view('edit_timesheet', ['dataTs' => $dataTs]);
    }







    public function detailTimesheet($id) {
        $cekData = Trs_h::findOrFail($id);
        if ($cekData) {
            $dataTs = Trs_h::where('id', $id)
            ->with('rel_d_timesheet')
            ->with('rel_d_timesheet')
            ->with('rel_d_timesheet_img0')
            ->with('rel_d_timesheet_img25')
            ->with('rel_d_timesheet_img50')
            ->with('rel_d_timesheet_img75')
            ->with('rel_d_timesheet_img100')
            ->with('rel_d_timesheet_imgx')
            ->first();
        }
        return view('detail_timesheet', ['dataTs' => $dataTs]);
    }
}
