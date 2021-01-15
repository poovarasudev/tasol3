@extends('layouts.app')

@section('title', 'Create Notification')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create Notification</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('notifications.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Create a New Notification here</strong>
                </div>
                @include('notifications.common_input_fields', ['notification' => null, 'btn' => 'Create', 'backUrl' => route('notifications.index')])
            </form>
        </div>
    </div>
@endsection
