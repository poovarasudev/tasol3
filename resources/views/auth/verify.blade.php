@extends('layouts.login_app')

@section('title', 'Email Verify')

@section('content')
    <h2 class="my-3">Verify Your Email Address</h2>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button class="btn btn-lg btn-primary btn-block"
                type="submit">{{ __('click here to request another') }}</button>
        .
    </form>
    <hr>
    <p class="mt-5 mb-3 text-muted">© 2020</p>
@endsection
