<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view(
            'admin.dashboard'
        );
    }

    public function users()
    {
        $users = User::orderBy('username', 'asc')->get();
        return view('admin.users', ['users' => $users]);
    }
}
