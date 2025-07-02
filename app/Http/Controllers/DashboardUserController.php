<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\Board;
use App\Models\Task;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $workspaceCount = Workspace::whereHas('members', fn($q) => $q->where('id_user', $userId))->count();
        $boardCount = Board::whereHas('workspace.members', fn($q) => $q->where('id_user', $userId))->count();

        $completedTasks = Task::where('status_progress', 'selesai')
                              ->whereHas('board.workspace.members', fn($q) => $q->where('id_user', $userId))
                              ->count();

        $pendingTasks = Task::where('status_progress', '!=', 'selesai')
                            ->whereHas('board.workspace.members', fn($q) => $q->where('id_user', $userId))
                            ->count();

        // Presensi aktif hari ini
        $now = Carbon::now();
        $today = strtolower($now->locale('id')->dayName);
        $timeNow = $now->toTimeString();

        $schedules = Schedule::whereRaw('? BETWEEN start_time AND end_time', [$timeNow])->get();

        $todaySchedule = $schedules->first(function ($schedule) use ($today) {
            $days = explode(',', $schedule->active_day);
            return in_array($today, $days);
        });

        return view('users.userDashboard', compact(
            'workspaceCount', 'boardCount', 'completedTasks', 'pendingTasks', 'todaySchedule'
        ));
    }
}
