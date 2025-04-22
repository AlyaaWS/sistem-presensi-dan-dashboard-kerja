<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPresensiController extends Controller
{
    public function index()
    {
        return view('kelolaPresensi');
    }
}
