<?php

namespace App\Http\Controllers;

use App\Models\KontrolTamanPenitipanAnak as Penitipan;
use Illuminate\Http\Request;
use Validator;

class KontrolPenitipanController extends Controller
{
    public function index()
    {
        $data = Penitipan::orderBy('id', 'DESC')->get();

        return view('penitipan.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('penitipan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data_siswa_id' => 'required',
            'waktu' => 'required',
            'keterlambatan_jemput' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $data = Penitipan::create([
            'data_siswa_id' => $request->data_siswa_id,
            'waktu' => $request->waktu,
            'keterlambatan_jemput' => $request->keterlambatan_jemput,
        ]);

        if ($data) {
            \LogActivity::addToLog("Tambah data pembayaran ID #{$data->id}.");
        }

        return redirect()->route('kontrol-penitipan')->with('message', format_message('Transaksi berhasil !', 'success'));
    }
}
