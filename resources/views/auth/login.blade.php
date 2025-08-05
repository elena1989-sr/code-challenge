@extends('layouts/auth')
@section('content')
    <div class="container">
        <div class="card" style="max-width:500px;margin:auto">
            <div class="card-header">
                <h5>Login </h5>
            </div>
            <div class="card-body">
                 @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                     @csrf
                     <div class="form-group my-1">
                        <label for="Email">Email </label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                    <div class="form-group my-1">
                        <label for="password">Password </label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="row" style="padding-top:12px">
                        <div class="col-md-6">
                            <div class="form-group my-1">
                                <button type="submit" class="btn btn-warning float-start">Login </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <a href="{{ route('register') }}" class="btn btn-dark float-end">Register </a>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection