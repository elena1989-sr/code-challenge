@extends('layouts.master')
@section('content')

<form method="POST" action="{{ route('createjob.store') }}">
 @csrf
    <div class="container">
        <h2 style="color:#f8b739;">Create a Job</h2>
        <div class="row">
            <div class="col-md-6">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required placeholder="The name of the job">
            </div>
        </div>
        <div class="row padding-row">
            <div class="col-md-6">
                <label for="description">Description (JSON format)</label>
                <textarea name="description" class="form-control" rows="8" required>{{ old('description') ?? '{
                    "benefits": [
                        "Health insurance",
                        "Flexible hours",
                        "Company events"
                    ],
                    "overview": "Blanditiis alias quis voluptatem. Culpa voluptatum officia nostrum ab.",
                    "requirements": [
                        "ex",
                        "nemo",
                        "molestiae",
                        "aut"
                    ],
                    "responsibilities": [
                        "Voluptas quis aspernatur necessitatibus.",
                        "Non accusantium id molestias laudantium et harum deleniti.",
                        "Dolore perspiciatis aperiam sunt et."
                    ]
                    }' }}</textarea>
            </div>
        </div>
        <div class="row padding-row">
            <div class="col-md-6">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control" placeholder="Example city, state">
            </div>
        </div>
       <div class="row padding-row">
            <div class="col-md-6">
                <label for="employment_type">Employment Type</label>
                <input type="text" name="employment_type" class="form-control" required placeholder="Full time or part time">
            </div>
        </div>
        <div class="row padding-row">
            <div class="col-md-6">
                <label for="salary">Salary</label>
                <input type="number" name="salary" step="0.01" class="form-control" placeholder="Salary in brutto">
            </div>
        </div>
        <div class="row padding-row">
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="hidden" name="is_remote" value="0">

                    <input type="checkbox" name="is_remote" value="1">
                    <label class="form-check-label" for="is_remote">Remote(if available)</label>
                </div>
            </div>
        </div>

        <div class="row padding-row">
            <div class="col-md-6">
                <label for="end_date">End Date for applying</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        <div class="row padding-row">
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Create Job</button>
            </form>
            </div>
        </div>
    @endsection