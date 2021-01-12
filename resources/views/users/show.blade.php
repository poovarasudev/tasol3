@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="col-12">
        <h2 class="page-title">User Details</h2>
        <div class="card shadow mb-4">
            <form>
                <div class="card-header">
                    <strong class="card-title">'{{ $user->name }}' 's Details</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" disabled value="{{ $user->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Mobile Number</label>
                                <input type="tel" id="phone" class="form-control" disabled value="{{ $user->phone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="team-id">Team</label>
                                <input type="tel" id="team-id" class="form-control" disabled value="{{ $user->team->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" disabled value="{{ $user->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="gender">Gender</label>
                                <input type="text" id="gender" class="form-control" disabled value="{{ $user->gender }}">
                            </div>
                            <div class="form-group mb-3 custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="breakfast" disabled @if($user->breakfast) checked @endif>
                                <label class="custom-control-label" for="breakfast">Breakfast</label>
                            </div>
                            <div class="form-group mb-3 custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="lunch" disabled @if($user->lunch) checked @endif>
                                <label class="custom-control-label" for="lunch">Lunch</label>
                            </div>
                            <div class="form-group mb-3 text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
