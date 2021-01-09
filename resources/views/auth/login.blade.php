@extends('layouts.login_app')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2 class="my-3">Login</h2>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Email address"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Password" required autocomplete="current-password">
        </div>
        <div class="checkbox mb-3">
            <label><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember
                Me</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <hr>
        <div class="text-center">
            <a class="mx-1">Don't have Account?</a>
            <a href="{{ route('register') }}">Register Now!</a>
            <a href="{{ route('password.request') }}"><p>Forgot Password?</p></a>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
@endsection
