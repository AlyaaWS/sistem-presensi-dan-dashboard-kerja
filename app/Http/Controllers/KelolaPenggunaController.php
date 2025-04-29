<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class KelolaPenggunaController extends Controller
{
        public function index()
    {
        $users = User::with('role')->get();

        return view('kelolaPengguna', compact('users'));
    }
    public function hapus($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

}
