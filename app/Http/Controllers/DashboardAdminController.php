<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('status', 'non active')->get();
        return view('dashboard', compact('pendingUsers'));
    }

    public function aktifkan($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'Pengguna telah diaktifkan.');
    }
}
