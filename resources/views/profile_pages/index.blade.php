@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">Settings</h2>
        @include('common.common_validation_error_script')
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ setActive(['profile']) }}" href="{{ route('profile.show') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setActive(['profile/notifications']) }}" href="{{ route('profile.notifications') }}">Notifications</a>
                </li>
            </ul>

            @include('profile_pages.' . $page)

        </div>
    </div>
@endsection
