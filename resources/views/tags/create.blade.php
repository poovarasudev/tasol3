@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
    <div>
        @include('tags.common_input_fields', ['tag' => null])
    </div>
@endsection
