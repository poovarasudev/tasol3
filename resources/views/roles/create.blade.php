@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create Role</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('roles.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Create a New Role here</strong>
                </div>
                @include('roles.common_input_fields', ['role' => null, 'btn' => 'Create', 'backUrl' => route('roles.index')])
            </form>
        </div>
    </div>
@endsection
