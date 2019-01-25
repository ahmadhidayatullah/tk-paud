<?php

namespace App\Http\Controllers;

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

        return redirect()->route('pembayaran')->with('message', format_message('Transaksi berhasil !', 'success'));
    }
}
