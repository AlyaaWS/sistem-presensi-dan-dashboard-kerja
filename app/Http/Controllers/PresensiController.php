<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Presensi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $today = strtolower($now->locale('id')->dayName); // contoh: 'jumat'
        $timeNow = $now->toTimeString();

        $schedules = Schedule::all();

        // Debug: menampilkan seluruh jadwal beserta hasil pengecekan waktu dan hari
        /*
        foreach ($schedules as $item) {
            dump([
                'start_time' => $item->start_time,
                'end_time' => $item->end_time,
                'active_day' => $item->active_day,
                'now' => $timeNow,
                'cocok_jam' => $timeNow >= $item->start_time && $timeNow <= $item->end_time,
                'cocok_hari' => $this->isTodayInRange($item->active_day, $today),
            ]);
        }
        */

        // Ambil semua jadwal aktif di jam ini
        $schedules = Schedule::whereRaw('? BETWEEN start_time AND end_time', [$timeNow])->get();

        // Cek satu per satu apakah hari ini masuk range-nya
        $schedule = $schedules->first(function ($item) use ($today) {
            return $this->isTodayInRange($item->active_day, $today);
        });

        // Debug: cek hasil akhir pencarian jadwal yang cocok
        /*
        dd([
            'today' => $today,
            'timeNow' => $timeNow,
            'schedule_found' => $schedule,
        ]);
        */

        return view('/users/presensi', compact('schedule'));
    }

    private function isTodayInRange($range, $today)
    {
        $range = strtolower($range);
        $today = strtolower($today);

        // Jika koma (bentuk: senin,rabu,jumat)
        if (str_contains($range, ',')) {
            $days = array_map('trim', explode(',', $range));
            return in_array($today, $days);
        }

        // Jika bentuk range: senin-jumat
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

        // Jika bukan range, langsung bandingkan
        if (!str_contains($range, '-')) {
            return $range === $today;
        }

        [$start, $end] = explode('-', $range);
        $startIndex = array_search(trim($start), $days);
        $endIndex = array_search(trim($end), $days);
        $todayIndex = array_search($today, $days);

        if ($startIndex === false || $endIndex === false || $todayIndex === false) return false;

        return $startIndex <= $endIndex
            ? $todayIndex >= $startIndex && $todayIndex <= $endIndex
            : $todayIndex >= $startIndex || $todayIndex <= $endIndex;
    }

    public function generateQr($id)
    {
    $schedule = Schedule::findOrFail($id);

    $token = Str::random(10);
    $expired = Carbon::today()->setTimeFromTimeString($schedule->end_time); // ⬅️ ini bikin countdown ikut end_time

    $schedule->update([
    'qr_token' => $token,
    'token_expired_at' => $expired,
    ]);

    $url = route('presensi.scan', ['token' => $token]);
    $qrCode = QrCode::size(250)->generate($url);

    return response()->json([
    'qr' => (string) $qrCode,
    'expired_at' => $expired->toIso8601String(),
    ]);
    }

    public function scanQr($token)
    {
        $schedule = Schedule::where('qr_token', $token)
            ->where('token_expired_at', '>=', now())
            ->first();

        if (!$schedule) {
            return response("QR tidak valid atau kadaluarsa", 403);
        }

        Presensi::create([
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'location' => 'from qr scan',
            'id_user' => Auth::id(),
        ]);

        return redirect('/users/presensi')->with('success', 'Presensi berhasil!');
    }
}
