<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\JenisBiayaSiswa;
use App\Models\Pembayaran;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class DataSiswaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 2) {
            $data = DataSiswa::where('user_id', Auth::user()->id)->get();
        } else {
            $data = DataSiswa::orderBy('id', 'DESC')->get();
        }
        return view('data-siswa.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        $jenisBiaya = JenisBiayaSiswa::all();
        return view('data-siswa.create', [
            'jenisBiaya' => $jenisBiaya,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'required|min:6',
            'name' => 'required|string|max:255',
            'no_hp' => 'required',
            //murid
            'nama' => 'required',
            'jenis_kelamin' => 'required',
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

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role_id' => 3,
            'created_by' => Auth::user()->name,
        ]);

        if ($user) {
            $siswa = DataSiswa::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
                'alamat' => $request->alamat,
                'jenis_biaya_siswa_id' => $request->jenis_biaya_siswa_id,
                'jenis_bayar' => $request->jenis_bayar,
                'no_hp' => $request->no_hp,
            ]);

            if ($request->jenis_bayar == 'cash') {
                if ($request->jenis_biaya_siswa_id != 1) {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pangkal, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                } else {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pangkal, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'seragam', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->seragam, 'created_at' => date('Y-m-d H:i:s')],
                    ]);
                }
            } else {
                if ($request->jenis_biaya_siswa_id != 1) {
                    Pembayaran::insert([
                        ['jenis_pembayaran' => 'pendaftaran', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->pendaftaran, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'pangkal', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $request->cicilan, 'created_at' => date('Y-m-d H:i:s')],
                        ['jenis_pembayaran' => 'bulanan', 'data_siswa_id' => $siswa->id, 'tanggal' => date('Y-m-d'), 'bayar' => $jenis_biaya->bulanan, 'created_at' => date('Y-m-d H:i:s')],
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

            \LogActivity::addToLog("Tambah data user ID #{$user->id}.");
            \LogActivity::addToLog("Tambah data Guru ID #{$siswa->id}.");
        }

        return redirect()->route('data-siswa')->with('message', format_message('Berhasil menyimpan data !', 'success'));
    }

    public function show($id)
    {
        $data = DataSiswa::findOrFail($id);
        return view('data-siswa.view', [
            'data' => $data,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $siswa = DataSiswa::find($id);
            $user = User::find($siswa->user_id);
            $siswa->delete();
            $user->delete();
            \LogActivity::addToLog("Hapus data guru ID #{$siswa->id}..");
            \LogActivity::addToLog("Hapus data user ID #{$user->id}..");
            return redirect()->route('data-siswa')->with('message', format_message('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('data-siswa')->with('message', format_message('Cannot delete! The data has relation in User', 'danger'));
        }

    }
}
