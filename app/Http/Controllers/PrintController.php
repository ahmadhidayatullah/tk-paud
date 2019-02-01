<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function pendaftaran($id_siswa)
    {
        $data = Pembayaran::where('data_siswa_id', $id_siswa)->get();
        return view('print.pendaftaran', [
            'data' => $data,
        ]);
    }

    public function kwitansi($id_pembayaran)
    {
        $data = Pembayaran::where('id', $id_pembayaran)->get();
        return view('print.pendaftaran', [
            'data' => $data,
        ]);
    }

    public function bulanan(Request $request)
    {
        $from = date($request->tahun . '-' . $request->bulan . '-01');
        $to = date($request->tahun . '-' . $request->bulan . '-t');

        $data = Pembayaran::whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
        return view('print.bulanan', [
            'data' => $data,
            'bulan' => $request->bulan,
        ]);
    }

}
