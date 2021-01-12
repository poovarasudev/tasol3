@extends('layouts.app')

@section('title', 'Role Details')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Role Details</h2>
        <div class="card shadow mb-4">
            <form>
                <div class="card-header">
                    <strong class="card-title">'{{ $role->name }}' 's Details</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" disabled value="{{ $role->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            @php
                                $permissions = $role->permissions->pluck('name')->toArray() ?? [];
                                $permissions = array_map('formattedPermissionName', $permissions);
                            @endphp
                            <div class="form-group mb-3">
                                <label>Permissions</label>
                                @if(isEmptyArray($permissions))
                                    <input type="text" class="form-control" disabled value="No Permissions Attached to this Role">
                                @else
                                    @foreach($permissions as $permission)
                                        <div class="pb-20-px">
                                            <input type="text" class="form-control" disabled value="{{ $permission }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group mb-3 text-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
