@extends('layouts.app')

@section('title', 'Notification Details')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Notification Details</h2>
        <div class="card shadow mb-4">
            <form>
                <div class="card-header">
                    <strong class="card-title">'{{ $notification->title }}' 's Details</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" disabled value="{{ $notification->title }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="short_description">Short Description</label>
                                <input type="text" id="short_description" class="form-control" disabled value="{{ $notification->short_description }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                {{ htmlString($notification->description) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Users</label>
                                @if(isEmptyArray($users))
                                    <input type="text" class="form-control" disabled value="All Users">
                                @else
                                    @foreach($users as $user)
                                        <div class="pb-20-px">
                                            <input type="text" class="form-control" disabled value="{{ $user->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group mb-3 text-right">
                                <a href="{{ route('notifications.index') }}" class="btn btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span>
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
