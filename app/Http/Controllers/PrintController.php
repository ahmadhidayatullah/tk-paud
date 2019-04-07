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
        $filter = $request->filter;

        if ($filter == 'semua') {
            $data = Pembayaran::whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
        } elseif ($filter == 'cash') {
            $data = Pembayaran::whereHas('getSiswaById', function ($query) use ($filter) {
                $query->where('jenis_bayar', '=', $filter);
            })->whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
        } elseif ($filter == 'cicil') {
            $data = Pembayaran::whereHas('getSiswaById', function ($query) use ($filter) {
                $query->where('jenis_bayar', '=', $filter);
            })->whereBetween('tanggal', [$from, $to])->where([
                ['jenis_pembayaran', '!=', 'pendaftaran'],
                ['jenis_pembayaran', '!=', 'seragam'],
            ])->orderBy('id', 'DESC')->get();
        } else {
            $data = Pembayaran::whereBetween('tanggal', [$from, $to])
                ->where('jenis_pembayaran', $filter)
                ->orderBy('id', 'DESC')->get();
        }
        return view('print.bulanan', [
            'data' => $data,
        ]);
    }

    public function siswa(Request $request)
    {
        $ket = $request->ket;
        if ($ket == 'kb') {
            $wali = \GeneralHelper::getNameOf()->pengelola;
            $data = \App\Models\DataSiswa::where('jenis_biaya_siswa_id', 4)->get();
            $kelas = ' Bermain';
        } elseif ($ket == 'tpa') {
            $data = \App\Models\DataSiswa::where('jenis_biaya_siswa_id', 2)
                ->orWhere('jenis_biaya_siswa_id', 3)
                ->get();
            $wali = \GeneralHelper::getNameOf()->pengelola;
            $kelas = 'Tempat Penitipan Anak';
        } else {
            $data = \App\Models\DataSiswa::where('kelas', $ket)->get();
            $wali = \GeneralHelper::getNameOf()->$ket;
            $kelas = $ket;
        }
        return view('print.siswa', [
            'data' => $data,
            'kelas' => $kelas,
            'wali' => $wali,
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
