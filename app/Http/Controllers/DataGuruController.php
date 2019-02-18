<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class DataGuruController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 2) {
            $data = DataGuru::where('user_id', Auth::user()->id)->get();
        } else {
            $data = DataGuru::orderBy('id', 'DESC')->get();
        }
        return view('data-guru.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('data-guru.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'required|min:6',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'nip' => 'required',
            'nuptk' => 'required',
            'jabatan' => 'required',
            'pendidikan_jenjang' => 'required',
            'pendidikan_jurusan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'created_by' => Auth::user()->name,
        ]);

        if ($user) {
            $guru = DataGuru::create([
                'user_id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'nip' => $request->nip,
                'nuptk' => $request->nuptk,
                'jabatan' => $request->jabatan,
                'pangkat_gol' => $request->pangkat_gol,
                'pangkat_tmt' => $request->pangkat_tmt,
                'pendidikan_jenjang' => $request->pendidikan_jenjang,
                'pendidikan_jurusan' => $request->pendidikan_jurusan,
                'tmt_kgb' => $request->tmt_kgb,
                'ket' => $request->ket,
            ]);
            \LogActivity::addToLog("Tambah data user ID #{$user->id}.");
            \LogActivity::addToLog("Tambah data Guru ID #{$guru->id}.");
        }

        return redirect()->route('data-guru')->with('message', format_message('Berhasil menyimpan data !', 'success'));
    }

    public function edit($id)
    {
        $data = DataGuru::findOrFail($id);
        return view('data-guru.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $guru = DataGuru::findOrFail($id);

        if (!empty($request->password)) {
            $validator = Validator::make($request->all(), [
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($guru->user_id),
                ],
                'name' => 'required',
                'jenis_kelamin' => 'required',
                'tempat' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'nip' => 'required',
                'nuptk' => 'required',
                'jabatan' => 'required',
                'pangkat' => 'required',
                'pendidikan' => 'required',
                'password' => 'min:6|required|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($guru->user_id),
                ],
                'name' => 'required',
                'jenis_kelamin' => 'required',
                'tempat' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'nip' => 'required',
                'nuptk' => 'required',
                'jabatan' => 'required',
                'pangkat' => 'required',
                'pendidikan' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('data-guru.edit', ['id' => $guru->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Gagal! Silahkan periksa inputan anda', 'danger'));
        }
        //user
        if (!empty($request->password)) {
            $guru->getUserById->password = bcrypt($request->password);
        }
        $guru->getUserById->username = $request->username;
        $guru->getUserById->name = $request->name;
        $guru->getUserById->updated_by = Auth::user()->name;

        //data guru
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat = $request->tempat;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->alamat = $request->alamat;
        $guru->no_hp = $request->no_hp;
        $guru->nip = $request->nip;
        $guru->nuptk = $request->nuptk;
        $guru->jabatan = $request->jabatan;
        $guru->pangkat_gol = $request->pangkat_gol;
        $guru->pangkat_tmt = $request->pangkat_tmt;
        $guru->pendidikan_jenjang = $request->pendidikan_jenjang;
        $guru->pendidikan_jurusan = $request->pendidikan_jurusan;
        $guru->tmt_kgb = $request->tmt_kgb;
        $guru->ket = $request->ket;
        $guru->getUserById->save();
        $guru->save();

        \LogActivity::addToLog("Update data user ID #{$guru->user_id}.");

        return redirect()->route('data-guru')->with('message', format_message('Berhasil update data !', 'info'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $guru = DataGuru::find($id);
            $user = User::find($guru->user_id);
            $guru->delete();
            $user->delete();
            \LogActivity::addToLog("Hapus data guru ID #{$guru->id}..");
            \LogActivity::addToLog("Hapus data user ID #{$user->id}..");
            return redirect()->route('data-guru')->with('message', format_message('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('data-guru')->with('message', format_message('Cannot delete! The data has relation in User', 'danger'));
        }

    }
}
