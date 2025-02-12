<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $latestUploadedMovies = Movie::latest()->limit(10)->get();

        return view('admin.dashboard', compact('latestUploadedMovies'));
    }

    public function users()
    {
        $users = User::orderBy('username')->get();

        return view('admin.users', compact('users'));
    }
}
