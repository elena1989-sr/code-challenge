@extends('layouts/auth')
@section('content')


<div class="container mt-5" style="max-width: 500px;">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invali @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password')is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
         <div class="mb-3">
            <div class="form-group">
                <label for="role">Registering as:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="seeker">Job Seeker</option>
                    <option value="owner">Company Owner</option>
                </select>
            </div>
        </div>
        <div class="mb-3" id="company_wrapper" style="display: none;">
            <label for="company_id" class="form-label">Company</label>
            <select name="company_id" id="company_id" class="form-control">
                <option value="">Select a company (optional)</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const companyWrapper = document.getElementById('company_wrapper');

        function toggleCompanyField() {
            if (roleSelect.value === 'owner') {
                companyWrapper.style.display = 'block';
            } else {
                companyWrapper.style.display = 'none';
            }
        }

        roleSelect.addEventListener('change', toggleCompanyField);
        toggleCompanyField();
    });
</script>
@endsection