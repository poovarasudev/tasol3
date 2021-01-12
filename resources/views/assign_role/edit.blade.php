@extends('layouts.app')

@section('title', 'Update Attached Role')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update Attached Role</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('assign_role.update', $user->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $user->name }}'</strong>
                </div>
                @php $oldRoleId = old('role_id') ?? $user->roles->first()->id; @endphp
                @include('assign_role.common_input_fields', ['oldRoleId' => $oldRoleId, 'btn' => 'Update', 'backUrl' => route('assign_role.index')])
            </form>
        </div>
    </div>
@endsection
