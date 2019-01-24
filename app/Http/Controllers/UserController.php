<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }
    public function show($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('users.view', ['user' => $user, 'roles' => $roles]);
    }
    public function update_general(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            // 'role' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('user.show', ['id' => $user->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Gagal! Silahkan periksa inputan anda', 'danger'));
        }

        $user->username = $request->username;
        $user->name = $request->name;
        $user->role_id = 1;
        $user->updated_by = Auth::user()->name;
        $user->save();

        \LogActivity::addToLog("Update data user ID #{$user->id}.");

        return back()->with('message', format_message('Berhasil update data !', 'info'));
    }

    public function update_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        $user = User::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('user.show', ['id' => $user->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Gagal update password', 'danger'));
        }

        $user->password = bcrypt($request->password);
        $user->updated_by = Auth::user()->name;
        $user->save();

        \LogActivity::addToLog("Update data user ID #{$user->id}.");

        return back()->with('message', format_message('Berhasil update password !', 'info'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'required|min:6',
            'name' => 'required|string|max:255',
            // 'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Silahkan periksa inputan !', 'danger'));
        }

        $admin = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role_id' => 1,
            'created_by' => Auth::user()->name,
        ]);

        if ($admin) {
            \LogActivity::addToLog("Tambah data user ID #{$admin->id}.");
        }

        return redirect()->route('user')->with('message', format_message('Berhasil menyimpan data !', 'success'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            \LogActivity::addToLog("Hapus data user ID #{$user->id}..");
            return redirect()->route('user')->with('message', format_message('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('user')->with('message', format_message('Cannot delete! The data has relation in User', 'danger'));
        }

    }
}
