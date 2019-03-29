<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index($semester = '', $kelompok = '')
    {
        $semester1_start = date('Y-01-01');
        $semester1_end = date('Y-06-t');

        $semester2_start = date('Y-07-01');
        $semester2_end = date('Y-12-t');

        if ($semester == 1) {
            if ($kelompok == 'tk') {

                $title = "Laporan TK Semester 1";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 1);
                })->whereBetween('tanggal', [$semester1_start, $semester1_end])->orderBy('id', 'DESC')->get();

            } elseif ($kelompok == 'kb') {

                $title = "Laporan Kelompok Bermain Semester 1";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 4);
                })->whereBetween('tanggal', [$semester1_start, $semester1_end])->orderBy('id', 'DESC')->get();

            } elseif ($kelompok == 'tpa') {

                $title = "Laporan TPA Semester 1";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 2)->orWhere('jenis_biaya_siswa_id', '=', 3);
                })->whereBetween('tanggal', [$semester1_start, $semester1_end])->orderBy('id', 'DESC')->get();

            } else {

                $title = "Semua Laporan Semester 1";
                $data = Pembayaran::whereBetween('tanggal', [$semester1_start, $semester1_end])->orderBy('id', 'DESC')->get();

            }
        } elseif ($semester == 2) {

            if ($kelompok == 'tk') {

                $title = "Laporan TK Semester 2";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 1);
                })->whereBetween('tanggal', [$semester2_start, $semester2_end])->orderBy('id', 'DESC')->get();

            } elseif ($kelompok == 'kb') {

                $title = "Laporan Kelompok Bermain Semester 2";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 4);
                })->whereBetween('tanggal', [$semester2_start, $semester2_end])->orderBy('id', 'DESC')->get();

            } elseif ($kelompok == 'tpa') {

                $title = "Laporan TPA Semester 2";
                $data = Pembayaran::whereHas('getSiswaById', function ($query) {
                    $query->where('jenis_biaya_siswa_id', '=', 2)->orWhere('jenis_biaya_siswa_id', '=', 3);
                })->whereBetween('tanggal', [$semester2_start, $semester2_end])->orderBy('id', 'DESC')->get();

            } else {

                $title = "Semua Laporan Semester 2";
                $data = Pembayaran::whereBetween('tanggal', [$semester2_start, $semester2_end])->orderBy('id', 'DESC')->get();

            }
        } else {
            $title = "Semua Laporan";
            $data = Pembayaran::orderBy('id', 'DESC')->get();
        }
        return view('laporan.index', [
            'data' => $data,
            'title' => $title,
        ]);
    }

    function print(Request $request) {
        if (isset($request->start)) {
            $from = $request->start;
            $to = $request->end;
            $filter = $request->filter;
            if ($filter == 'semua') {
                $data = Pembayaran::whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
            } else {
                $data = Pembayaran::whereHas('getSiswaById', function ($query) use ($filter) {
                    $query->where('jenis_bayar', '=', $filter);
                })->whereBetween('tanggal', [$from, $to])->orderBy('id', 'DESC')->get();
            }
        } else {
            $data = '';
        }
        return view('laporan.print', [
            'data' => $data,
            'get_start' => (isset($from)) ? $from : '',
            'get_end' => (isset($to)) ? $to : '',
            'filter' => (isset($filter)) ? $filter : '',
        ]);
    }
}
