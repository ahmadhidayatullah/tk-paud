<?php

namespace App\Http\Controllers;

use App\Models\Umum;
use Illuminate\Http\Request;
use Validator;

class UmumController extends Controller
{
    public function index()
    {
        $data = Umum::where('id', 1)->first();

        return view('umum.index', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kepsek' => 'required',
            'a1' => 'required',
            'a2' => 'required',
            'b1' => 'required',
            'b2' => 'required',
            'b3' => 'required',
            'b4' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('umum', ['id' => $id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', format_message('Gagal! Periksa Data Masukan', 'danger'));
        }

        Umum::where('id', $id)->update([
            'kepsek' => $request->kepsek,
            'a1' => $request->a1,
            'a2' => $request->a2,
            'b1' => $request->b1,
            'b2' => $request->b2,
            'b3' => $request->b3,
            'b4' => $request->b4,
        ]);

        return redirect()->route('umum', $id)->with('message', format_message('Berhasil update data !', 'info'));
    }
}
