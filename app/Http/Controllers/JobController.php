<?php


namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class JobController extends Controller
{
  
    public function createjob()
    {
        return view('createjob');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|json',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'is_remote' => 'required|boolean',
            'end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!Auth::user()->company_id) {
            return redirect()->back()->withErrors(['company_id' => 'You must belong to a company to create a job.']);
        }
        $validated['is_remote'] = $request->has('is_remote');
        $validated['user_id'] = Auth::id();
        $validated['company_id'] = Auth::user()->company_id;
        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'employment_type' => $request->employment_type,
            'salary' => $request->salary,
            'is_remote' => $request->is_remote,
            'end_date' => $request->end_date,
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company_id, 
        ]);

        return redirect()->route('home')->with('success', 'Job created successfully.');
    }
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }




    public function save(Job $job)
    {
        $user = auth()->user();

        if ($user->role !== 'seeker') {
            abort(403, 'Only seekers can save jobs.');
        }

        if (!$user->savedJobs->contains($job->id)) {
            $user->savedJobs()->attach($job->id);
        }

        return redirect()->back()->with('success', 'Job saved successfully!');
    }

    public function savedJobs()
    {
        if (Auth::user()->role !== 'seeker') {
            abort(403, 'Only job seekers can view saved jobs.');
        }

        $savedJobs = SavedJob::with('job')
            ->where('user_id', Auth::id())
            ->get();

        return view('jobs.saved', compact('savedJobs'));
    }
    public function saveJob($jobId)
    {
        $user = Auth::user();

        if ($user->role !== 'seeker') {
            abort(403, 'Only job seekers can save jobs.');
        }

        $exists = SavedJob::where('user_id', $user->id)
                        ->where('job_id', $jobId)
                        ->exists();

        if (!$exists) {
            SavedJob::create([
                'user_id' => $user->id,
                'job_id' => $jobId,
            ]);
        }

        return redirect()->back()->with('success', 'Job saved successfully!');
    }
}