<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Display the admin dashboard with user data
    public function showAdminDashboard()
    {
        // Check if the authenticated user is an admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // If not an admin, return 403 Unauthorized error
        }

        $users = User::all();  // Fetch all users for admin dashboard
        return view('admin.dashboard', compact('users'));
    }

    // Display the paginated list of users (10 per page)
    public function index()
    {
        $users = User::paginate(10); // Paginate users (10 per page)
        return view('admin.dashboard', compact('users'));
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }

    // Edit a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
    }
}
