@extends('layouts.app')

@section('title', 'Attach Role')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Attach Role</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('assign_role.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Attach a Role to User</strong>
                </div>
                @include('assign_role.common_input_fields', ['user' => null, 'role' => null, 'oldRoleId' => old('role_id'), 'btn' => 'Attach', 'backUrl' => route('assign_role.index')])
            </form>
        </div>
    </div>
@endsection
