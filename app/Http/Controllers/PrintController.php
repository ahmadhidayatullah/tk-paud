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
            'kwitansi' => false,
        ]);
    }

    public function kwitansi($id_pembayaran)
    {
        $data = Pembayaran::where('id', $id_pembayaran)->get();
        return view('print.pendaftaran', [
            'data' => $data,
            'kwitansi' => true,
        ]);
    }

    public function bulanan(Request $request)
    {
        $from = $request->start;
        $to = $request->end;

        $data = Pembayaran::whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
        return view('print.bulanan', [
            'data' => $data,
        ]);
    }

    public function siswa(Request $request)
    {
        $ket = $request->ket;
        $data = \App\Models\DataSiswa::where('kelas', $ket)->get();
        return view('print.siswa', [
            'data' => $data,
            'kelas' => $ket,
            'wali' => \GeneralHelper::getNameOf()->$ket,
        ]);
    }

    public function guru()
    {
        $data = \App\Models\DataGuru::all();
        return view('print.guru', [
            'data' => $data,
        ]);
    }

}
