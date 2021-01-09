@extends('layouts.login_app')

@section('title', 'Reset Password')

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

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
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Password" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input id="password-confirm" type="password" class="form-control form-control-lg"
                   name="password_confirmation"
                   required autocomplete="new-password">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        <hr>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
@endsection
