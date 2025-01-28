<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Aksi yang ingin dilakukan, misalnya menampilkan dashboard
        return view('user.dashboard');
    }
}
