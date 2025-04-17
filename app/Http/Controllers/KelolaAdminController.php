<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaAdminController extends Controller
{
    public function index()
    {
        return view('kelolaAdmin');
    }
}
