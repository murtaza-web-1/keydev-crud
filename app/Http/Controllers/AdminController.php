<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function showUserDashboard()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function showAdminDashboard()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }
}
