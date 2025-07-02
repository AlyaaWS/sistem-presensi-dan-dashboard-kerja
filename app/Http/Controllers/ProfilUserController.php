<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class ProfilUserController extends Controller
{
    public function index(Request $request)
{
     $user = $request->user()->load('role');
     return view('/users/profilUser', compact('user'));
}

}