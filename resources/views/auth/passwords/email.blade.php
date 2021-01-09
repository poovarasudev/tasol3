@extends('layouts.login_app')

@section('title', 'Reset Password')

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2 class="my-3">Reset Password</h2>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Email address"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send Password Reset Link</button>
        <hr>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
@endsection
