<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class KelolaPresensiController extends Controller
{
    public function index()
    {
        $presensis = Presensi::with('user.role')->get(); // Relasi: presensi → user → role
        return view('kelolaPresensi', compact('presensis'));
    }

    public function hapus($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('kelola.presensi')->with('success', 'Presensi berhasil dihapus!');
    }
}
