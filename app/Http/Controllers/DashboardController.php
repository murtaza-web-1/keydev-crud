<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the logged-in user is an admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // For regular users, show the news dashboard
        $response = Http::get('https://api.spaceflightnewsapi.net/v4/articles/');
        $news = $response->json();
        return view('dashboard', compact('news'));
    }
}
