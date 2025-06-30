<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
   public function index()
{
    $pendingUsers = User::where('status', 'non active')->get();

    $anomali = DB::table('presensis')
        ->where('status', 'Mencurigakan')
        ->orderByDesc('date')
        ->get();

    $hasil = session('hasil'); // ⬅️ ambil hasil ML jika ada

    return view('dashboard', compact('pendingUsers', 'anomali', 'hasil'));
}



    public function aktifkan($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'Pengguna telah diaktifkan.');
    }
}
