@extends('layouts.login_app')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <h2 class="my-3">Register</h2>
        <div class="form-group">
            <label for="name" class="sr-only">Name</label>
            <input id="name" type="text" class="form-control form-control-lg" name="name" placeholder="Name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Email address"
                   value="{{ old('email') }}" required autocomplete="email">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Password" required autocomplete="current-password">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Confirm Password</label>
            <input type="password" id="password-confirm" name="password_confirmation" class="form-control form-control-lg"
                   placeholder="Confirm Password" required autocomplete="new-password">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <hr>
        <div class="text-center">
            <a class="mx-1">Already have an account ?</a>
            <a href="{{ route('login') }}">Login here</a>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
@endsection
