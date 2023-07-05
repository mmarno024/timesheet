<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Trs_api_d1;
use App\Model\Trs\Local\Trs_api_d2;
use App\Model\Trs\Local\Trs_api_d3;
use App\Model\Trs\Local\Trs_api_h;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Trs_apiController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }
        Sf::log('trs_local_trs_api', 'Trs_apiController@' . __FUNCTION__, 'Open Page  ', 'link');
        return view('trs.local.trs_api.trs_api_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        if (!Sf::allowed('TRS_LOCAL_TRS_API_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $request->q = str_replace(' ', '%', $request->q);
        $data = Trs_api_h::where(function ($q) use ($request) {
            $q->orWhere('username', 'like', '%' . @$request->q . '%');
            $q->orWhere('fullname', 'like', '%' . @$request->q . '%');
            $q->orWhere('expired_date', 'like', '%' . @$request->q . '%');
            $q->orWhere('status', 'like', '%' . @$request->q . '%');
        })->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function getLookup(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        $data = Trs_api_h::where(function ($q) use ($request) {
            $q->orWhere('username', 'like', '%' . @$request->q . '%');
            $q->orWhere('fullname', 'like', '%' . @$request->q . '%');
            $q->orWhere('expired_date', 'like', '%' . @$request->q . '%');
            $q->orWhere('status', 'like', '%' . @$request->q . '%');
        })->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : 'id', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function getTotaldata(Request $request)
    {
        $q = "SELECT
        COUNT(`id`) total_all,
        SUM(IF(`status`='aktif',1,0)) AS total_aktif,
        SUM(IF(`status`='nonaktif',1,0)) AS total_nonaktif
        FROM trs_api_h";
        $data_total_api = DB::select(DB::raw($q));
        return response()->json(compact(['data_total_api']));
    }

    public function getActive(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        Trs_api_h::where('expired_date', '<', $now)->update(['status' => 'nonaktif',]);
        return response('update actived');
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;
        $d1 = $req->d1;
        $d2 = $req->d2;
        $filter_hardware = $h->filter_plant == 'no' ? 'no' : $h->filter_hardware;
        $expired_date = date('Y-m-d', strtotime('+1 year'));
        $username = str_replace(str_split(' '), '_', $h->fullname);
        $username = str_replace(str_split('\\/:.*?"<>|'), '', strtolower($username));
        $user_code = Str::random(8) . '_' . $username;
        $token = substr($user_code, 0, 8);
        try {
            if ($f->crud == 'c') {
                if (!Sf::allowed('TRS_LOCAL_TRS_API_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                $password = bcrypt('app123');
                @$cek_api = Trs_api_h::where('username', $username)->first();
                if (empty($cek_api)) {
                    $data = new Trs_api_h();
                    $arr = array_merge([
                        'username' => $username,
                        'password' => $password,
                        'fullname' => $h->fullname,
                        'user_code' => $user_code,
                        'token' => $token,
                        'filter_ip' => $h->filter_ip,
                        'filter_plant' => $h->filter_plant,
                        'filter_hardware' => $filter_hardware,
                        'status' => $h->status,
                        'expired_date' => date('Y-m-d 23:59:59', strtotime($h->expired_date)),
                        'created_by' => Auth::user()->userid,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    $data->create($arr);
                    $id = DB::getPdo()->lastInsertId();
                    Trs_api_d1::where('h_id', $id)->forceDelete();
                    Trs_api_d2::where('h_id', $id)->forceDelete();
                    $this->saveD1($id, $d1, $f->crud);
                    $this->saveD2($id, $d2, $f->crud);
                    Sf::log('trs_local_trs_api', $id, 'Create Data API (trs_api) id : ' . $id, 'create');
                    return 'created';
                } else {
                    return response()->json('User ini sudah pernah dibuat sebelumnya', 401);
                }
            } else {
                if (!Sf::allowed('TRS_LOCAL_TRS_API_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Trs_api_h::find($h->id);
                $arr = array_merge([
                    'username' => $username,
                    'fullname' => $h->fullname,
                    'user_code' => $user_code,
                    'token' => $token,
                    'filter_ip' => $h->filter_ip,
                    'filter_plant' => $h->filter_plant,
                    'filter_hardware' => $filter_hardware,
                    'status' => $h->status,
                    'expired_date' => date('Y-m-d 23:59:59', strtotime($h->expired_date)),
                    'created_by' => Auth::user()->userid,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $data->update($arr);
                $id = $h->id;
                Trs_api_d1::where('h_id', $id)->forceDelete();
                $q_d2 = Trs_api_d2::where('h_id', $id)->get();
                foreach ($q_d2 as $k => $v) {
                    $q_d3[$k] = Trs_api_d3::where('d2_id', $v->id)->forceDelete();
                }
                Trs_api_d2::where('h_id', $id)->forceDelete();
                $this->saveD1($id, $d1, $f->crud);
                $this->saveD2($id, $d2, $f->crud);
                Sf::log('trs_local_trs_api', $id, 'Update Data API (trs_api) id : ' . $id, 'update');
                return 'updated';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    private function saveD1($id, $d1)
    {
        foreach ($d1 as $k1 => $v1) {
            $data1 = new Trs_api_d1();
            $data1->h_id = $id;
            $data1->ip_address = $v1->ip_address;
            $data1->save();
        }
    }

    private function saveD2($id, $d2)
    {
        foreach ($d2 as $k2 => $v2) {
            $data2 = new Trs_api_d2();
            $data2->h_id = $id;
            $data2->plant = $v2->plant;
            $data2->save();
            $d2_id = DB::getPdo()->lastInsertId();
            Trs_api_d3::where('d2_id', $d2_id)->forceDelete();
            foreach ($v2->sub as $k2x => $v2x) {
                $data2x = new Trs_api_d3();
                $data2x->d2_id = $d2_id;
                $data2x->kd_hardware = $v2x->kd_hardware;
                $data2x->save();
            }
        }
    }

    public function edit($id)
    {
        $h = Trs_api_h::where('id', $id)->withTrashed()->first();
        $d1 = [];
        $d2 = [];
        $d3 = [];
        foreach ($h->rel_d1 as $k1 => $v1) {
            $d1[$k1] = @$v1;
        }
        foreach ($h->rel_d2 as $k2 => $v2) {
            $d2[$k2]->id = @$d2[$k2]->id = $v2->id;
            $d2[$k2]->h_id = @$d2[$k2]->h_id = $v2->h_id;
            $d2[$k2]->plant = @$d2[$k2]->plant = $v2->plant;
            $d2[$k2]->plantname = @$d2[$k2]->plantname = $v2->rel_plant->plantname;
            $d2[$k2]->sub = @$d2[$k2]->sub = $v2->rel_d3;
            $d3[$k2] = $v2->rel_d3;
        }

        if ($h->filter_plant == 'no' || $h->filter_plant == '') {
            $api_url = 'http://tatonas.co.id/api/dt?uc=' . $h->user_code;
        } else {
            #filter plant yes
            if ($h->filter_hardware == 'no' || $h->filter_hardware == '') {
                #filter hardware no
                foreach ($d2 as $k2 => $v2) {
                    $user_code = Trs_api_h::where('id', $v2->h_id)->first();
                    $api_url[$k2] = 'http://tatonas.co.id/api/dt?uc=' . $h->user_code . '&pc=' . $v2->plant;
                }
            } else {
                #filter hardware yes
                foreach ($d2 as $k2 => $v2) {
                    foreach ($v2->sub as $k3 => $v3) {
                        $user_code = Trs_api_h::where('id', $v2->h_id)->first();
                        $api_url[$k2][$k3] = 'http://tatonas.co.id/api/dt?uc=' . $h->user_code . '&pc=' . $v2->plant . '&hw=' . $v3->kd_hardware;
                    }
                }
            }
        }
        return response()->json(compact(['h', 'd1', 'd2', 'd3', 'api_url']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Trs_api_h::where('id', $id)->withTrashed()->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('TRS_LOCAL_TRS_API_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log('trs_local_trs_api', $id, 'Restore Data API (trs_api) id : ' . $id, 'restore');
                return 'restored';
            } else {
                if (!Sf::allowed('TRS_LOCAL_TRS_API_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log('trs_local_trs_api', $id, 'Delete Data API (trs_api) id : ' . $id, 'delete');
                return 'deleted';
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
