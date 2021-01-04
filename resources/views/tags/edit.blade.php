@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <div>
        @include('tags.common_input_fields', ['tag' => $tag])
    </div>
@endsection
