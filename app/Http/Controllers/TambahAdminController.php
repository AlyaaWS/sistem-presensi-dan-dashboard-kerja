<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class TambahAdminController extends Controller
{
    public function index()
    {
        return view('tambahAdmin');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required',
    ]);

    // Mapping role ke id_role
    $roleMap = [
        'superadmin' => 1,
        'admin' => 2,
    ];

    User::create([
        'nama_lengkap' => $request->nama_lengkap,
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'status' => 'active',
        'id_role' => $roleMap[$request->role] ?? null,
    ]);

    return redirect()->route('kelola.admin')->with('success', 'Admin berhasil ditambahkan!');
}

}
