<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; // pastikan Role model sudah dibuat

class RoleController extends Controller
{
    /**
     * Tampilkan semua role (opsional jika mau dipakai untuk fetch data).
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles')); // misal pakai view khusus roles
    }

    /**
     * Simpan role baru dari modal.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_role' => 'required|string|max:100|unique:roles,nama_role',
        ]);

        // Simpan ke database
        Role::create([
            'nama_role' => $request->nama_role,
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Role berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Pastikan tidak ada user yang pakai role ini sebelum dihapus
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('failed', 'Tidak bisa menghapus role yang masih digunakan.');
        }

        $role->delete();
        return redirect()->back()->with('success', 'Role berhasil dihapus.');
    }

}
