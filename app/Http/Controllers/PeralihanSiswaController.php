<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\JenisBiayaSiswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Validator;

class PeralihanSiswaController extends Controller
{
    public function index()
    {
        $jenisBiaya = JenisBiayaSiswa::all();
        return view('peralihan.create', [
            'jenisBiaya' => $jenisBiaya,
        ]);
    }

    public function show(Request $request)
    {
        if (isset($request->text) || $request->text != '') {
            # code...
            $text = isset($request->text) ? $request->text : '';
            $data = DataSiswa::where('nama', 'LIKE', trim($text) . '%')
                ->where('jenis_biaya_siswa_id', 4)->get();

            if ($data->count() < 1) {
                return '<option> -- Data Tidak Ada -- </option>';
            } else {
                $option = '<option> -- Pilih -- </option>';
                foreach ($data as $item) {
                    $option .= "<option value=" . $item->id . "> " . $item->nama . " </option>";
                }
                return $option;
            }
        } else {
            $id = isset($request->id) ? $request->id : '';
            $data = DataSiswa::findOrFail($id);
            $data['ortu'] = $data->getUserById->name;
            return $data;
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required',
            //murid
            'nis' => 'required|min:9|max:9',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_biaya_siswa_id' => 'required',
            'jenis_bayar' => 'required',
            'pekerjaan_orang_tua' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $jenis_biaya = JenisBiayaSiswa::findOrFail($request->jenis_biaya_siswa_id);

        $siswa = DataSiswa::create([
            'user_id' => $request->id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
            'alamat' => $request->alamat,
            'jenis_biaya_siswa_id' => $request->jenis_biaya_siswa_id,
            'jenis_bayar' => $request->jenis_bayar,
            'no_hp' => $request->no_hp,
        ]);

        if ($request->jenis_bayar == 'cash') {
            if ($request->jenis_biaya_siswa_id == 2 || $request->jenis_biaya_siswa_id == 3) {
                Pembayaran::insert([
                    ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                    ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pangkal, 'created_at' => date('Y-m-d H:i:s')],
                    ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                ]);
            } else {
                if ($request->kelas == 'B1' || $request->kelas == 'B2' || $request->kelas == 'B3' || $request->kelas == 'B4' && $request->jenis_biaya_siswa_id == 1) {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pangkal, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'seragam', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->seragam, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'peralihan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->peralihan, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                } else {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pangkal, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'seragam', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->seragam, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                }
            }
        } else {
            if ($request->jenis_biaya_siswa_id == 2 || $request->jenis_biaya_siswa_id == 3) {
                Pembayaran::insert([
                    ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                    ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $request->cicilan, 'created_at' => date('Y-m-d H:i:s')],
                    ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                ]);
            } else {
                if ($request->kelas == 'B1' || $request->kelas == 'B2' || $request->kelas == 'B3' || $request->kelas == 'B4' && $request->jenis_biaya_siswa_id == 1) {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $request->cicilan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'seragam', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->seragam, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'peralihan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->peralihan, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                } else {

                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $request->cicilan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'seragam', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->seragam, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                }
            }
        }

        \LogActivity::addToLog("Tambah data Guru ID #{$siswa->id}.");

        // $link = "<a target='_blank' href=" . route('print.pendaftaran', $siswa->id) . " class='btn btn-primary'>Print Kwitansi</a>";
        return redirect()->route('data-siswa')->with('message', format_message('Berhasil menyimpan data ! ', 'success'));
    }
}
