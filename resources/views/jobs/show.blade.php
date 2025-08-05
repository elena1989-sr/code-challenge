@extends('layouts.master')

@section('content')
<div class="container">
    <h3 style="color:#f8b739;">{{ $job->title }}</h3>
    <h4>Company: {{ $job->company->name }}</h4>
    <p><strong>Location:</strong> {{ $job->location ?? 'N/A' }}</p>
    <p><strong>Employment Type:</strong> {{ $job->employment_type }}</p>
    <p><strong>Remote:</strong> {{ $job->is_remote ? 'Yes' : 'No' }}</p>
    <p><strong>Salary:</strong> 
        @if($job->salary)
            €{{ number_format($job->salary, 2) }}
        @else
            N/A
        @endif
    </p>
    <p><strong>Job applying ends on:</strong> {{ $job->end_date ? $job->end_date->format('Y-m-d') : 'No deadline' }}</p>

    <hr>

    <h4 style="color:#f8b739;">Description</h4>

    <h5>Overview</h5>
    <p>{{ $job->description['overview'] ?? 'No overview available.' }}</p>

    <h5>Responsibilities</h5>
    <ul>
        @foreach ($job->description['responsibilities'] ?? [] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h5>Requirements</h5>
    <ul>
        @foreach ($job->description['requirements'] ?? [] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h5>Benefits</h5>
    <ul>
        @foreach ($job->description['benefits'] ?? [] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
    @if(Auth::check() && Auth::user()->role === 'seeker')
        <form action="{{ route('jobs.save', $job->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Save Job</button>
        </form>
    @endif

</div>
@endsection