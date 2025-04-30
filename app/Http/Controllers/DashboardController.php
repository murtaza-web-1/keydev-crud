<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LatestNews;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the logged-in user is an admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Get the latest news record from database
        $latestNews = LatestNews::latest('last_updated')->first();
        
        // Check if we need to fetch new data (no data or data older than 30 minutes)
        if (!$latestNews || Carbon::now()->diffInMinutes($latestNews->last_updated) > 30) {
            // Fetch new data from API
            $response = Http::get('https://api.spaceflightnewsapi.net/v4/articles/');
            $news = $response->json();

            // Save to database
             LatestNews::create([
                'news' => $news,
                'last_updated' => Carbon::now()
            ]);
        } else {
            // Use cached data from database
            $news = $latestNews->news;
        }

        return view('dashboard', compact('news'));
    }
}
