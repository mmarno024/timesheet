<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_api;
use App\Models\Users_api_is;
use App\Models\Users_api_ip;
use App\Models\Users_api_hw;
use App\Models\Ms_instansi;

class DataController extends Controller
{
    public function index()
    {
        $dataUser = Users_api::with(['rel_is' => function ($q) {
            $q->with('rel_id_instansi');
        }])->with('rel_ip')
            ->with('rel_hw')
            ->simplePaginate(10);
        return view('report', ['dataUser' => $dataUser]);
    }

    public function detail($id)
    {
        $dataUser = Users_api::where('id', $id)
            ->with(['rel_is' => function ($q) {
                $q->with('rel_id_instansi');
            }])->with(['rel_ip' => function ($q2) {
                $q2->where('ip_address', '!=', '::1');
            }])
            ->with('rel_hw')
            ->first();
        // return $dataUser;
        return view('detail', ['dataUser' => $dataUser]);
    }

    public function hapus($id)
    {
        Users_api::where('id', $id)->delete();
        Users_api_is::where('users_api', $id)->delete();
        Users_api_ip::where('users_api', $id)->delete();
        Users_api_hw::where('users_api', $id)->delete();
        return redirect('/report');
    }

    public function showFormEdit($id)
    {
        $is = Ms_instansi::select('id_instansi', 'nm_instansi')->get();
        $instansi = [];
        foreach ($is as $k => $v) {
            $instansi[$k] = $v;
        }
        $cekUser = Users_api::findOrFail($id);
        if ($cekUser) {
            $dataUser =
                Users_api::where('id', $id)
                ->with(['rel_is' => function ($q) {
                    $q->with('rel_id_instansi');
                }])->with('rel_ip')
                ->with('rel_hw')
                ->first();
        }
        return view('edit', ['instansi' => $instansi, 'dataUser' => $dataUser]);
    }

    public function update(Request $request)
    {
        Users_api::where('id', $request->id)
            ->update(['status' => $request->status]);
        $cek_ip = Users_api_ip::where('users_api', $request->id)->first();
        if ($cek_ip) {
            Users_api_ip::where('users_api', $request->id)->forceDelete();
            foreach ($request->ip_address as $k => $v) {
                $data = new Users_api_ip();
                $data->users_api = $request->id;
                $data->ip_address = @$v;
                $data->save();
            }
        } else {
            foreach ($request->ip_address as $k => $v) {
                $data = new Users_api_ip();
                $data->users_api = $request->id;
                $data->ip_address = @$v;
                $data->save();
            }
        }
        $cek_is = Users_api_is::where('users_api', $request->id)->first();
        if ($cek_is) {
            Users_api_is::where('users_api', $request->id)->forceDelete();
            foreach ($request->id_instansi as $k => $v) {
                $data = new Users_api_is();
                $data->users_api = $request->id;
                $data->id_instansi = @$v;
                $data->save();
            }
        } else {
            foreach ($request->id_instansi as $k => $v) {
                $data = new Users_api_is();
                $data->users_api = $request->id;
                $data->id_instansi = @$v;
                $data->save();
            }
        }
        $cek_hw = Users_api_hw::where('users_api', $request->id)->first();
        if ($cek_hw) {
            Users_api_hw::where('users_api', $request->id)->forceDelete();
            foreach ($request->hardware as $k => $v) {
                $data = new Users_api_hw();
                $data->users_api = $request->id;
                $data->hardware = @$v;
                $data->save();
            }
        } else {
            foreach ($request->hardware as $k => $v) {
                $data = new Users_api_hw();
                $data->users_api = $request->id;
                $data->hardware = @$v;
                $data->save();
            }
        }
        return redirect()->route('report');
    }
}
