@extends('layouts.master')

@section('content')
    <h4 class="text-xl font-bold mb-4">Your Saved Jobs</h4>

    @forelse ($savedJobs as $saved)
        <div class="p-4 border mb-2 rounded shadow">
            <h5 class="text-lg font-semibold" style="color: #f8b739;">{{ $saved->job->title }}</h5>
            <p>{{ $saved->job->location }}</p>
            <a href="{{ route('jobs.show', $saved->job->id) }}" class="text-blue-500">View Job</a>
        </div>
    @empty
        <p>No saved jobs yet.</p>
    @endforelse
@endsection