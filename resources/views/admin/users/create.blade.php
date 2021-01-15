@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create User</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('users.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Create a New User here</strong>
                </div>
                @include('admin.users.common_input_fields', ['user' => null, 'btn' => 'Create', 'backUrl' => route('users.index')])
            </form>
        </div>
    </div>
@endsection
