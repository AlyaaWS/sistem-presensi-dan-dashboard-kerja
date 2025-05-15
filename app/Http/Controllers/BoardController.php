<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index()
    {
        return view('/users/board');
    }

}