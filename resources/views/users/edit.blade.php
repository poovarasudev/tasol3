@extends('layouts.app')

@section('title', 'Update User')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update User</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $user->name }}'</strong>
                </div>
                @include('users.common_input_fields', ['btn' => 'Update', 'backUrl' => route('users.index')])
            </form>
        </div>
    </div>
@endsection
