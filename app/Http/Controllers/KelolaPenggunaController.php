<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class KelolaPenggunaController extends Controller
{
        public function index()
    {
        $users = User::with('role')
                 ->whereHas('role', function ($query) {
                     $query->where('nama_role', 'not like', '%admin%');
                 })
                 ->get();
        return view('kelolaPengguna', compact('users'));
    }
    public function hapus($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

}
