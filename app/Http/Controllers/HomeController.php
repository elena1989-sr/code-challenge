<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Search;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $jobTitle = $request->input('job_title');
        $location = $request->input('location');
        
    if (Auth::check() && Auth::user()->role === 'seeker') {
        
        $filters = [
            'job_title' => $jobTitle,
            'location' => $location,
        ];

        Search::create([
            'user_id' => Auth::id(),
            'filters' => json_encode($filters),
        ]);
    }
    $jobs = Job::with('company')->paginate(10);

    $jobs = Job::with('company')->when($jobTitle, function ($query, $jobTitle) {
            
        $query->where('title', 'like', "%{$jobTitle}%");

        })->when($location, function ($query, $location) {
            
            $query->where('location', 'like', "%{$location}%");
            
        })->paginate(10)->withQueryString();

        return view('home', compact('jobs'));
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }
}
