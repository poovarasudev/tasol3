@extends('layouts.app')

@section('title', 'Create Team')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create Team</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('teams.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Create a New Team here</strong>
                </div>
                @include('admin.teams.common_input_fields', ['team' => null, 'btn' => 'Create', 'backUrl' => route('teams.index')])
            </form>
        </div>
    </div>
@endsection
