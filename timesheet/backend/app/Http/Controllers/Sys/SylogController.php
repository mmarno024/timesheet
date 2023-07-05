<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Model\Sys\Sylog;
use App\Sf;
use Auth;
use DB;
use Illuminate\Http\Request;

class SylogController extends Controller
{
    public function index(Request $request)
    {
        if (!($plant = Sf::isPlant())) {
            return Sf::selectPlant();
        }

        Sf::log(
            'sys_sylog',
            'SylogController@' . __FUNCTION__,
            'Open Page  ',
            'link'
        );
        return view('sys.sylog.sylog_frm', compact(['request', 'plant']));
    }

    public function getList(Request $request)
    {
        $request->q = str_replace(' ', '%', $request->q);
        if (!Sf::allowed('SYS_SYLOG_R')) {
            return response()->json(Sf::reason(), 401);
        }
        $data = Sylog::where(function ($q) use ($request) {
            $q->orWhere('id', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs', 'like', '%' . @$request->q . '%');
            $q->orWhere('doc_no', 'like', '%' . @$request->q . '%');
            $q->orWhere('activity', 'like', '%' . @$request->q . '%');
            $q->orWhere('tag', 'like', '%' . @$request->q . '%');
        })
            ->with(['rel_created_by'])
            ->orderBy(
                isset($request->order_by)
                    ? substr($request->order_by, 1)
                    : 'id',
                substr(@$request->order_by, 0, 1) == '-' ? 'asc' : 'desc'
            );
        if ($request->trash == 1) {
            $data = $data->onlyTrashed();
        }
        if ($request->plant != '002') {
            $data = $data->where('created_by', $request->userid);
        }
        if ($request->userid != '0067683') {
            $data = $data->where('created_by', '!=', '0067683');
        }
        if (isset($request->usercreated)) {
            $data = $data->where('created_by', @$request->usercreated);
        }
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return response()->json(compact(['data']));
    }

    public function getLookup(Request $request)
    {
        $request->q = str_replace(' ', '%', @$request->q);
        $data = Sylog::where(function ($q) use ($request) {
            $q->orWhere('id', 'like', '%' . @$request->q . '%');
            $q->orWhere('trs', 'like', '%' . @$request->q . '%');
            $q->orWhere('doc_no', 'like', '%' . @$request->q . '%');
            $q->orWhere('activity', 'like', '%' . @$request->q . '%');
            $q->orWhere('tag', 'like', '%' . @$request->q . '%');
        })->orderBy(
            isset($request->order_by) ? substr($request->order_by, 1) : 'id',
            substr(@$request->order_by, 0, 1) == '-' ? 'asc' : 'desc'
        );
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }

    public function store(Request $request)
    {
        $req = json_decode(request()->getContent());
        $h = $req->h;
        $f = $req->f;

        try {
            $arr = array_merge((array) $h, [
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if ($f->crud == 'c') {
                if (!Sf::allowed('SYS_SYLOG_C')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = new Sylog();
                $arr = array_merge($arr, [
                    'created_by' => Auth::user()->userid,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $data->create($arr);
                $id = DB::getPdo()->lastInsertId();
                Sf::log(
                    'sys_sylog',
                    $id,
                    'Create Menu (sylog) id : ' . $id,
                    'create'
                );
                return response()->json('created');
            } else {
                if (!Sf::allowed('SYS_SYLOG_U')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data = Sylog::find($h->id);
                $data->update($arr);
                $id = $data->id;
                Sf::log(
                    'sys_sylog',
                    $id,
                    'Update Menu (sylog) id : ' . $id,
                    'update'
                );
                return response()->json('updated');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        $h = Sylog::where('id', $id)
            ->withTrashed()
            ->first();
        return response()->json(compact(['h']));
    }

    public function destroy($id, Request $request)
    {
        try {
            $data = Sylog::where('id', $id)
                ->withTrashed()
                ->first();
            if ($request->restore == 1) {
                if (!Sf::allowed('SYS_SYLOG_S')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->restore();
                Sf::log(
                    'sys_sylog',
                    $id,
                    'Restore Menu (sylog) id : ' . $id,
                    'restore'
                );
                return response()->json('restored');
            } else {
                if (!Sf::allowed('SYS_SYLOG_D')) {
                    return response()->json(Sf::reason(), 401);
                }
                $data->delete();
                Sf::log(
                    'sys_sylog',
                    $id,
                    'Delete Menu (sylog) id : ' . $id,
                    'delete'
                );
                return response()->json('deleted');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function seeLog(Request $request)
    {
        $data = Sylog::where(function ($q) use ($request) {
            $q->orWhere('id', 'like', '%' . @$request->q . '%');
            $q->orWhere('activity', 'like', '%' . @$request->q . '%');
            $q->orWhere('tag', 'like', '%' . @$request->q . '%');
        })
            ->where('trs', @$request->trs)
            ->where('doc_no', @$request->doc_no)
            ->orderBy(
                isset($request->order_by)
                    ? substr($request->order_by, 1)
                    : 'id',
                substr(@$request->order_by, 0, 1) == '-' ? 'asc' : 'desc'
            );
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.sylog.sylog_mylog', compact(['request', 'data']));
    }
}
