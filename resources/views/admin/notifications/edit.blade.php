@extends('layouts.app')

@section('title', 'Update Notification')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update Notification</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('notifications.update', $notification->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $notification->title }}'</strong>
                </div>
                @include('admin.notifications.common_input_fields', ['btn' => 'Update', 'backUrl' => route('notifications.index')])
            </form>
        </div>
    </div>
@endsection
