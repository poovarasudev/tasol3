@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-4">
            <div class="col">
                <h2 class="h3 mb-0 page-title">Contacts</h2>
            </div>
        </div>
        <div class="row">
            @foreach($contacts as $contact)
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body text-center">
                            <div class="avatar avatar-lg mt-4">
                                <a href="javascript:void(0);">
                                    <img src="{{ $contact->photo }}" alt="{{ $contact->name }}" class="avatar-img rounded-circle">
                                </a>
                            </div>
                            <div class="card-text my-2">
                                <strong class="card-title my-0">{{ $contact->name }}</strong>
                                <p class="small text-muted mb-0">{{ $contact->email }}</p>
                                <p class="small text-muted mb-0">{{ $contact->phone }}</p>
                                <p class="small"><span class="badge badge-dark">{{ formatTeamName($contact->team->name) }}</span></p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <small><span class="dot dot-lg mr-1 @if($contact->breakfast) bg-success @else bg-danger @endif"></span>Breakfast</small>
                                </div>
                                <div class="col-auto">
                                    <small><span class="dot dot-lg mr-1 @if($contact->lunch) bg-success @else bg-danger @endif"></span>Lunch</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Contacts" class="my-3">
            <ul class="pagination justify-content-end mb-0">
                <li class="page-item @if(!$contacts->previousPageUrl()) disabled @endif">
                    <a class="page-link" href="{{ $contacts->previousPageUrl() }}">Previous</a>
                </li>
                @for($i = 1; $i <= $contacts->lastPage(); $i++)
                    <li class="page-item @if($contacts->currentPage() == $i) active @endif">
                        <a class="page-link" href="{{ route('contacts', ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item @if(!$contacts->nextPageUrl()) disabled @endif">
                    <a class="page-link" href="{{ $contacts->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
