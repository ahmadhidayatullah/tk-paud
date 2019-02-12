<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\KontrolTamanPenitipanAnak as Penitipan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Validator;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayaran.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pembayaran' => 'required',
            'data_siswa_id' => 'required',
            'tanggal' => 'required',
            'bayar' => 'required',
            'total_denda' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $data = Pembayaran::create([
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'data_siswa_id' => $request->data_siswa_id,
            'tanggal' => $request->tanggal,
            'bayar' => $request->bayar,
            'total_denda' => $request->total_denda,
        ]);

        if ($data) {
            \LogActivity::addToLog("Tambah data pembayaran ID #{$data->id}.");
        }

        $link = "<a target='_blank' href=" . route('print.kwitansi', $data->id) . " class='btn btn-primary'>Print Kwitansi</a>";

        return redirect()->route('pembayaran')->with('message', format_message('Transaksi berhasil ! ' . $link, 'success'));
    }

    public function getSiswa(Request $request)
    {
        $text = isset($request->text) ? $request->text : '';
        $data = DataSiswa::where('nama', 'LIKE', '%' . trim($text) . '%')->get();
        if ($data->count() < 1) {
            return '<option> -- Data Tidak Ada -- </option>';
        } else {
            $option = '<option> -- Pilih -- </option>';
            foreach ($data as $item) {
                $option .= "<option value=" . $item->id . "> " . $item->nama . " </option>";
            }
            return $option;
        }

    }

    public function getBiaya(Request $request)
    {
        $tanggal = isset($request->tanggal) ? $request->tanggal : '';
        $siswa = isset($request->siswa) ? $request->siswa : '';
        $jenis_bayar = isset($request->jenis_bayar) ? $request->jenis_bayar : '';

        $getDataSiswa = DataSiswa::findOrFail($siswa);

        if ($jenis_bayar == 'pangkal') {
            $respone = [
                'bayar' => $getDataSiswa->getJenisBiayaById->pangkal,
                'denda' => 0,
                'total' => $getDataSiswa->getJenisBiayaById->bulanan,
            ];
        } else {
            if ($getDataSiswa->jenis_biaya_siswa_id == '1' || $getDataSiswa->jenis_biaya_siswa_id == '4') {
                $respone = [
                    'bayar' => $getDataSiswa->getJenisBiayaById->bulanan,
                    'denda' => 0,
                    'total' => $getDataSiswa->getJenisBiayaById->bulanan,
                ];
            } else {
                $respone = $this->__getPenitipan($tanggal, $siswa);
            }
        }

        return $respone;

    }

    private function __getPenitipan($tanggal, $siswa)
    {
        $exTanggal = explode('-', $tanggal);

        $from = date($exTanggal[0] . '-' . $exTanggal[1] . '-01 00:00:00');
        $to = date('Y-m-t 12:59:59');

        $penitipan = Penitipan::where('data_siswa_id', $siswa)->whereBetween('waktu', [$from, $to])->get();

        $getDataSiswa = DataSiswa::findOrFail($siswa);

        $count = 0;
        foreach ($penitipan as $item) {
            $count = $count + $getDataSiswa->getJenisBiayaById->denda_permenit * ceil(($item->keterlambatan_jemput / 15));
        }

        $respone = [
            'bayar' => $getDataSiswa->getJenisBiayaById->bulanan,
            'denda' => $count,
            'total' => $getDataSiswa->getJenisBiayaById->bulanan + $count,
        ];

        return $respone;
    }
}
