<?php

namespace App\Http\Controllers\Working;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WorkingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('items.working.working');
    }
    public function getInstallation() {
        return view('items.working.working_installation');
    }
    public function getService() {
        return view('items.working.working_service');
    }
    public function getSurvey() {
        return view('items.working.working_survey');
    }
    public function getEtc() {
        return view('items.working.working_etc');
    }
}
