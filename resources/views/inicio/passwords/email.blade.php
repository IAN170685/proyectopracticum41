<!-- resources/views/inicio/passwords/email.blade.php -->
@extends('layout.inicio')

@section('title', 'Reset Password')

@section('content')
    <div class="container">
        <h1>Reset Password</h1>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Send Password Reset Link</button>
        </form>
    </div>
@endsection
