<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;

class TambahPresensiController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('tambahPresensi', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        Presensi::create([
            'id_user' => $request->id_user,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
        ]);

        return redirect()->route('kelola.presensi')->with('success', 'Presensi berhasil ditambahkan!');
    }
}
