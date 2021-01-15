@extends('layouts.app')

@section('title', 'Update Menu')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Update Menu</h2>
        @include('common.common_validation_error_script')
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('menus.update', $menu->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')
                <div class="card-header">
                    <strong class="card-title">Update '{{ $menu->name }}'</strong>
                </div>
                @include('admin.menus.common_input_fields', ['btn' => 'Update', 'backUrl' => route('admin.menus.index')])
            </form>
        </div>
    </div>
@endsection
