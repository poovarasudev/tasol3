@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
    <div class="col-12">
        <h2 class="page-title">Create Tag</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('tags.store') }}">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            @include('tags.common_input_fields', ['tag' => null])
                            <div class="form-group mb-2 text-right">
                                <a href="{{ url('/tags') }}" type="submit" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
