<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function getDownload1()
    {
        // $path = public_path('Form LK (cheklist laporan pemasangan alat).xlsx');
        $path = Storage::disk('downloads')->get('form/Form LK (cheklist laporan pemasangan alat).xlsx');
        $fileName = 'Form LK (cheklist laporan pemasangan alat).xlsx';
        return Response::download($path, $fileName, ['Content-Type: application/xlxs']);
    }
    public function getDownload2()
    {
        $path = Storage::disk('downloads')->get('form/Form LK (cheklist laporan pemasangan alat).xlsx');
        $fileName = 'Form LK (cheklist laporan pemasangan alat).xlsx';
        return Response::download($path, $fileName, ['Content-Type: application/xlxs']);
    }
    public function getDownload3()
    {
        $path = Storage::disk('downloads')->get('form/Form LK (cheklist laporan pemasangan alat).xlsx');
        $fileName = 'Form LK (cheklist laporan pemasangan alat).xlsx';
        return Response::download($path, $fileName, ['Content-Type: application/xlxs']);
    }
    public function getDownload4()
    {
        $path = Storage::disk('downloads')->get('form/Form LK (cheklist laporan pemasangan alat).xlsx');
        $fileName = 'Form LK (cheklist laporan pemasangan alat).xlsx';
        return Response::download($path, $fileName, ['Content-Type: application/xlxs']);
    }
}
