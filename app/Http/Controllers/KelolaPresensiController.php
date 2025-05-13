<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KelolaPresensiController extends Controller
{
    public function index()
    {
        $presensis = Presensi::with('user.role')->get();
        return view('kelolaPresensi', compact('presensis'));
    }
    public function hapus($id)
    {
        $presensis = Presensi::findOrFail($id);
        $presensis->delete();

        return redirect()->route('kelola.presensi')->with('success', 'Presensi berhasil dihapus.');
    }

}
