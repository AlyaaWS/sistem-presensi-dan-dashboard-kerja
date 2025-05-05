<?php
namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;

class EditPresensiController extends Controller
{
    public function edit($id)
    {
        $presensi = Presensi::findOrFail($id);
        $users = User::all();
        return view('editPresensi', compact('presensi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        $presensi = Presensi::findOrFail($id);
        $presensi->id_user = $request->id_user;
        $presensi->date = $request->date;
        $presensi->time = $request->time;
        $presensi->location = $request->location;
        $presensi->save();

        return redirect()->route('kelola.presensi')->with('success', 'Presensi berhasil diperbarui.');
    }
}
