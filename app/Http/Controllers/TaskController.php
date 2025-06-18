<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

public function store(Request $request)
{
     $request->validate([
         'description' => 'required|string',
         'due_date' => 'required|date',
         'id_board' => 'required|exists:boards,id_board',
     ]);

     \App\Models\Task::create($request->all());

     return redirect()->back()->with('success', 'Tugas berhasil ditambahkan');
}

public function check($id)
{
     $task = Task::findOrFail($id);
     $task->status_progress = 'selesai';
     $task->save();

     return response()->json(['success' => true]);
}

public function destroy($id)
{
     $task = Task::findOrFail($id);
     $task->delete();

     return response()->json(['success' => true]);
}

public function update(Request $request, $id)
{
     $request->validate([
         'description' => 'required|string',
         'due_date' => 'required|date'
     ]);

     $task = Task::findOrFail($id);
     $task->update($request->only(['description', 'due_date']));

     return redirect()->back()->with('success', 'Task diperbarui.');
}

public function toggle($id)
{
     $task = Task::findOrFail($id);

     // Toggle: kalau selesai → belum, kalau belum → selesai
     $task->status_progress = $task->status_progress === 'selesai' ? 'belum' : 'selesai';
     $task->save();

     return response()->json(['success' => true, 'status' => $task->status_progress]);
}


}