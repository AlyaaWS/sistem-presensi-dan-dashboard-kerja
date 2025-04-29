<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class EditAdminController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('id_role', [1, 2])->get(); // Sesuai id_role admin dan superadmin
        return view('kelolaAdmin', compact('admins'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('editAdmin', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->id_role = $request->id_role;

        $user->save();

        return redirect()->route('kelola.admin')->with('success', 'Admin berhasil diperbarui.');
    }
}
