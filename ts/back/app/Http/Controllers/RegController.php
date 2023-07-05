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
use App\Models\Users_api;
use App\Models\Users_api_is;
use App\Models\Users_api_ip;
use App\Models\Users_api_hw;
use Illuminate\Support\Str;
use App\Models\Ms_instansi;

class RegController extends Controller
{
    public function showFormRegister()
    {
        $is = Ms_instansi::select('id_instansi', 'nm_instansi')->get();
        $instansi = [];
        foreach ($is as $k => $v) {
            $instansi[$k] = $v;
        }
        return view('register', ['instansi' => $instansi]);
    }

    public function register(Request $request)
    {

        $rules = [
            'user'                  => 'required|min:6|max:80|unique:users_api,user',
        ];

        $messages = [
            'user.required'  => 'User wajib diisi',
            'user.unique'    => 'User sudah terdaftar',
            'ip_address.required'  => 'IP Address wajib diisi',
            'id_instansi.required'  => 'Instansi wajib diisi',
            'hardware.required'  => 'Hardware wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $date_expired = date('Y-m-d', strtotime("+1 year"));

        $replace_user1 = str_replace(str_split(' '), '_', $request->user);
        $replace_user2 = str_replace(str_split('\\/:.*?"<>|'), '', strtolower($replace_user1));

        $dataUser = Users_api::where('user', $replace_user2)->first();

        if ($dataUser) {
            return response()->json("Nama User sudah digunakan", 400);
        } else {
            $user_api = new Users_api;
            $user_api->user = $replace_user2;
            $user_api->name = $request->user;
            $user_api->password = Hash::make(12345678);
            $user_api->user_code = Str::random(8) . '_' . $replace_user2;
            $user_api->token = substr($user_api->user_code, 0, 8);
            $user_api->status = $request->status;
            $user_api->expired_date = $date_expired;
            $user_api->created_by = Auth::user()->id;
            $simpan = $user_api->save();
        }

        $id_users_api = DB::getPdo()->lastInsertId();
        // foreach ($request->id_instansi as $k1 => $v1) {
        //     $data1 = new Users_api_is();
        //     $data1->users_api = $id_user;
        //     $data1->instansi = @$v1;
        //     $data1->save();

        //     $id_is = DB::getPdo()->lastInsertId();
        //     foreach ($request->ip_address as $k2 => $v2) {
        //         $data2 = new Users_api_ip();
        //         $data2->users_api_is = $id_is;
        //         $data2->ip_address = @$v2;
        //         $data2->save();

        //         $id_ip = DB::getPdo()->lastInsertId();
        //         foreach ($request->hardware as $k3 => $v3) {
        //             $data = new Users_api_hw();
        //             $data->users_api_ip = $id_ip;
        //             $data->hardware = @$v3;
        //             $data->save();
        //         }
        //     }
        // }

        foreach ($request->ip_address as $k => $v) {
            $data = new Users_api_ip();
            $data->users_api = $id_users_api;
            $data->ip_address = @$v;
            $data->save();
        }

        foreach ($request->id_instansi as $k => $v) {
            $data = new Users_api_is();
            $data->users_api = $id_users_api;
            $data->id_instansi = @$v;
            $data->save();
        }

        foreach ($request->hardware as $k => $v) {
            $data = new Users_api_hw();
            $data->users_api = $id_users_api;
            $data->hardware = @$v;
            $data->save();
        }

        if ($simpan) {
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('report');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi lagi']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
