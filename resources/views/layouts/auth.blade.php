@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-8">
                <img src="{{ asset('images/auth.svg') }}" alt="auth" width="40%">
            </div>
            <div class="col-md-4">
                @yield('content')
            </div>
        </div>
    </div>
    
@endsection