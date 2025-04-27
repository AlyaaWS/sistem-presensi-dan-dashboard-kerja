<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class EditAdminController extends Controller
{
    public function index()
    {
        return view('editAdmin');
    }

}