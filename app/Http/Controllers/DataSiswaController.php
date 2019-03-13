<?php

namespace App\Http\Controllers;

use App\Exports\DataSiswaExport;
use App\Models\DataSiswa;
use App\Models\JenisBiayaSiswa;
use App\Models\Pembayaran;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class DataSiswaController extends Controller
{
    public function index(Request $request, $siswa = '')
    {
        $limit = $request->get('limit');
        if ($limit == 'all') {
            $title = "Semua Data Siswa";
            $data = DataSiswa::orderBy('id', 'DESC')->get();
        } elseif ($limit == '1') {
            $title = "Data Siswa Tahun Ajar 2018/2019";
            $data = DataSiswa::whereYear('created_at', 2018)->orderBy('id', 'DESC')->get();
        } elseif ($limit == '2') {
            $title = "Data Siswa Tahun Ajar 2019/2020";
            $data = DataSiswa::whereYear('created_at', 2019)->orderBy('id', 'DESC')->get();
        } elseif ($limit == '3') {
            $title = "Data Siswa Tahun Ajar 2020/2021";
            $data = DataSiswa::whereYear('created_at', 2020)->orderBy('id', 'DESC')->get();
        } elseif ($limit == '4') {
            $title = "Data Siswa Tahun Ajar 2021/2022";
            $data = DataSiswa::whereYear('created_at', 2021)->orderBy('id', 'DESC')->get();
        } elseif ($limit == '5') {
            $title = "Data Siswa Tahun Ajar 2022/2023";
            $data = DataSiswa::whereYear('created_at', 2022)->orderBy('id', 'DESC')->get();
        } else {

            if ($siswa == 'tk') {
                $title = "Siswa TK";
                $data = DataSiswa::where('jenis_biaya_siswa_id', 1)->orderBy('id', 'DESC')->get();
            } elseif ($siswa == 'kb') {
                $title = "Kelompok Bermain";
                $data = DataSiswa::where('jenis_biaya_siswa_id', 4)->orderBy('id', 'DESC')->get();
            } elseif ($siswa == 'tpa') {
                $title = "Kelompok Bermain";
                $data = DataSiswa::where('jenis_biaya_siswa_id', 2)->orWhere('jenis_biaya_siswa_id', 3)->orderBy('id', 'DESC')->get();
            } else {
                if (Auth::user()->role_id == 3) {
                    $title = "Halaman Siswa";
                    $data = DataSiswa::where('user_id', Auth::user()->id)->get();
                } else {
                    $title = "Halaman Siswa";
                    $data = DataSiswa::orderBy('id', 'DESC')->get();
                }
            }
        }
        return view('data-siswa.index', [
            'data' => $data,
            'title' => $title,
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

            \LogActivity::addToLog("Tambah data user ID #{$user->id}.");
            \LogActivity::addToLog("Tambah data Guru ID #{$siswa->id}.");
        }
        $link = "<a target='_blank' href=" . route('print.pendaftaran', $siswa->id) . " class='btn btn-primary'>Print Kwitansi</a>";
        return redirect()->route('data-siswa')->with('message', format_message('Berhasil menyimpan data ! ' . $link, 'success'));
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

    public function export()
    {
        return Excel::download(new DataSiswaExport, 'data_siswa.xlsx');
    }

    function print($id) {
        $data = DataSiswa::findOrFail($id);
        return view('data-siswa.print', [
            'data' => $data,
        ]);
    }

    public function nilai(Request $request, $data_id)
    {
        $data = DataSiswa::findOrFail($data_id);
        return view('data-siswa.nilai', [
            'data' => $data,
        ]);
    }

    public function nilaiStore(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pendahuluan' => 'required',
            'agama' => 'required',
            'fisik_motorik' => 'required',
            'sosial_emosional' => 'required',
            'bahasa' => 'required',
            'kognitif' => 'required',
            'seni' => 'required',
            'penutup' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $nilai = \App\Models\DataSiswaNilai::updateOrCreate([
            'data_siswa_id' => $id,
        ], [
            'pendahuluan' => $request->pendahuluan,
            'agama' => $request->agama,
            'fisik_motorik' => $request->fisik_motorik,
            'sosial_emosional' => $request->sosial_emosional,
            'bahasa' => $request->bahasa,
            'kognitif' => $request->kognitif,
            'seni' => $request->seni,
            'penutup' => $request->penutup,
        ]);

        if ($nilai) {
            return redirect()->route('data-siswa')->with('message', format_message('Berhasil Input Nilai', 'success'));
        } else {
            return redirect()->route('data-siswa')->with('message', format_message('Gagal Input Nilai', 'danger'));
        }

    }
}
