<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class ProfilUserController extends Controller
{
    public function index()
    {
        return view('/users/profilUser');
    }

}