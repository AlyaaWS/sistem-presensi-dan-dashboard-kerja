<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Tambahkan model Role
use Illuminate\Http\Request;

class TambahPenggunaController extends Controller
{
    public function index()
    {
        // Ambil semua role dari tabel roles
        $roles = Role::all();

        // Kirim data role ke view
        return view('tambahPengguna', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required', // role di sini berisi id dari tabel roles
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'active',
            'id_role' => $request->role, // langsung pakai id role dari dropdown
        ]);

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }
}
