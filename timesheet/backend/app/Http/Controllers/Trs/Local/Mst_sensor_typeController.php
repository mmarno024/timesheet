<?php

namespace App\Http\Controllers\Trs\Local;

use App\Http\Controllers\Controller;
use App\Model\Trs\Local\Mst_sensor_type;
use Illuminate\Http\Request;

class Mst_sensor_typeController extends Controller
{
    public function getLookup(Request $request)
    {
        $request->q = str_replace(" ", "%", $request->q);
        $data = Mst_sensor_type::select('kd_type', 'type', 'note')->where(function ($q) use ($request) {
            $q->orWhere('kd_type', 'like', "%" . @$request->q . "%");
            $q->orWhere('type', 'like', "%" . @$request->q . "%");
        })
            ->orderByRaw('FIELD(kd_type,"device","water","rain","climatology","factory","etc")');
        $data = $data->paginate(isset($request->limit) ? $request->limit : 10);
        return view('sys.system.dialog.sflookup', compact(['data', 'request']));
    }
}
