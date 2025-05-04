<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class EditPenggunaController extends Controller
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

    public function edit($id)
    {
        $user = User::with('role')->findOrFail($id);
        $roles = Role::all();
        return view('editPengguna', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::with('role')->findOrFail($id);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->id_role = $request->id_role;
        $user->save();

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
