<?php

namespace App\Http\Controllers;

use App\Models\User_activity as Log;

class LogActivityController extends Controller
{
    public function index()
    {
        $data = Log::orderBy('id', 'desc')->get();
        return view('logs.index', ['logs' => $data]);
    }
}
