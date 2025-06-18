<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    // Tampilkan semua workspace
    public function index()
{
    $workspaces = Workspace::where('id_user', Auth::id())->get();
    return view('users.workspace', compact('workspaces'));
}


    // Tampilkan form tambah workspace
    public function create()
    {
        $users = User::all();
        return view('users.workspace_create', compact('users'));
    }

    // Simpan workspace baru
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
    ]);

        Workspace::create([
        'title' => $request->title,
        'id_user' => Auth::id(),
        'archived' => false
        
    ]);

        return redirect()->route('workspace')->with('success', 'Workspace berhasil ditambahkan');

    }

    // Tampilkan form edit
    public function edit($id)
    {
        $workspace = Workspace::findOrFail($id);
        $users = User::all();
        return view('users.workspace_edit', compact('workspace', 'users'));
    }

    // Update workspace
    public function update(Request $request, $id)
    {
        $workspace = Workspace::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id',
            'archived' => 'boolean',
        ]);

        $workspace->update($request->all());

        return redirect()->route('workspace')->with('success', 'Workspace berhasil ditambahkan');

    }

    // Hapus workspace
    public function destroy($id)
    {
        $workspace = Workspace::findOrFail($id);
        $workspace->delete();

        return redirect()->route('workspace')->with('success', 'Workspace berhasil ditambahkan');

    }

    public function copy($id)
    {
        $original = Workspace::findOrFail($id);

        Workspace::create([
            'title' => $original->title . ' (Copy)',
            'id_user' => Auth::id(),
            'archived' => false
        ]);

        return redirect()->route('workspace')->with('success', 'Workspace berhasil disalin');
    }

    public function rename(Request $request, $id)
    {
         $request->validate([
              'title' => 'required|string|max:255',
         ]);

         $workspace = Workspace::findOrFail($id);
         $workspace->title = $request->title;
         $workspace->save();

         return redirect()->route('workspace')->with('success', 'Workspace berhasil diganti namanya');
    }

    public function invite(Request $request)
    {
         $request->validate([
             'email' => 'required|email|exists:users,email',
             'id_workspace' => 'required|exists:workspaces,id_workspace'
         ]);

         $user = User::where('email', $request->email)->first();
         $workspace = Workspace::findOrFail($request->id_workspace);

         $workspace->members()->syncWithoutDetaching([
             $user->id => ['role_in_workspace' => 'member']
         ]);

         return back()->with('success', 'User berhasil ditambahkan ke workspace.');
    }


}
