@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">Settings</h2>
        @include('common.common_validation_error_script')
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ setActive(['profile', 'profile/*']) }}" id="home-tab" data-toggle="tab" href="{{ route('profile.show') }}" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('profile.store') }}">
                {!! csrf_field() !!}
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ auth()->user()->photo }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                                <p class="small mb-3"><span class="badge badge-dark">{{ formatTeamName(auth()->user()->team->name) }}</span></p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <p class="small mb-0"> Breakfast : {{ getYesOrNo(auth()->user()->breakfast) }}</p>
                                <p class="small mb-0"> Lunch : {{ getYesOrNo(auth()->user()->lunch) }}</p>
                            </div>
                            <div class="col">
                                <p class="small mb-0 text-muted"><b>{{ auth()->user()->name }}</b>, {{ formatTeamName(auth()->user()->team->name) }},</p>
                                <p class="small mb-0 text-muted">62 Vivekananda Nagar, Sengunthapram Main Rd, Karur, Tamil Nadu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" required minlength="2"
                               maxlength="30" value="{{ old('name') ?? auth()->user()->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Mobile Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required pattern="[0-9]{10}"
                               value="{{ old('phone') ?? auth()->user()->phone }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender {{ requiredSpan() }}</label>
                        <select class="form-control select2" id="gender" name="gender" required>
                            <option value="">Please select a Gender</option>
                            <option value="{{ GENDER_MALE }}" {{ ((old('gender') ?? auth()->user()->gender) == GENDER_MALE) ? 'selected' : '' }}>{{ GENDER_MALE }}</option>
                            <option value="{{ GENDER_FEMALE }}" {{ ((old('gender') ?? auth()->user()->gender) == GENDER_FEMALE) ? 'selected' : '' }}>{{ GENDER_FEMALE }}</option>
                            <option value="{{ GENDER_OTHER }}" {{ ((old('gender') ?? auth()->user()->gender) == GENDER_OTHER) ? 'selected' : '' }}>{{ GENDER_OTHER }}</option>
                        </select>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <input type="password" class="form-control" id="old-password" name="old_password">
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" min="">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">Note</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Leave password related fields, if you are not changing password.</li>
                            <li>For updating team, check with Admin.</li>
                            <li>For permanently cancelling breakfast OR lunch, check with Admin.</li>
                        </ul>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Change</button>
            </form>
        </div>
    </div>
@endsection
