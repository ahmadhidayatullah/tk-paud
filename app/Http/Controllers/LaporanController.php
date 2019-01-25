<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Pembayaran::orderBy('id', 'DESC')->get();
        return view('laporan.index', [
            'data' => $data,
        ]);
    }
}
