@extends('layouts.app')

@section('title', 'Create Menu')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create Menu</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('menus.store') }}">
                {!! csrf_field() !!}
                <div class="card-header">
                    <strong class="card-title">Create a New Menu here</strong>
                </div>
                @include('menus.common_input_fields', ['menu' => null, 'btn' => 'Create', 'backUrl' => route('menus.index')])
            </form>
        </div>
    </div>
@endsection
