@extends('layouts.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row" style="padding-bottom:30px">
    <div class="col-md-12" style="text-align: center;font-size: 30px;">
       Find your <span style="color:#f8b739;">next</span> job.
     </div> 
</div>
<div class="row" style="padding-bottom:30px">
    <div class="col-md-12">
        <form method="GET" action="{{ route('jobs.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-6">
                    <input
                        type="text"
                        name="job_title"
                        value="{{ request('job_title') }}"
                        class="form-control"
                        placeholder="Job Title"
                    >
                </div>
                <div class="col-md-4">
                    <input
                        type="text"
                        name="location"
                        value="{{ request('location') }}"
                        class="form-control"
                        placeholder="Location"
                    >
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Employment Type</th>
                    <th>Remote</th>
                    <th>Salary</th>
                    <th>Applying ends on:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td> <a href="{{ route('jobs.show', $job) }}">
                            {{ $job->title }}
                        </a>
                    </td>
                    <td>{{ $job->company->name }}</td>
                    <td>{{ $job->location ?? 'N/A' }}</td>
                    <td>{{ $job->employment_type }}</td>
                    <td>{{ $job->is_remote ? 'Yes' : 'No' }}</td>
                    <td>
                        @if($job->salary)
                            €{{ number_format($job->salary, 2) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $job->end_date ? $job->end_date->format('Y-m-d') : 'No deadline' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div>
    {{ $jobs->links() }}
</div>
@endsection