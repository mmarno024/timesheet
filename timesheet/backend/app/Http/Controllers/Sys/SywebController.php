<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SywebController extends Controller
{
	public function index(Request $request)
	{
		return $this->page($request);
	}

	public function page(Request $request)
	{
		$page = @$request->q == '' ? 'home' : $request->q;
		return view("sys.syweb.$page");
	}
}
