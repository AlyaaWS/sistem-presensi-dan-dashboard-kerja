<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
    {
        return view('/users/workspace');
    }

}