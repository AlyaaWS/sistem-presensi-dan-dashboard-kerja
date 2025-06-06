<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
     public function index($id)
    {
        $workspace = Workspace::findOrFail($id);
        $boards = Board::where('id_workspace', $id)->get();

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
}
