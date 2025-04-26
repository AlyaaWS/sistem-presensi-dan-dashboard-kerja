<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KelolaAdminController extends Controller
{
    public function index()
    {
        $admins = User::with('role')->whereHas('role', function ($query) {
            $query->where('nama_role', 'admin 1')
                  ->orWhere('nama_role', 'admin 2');
        })->get();

        return view('kelolaAdmin', compact('admins'));
    }
}
