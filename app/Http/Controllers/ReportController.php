<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class ReportController extends Controller
{
    public function index()
    {
        $data = Sale::all();
        return view('admin.laporan.index', compact('data'));
    }
}