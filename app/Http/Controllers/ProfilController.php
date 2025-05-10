<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('role');
        return view('profil', compact('user'));
    }


}