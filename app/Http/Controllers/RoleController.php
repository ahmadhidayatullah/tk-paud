<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('roles.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Please check your form !', 'danger'));
        }

        $admin = Role::create([
            'name' => $request->name,
        ]);
        return redirect()->route('role')->with('message', format_message('Success insert data !', 'success'));
    }
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        // return $roles->id;
        return view('roles.edit', ['role' => $role]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('role.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Failed! Please check your data', 'danger'));
        }

        Role::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role')->with('message', format_message('Success update data !', 'info'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $role = Role::where('id', $id)->delete();
            return redirect()->route('role')->with('message', format_message('Delete Success!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('role')->with('message', format_message('Cannot delete! The data has relation in User', 'danger'));
        }

    }

    public function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0)
    {
        /* mencari nomor baru dengan memecah nomor terakhir dan menambahkan 1
        string nomor baru dibawah ini harus dengan format XXX000000
        untuk penggunaan dalam format lain anda harus menyesuaikan sendiri */
        $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
        //    menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
        $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
        //    menyusun kunci dan nomor baru
        $kode = $kunci . $nomor_baru_plus_nol;
        return $kode;
    }
}
