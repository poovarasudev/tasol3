@extends('layouts.app')

@section('title', 'Update Role')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update Role</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $role->name }}'</strong>
                </div>
                @include('roles.common_input_fields', ['btn' => 'Update', 'backUrl' => route('roles.index')])
            </form>
        </div>
    </div>
@endsection
