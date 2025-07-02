<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KelolaAdminController extends Controller
{
    public function index()
    {
        $admins = User::with('role')->whereHas('role', function ($query) {
           $query->whereRaw('LOWER(nama_role) LIKE ?', ['%admin%']);
        })->get();

        return view('kelolaAdmin', compact('admins'));
    }

    public function hapus($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('kelola.admin')->with('success', 'Admin berhasil dihapus.');
    }

}
