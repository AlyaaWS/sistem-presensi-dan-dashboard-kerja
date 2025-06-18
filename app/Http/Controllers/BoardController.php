<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
     public function index($id)
    {
        $workspace = Workspace::with('members')->findOrFail($id);

        if (!$workspace->members->contains(Auth::id())) {
             abort(403, 'Kamu bukan anggota workspace ini.');
        }
        $boards = Board::with('tasks')->where('id_workspace', $id)->get();

        return view('users.boards', compact('workspace', 'boards'));
    }


     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'id_workspace' => 'required|exists:workspaces,id_workspace',
        ]);

        Board::create([
            'title' => $request->title,
            'id_workspace' => $request->id_workspace,
        ]);

        return redirect()->route('workspace.boards', $request->id_workspace)
            ->with('success', 'Board berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();

        return back()->with('success', 'Board dihapus.');
    }

    public function copy($id)
    {
     $board = Board::with('tasks')->findOrFail($id);
     $newBoard = Board::create([
         'title' => $board->title . ' (Copy)',
         'id_workspace' => $board->id_workspace
     ]);

     foreach ($board->tasks as $task) {
         Task::create([
            'description' => $task->description,
            'due_date' => $task->due_date,
            'id_board' => $newBoard->id_board,
            'status_progress' => $task->status_progress,
            'color' => $task->color,
         ]);
     }

     return back()->with('success', 'Board berhasil disalin.');
    }

    public function rename(Request $request, $id)
    {
         $request->validate(['title' => 'required|string|max:255']);
         $board = Board::findOrFail($id);
         $board->title = $request->title;
         $board->save();

         return back()->with('success', 'Board berhasil diubah.');
    }


}
