@extends('layouts.app')

@section('title', 'Create Team')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update Team</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('teams.update', $team->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $team->name }}'</strong>
                </div>
                @include('teams.common_input_fields', ['btn' => 'Update', 'backUrl' => route('teams.index')])
            </form>
        </div>
    </div>
@endsection