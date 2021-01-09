@extends('layouts.login_app')

@section('title', 'Confirm Password')

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2 class="my-3">Confirm Password</h2>
        {{ __('Please confirm your password before continuing.') }}

        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Password" required autocomplete="current-password">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Confirm Password') }}</button>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        @endif
        <hr>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
@endsection
