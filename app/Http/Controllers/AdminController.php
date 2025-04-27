<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show admin dashboard (only accessible by admin users)
    public function showAdminDashboard()
    {
        // Ensure the authenticated user has an 'admin' role
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Fetch all users to show on the admin dashboard
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // Show the edit form for a specific user (for admin)
    public function editUser(User $user)
    {
        // Pass the user data to the edit view
        return view('admin.edit', compact('user'));
    }

    // Update the user details (for admin)
    public function updateUser(Request $request, User $user)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update user details
        $user->update($validated);

        // Redirect back with success message
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }

    public function destroyUser(User $user)
    {
        // Delete the user from the database
        $user->delete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }
 
    
}
