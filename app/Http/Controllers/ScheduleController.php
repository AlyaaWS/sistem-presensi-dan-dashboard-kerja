<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jam_mulai' => 'required',
            'jam_berakhir' => 'required',
            'hari_mulai' => 'required',
            'hari_berakhir' => 'required',
            'batas_scan' => 'required|integer',
            'lokasi' => 'required|string'
        ]);

        $dayRange = strtolower($this->generateDayRange($request->hari_mulai, $request->hari_berakhir));

        Schedule::create([
            'start_time' => $request->jam_mulai,
            'end_time' => $request->jam_berakhir,
            'active_day' => $dayRange, // hasil: senin,selasa,rabu
            'scan_limit' => $request->batas_scan,
            'location' => $request->lokasi,
        ]);

        return back()->with('success', 'Jadwal presensi berhasil disimpan.');
    }

    private function generateDayRange($start, $end)
    {
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $startIndex = array_search(strtolower($start), $days);
        $endIndex = array_search(strtolower($end), $days);

        if ($startIndex === false || $endIndex === false) return '';

        if ($startIndex <= $endIndex) {
            return implode(',', array_slice($days, $startIndex, $endIndex - $startIndex + 1));
        } else {
            return implode(',', array_merge(
                array_slice($days, $startIndex),
                array_slice($days, 0, $endIndex + 1)
            ));
        }
    }
}
