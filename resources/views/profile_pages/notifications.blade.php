@foreach($notifications as $notification)
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">{{ $notification->title }}</strong>
                    <span class="float-right"><i class="fe fe-clock mr-2"></i><span class="badge badge-pill badge-success text-white mb-1">{{ $notification->human_readable_time }}</span></span>
                </div>
                <div class="card-body">
                    <dl class="row align-items-center mb-0">
                        <dt class="col-sm-2 mb-3 text-muted">Type</dt>
                        <dd class="col-sm-4 mb-3">
                            <strong>{{ $notification->type }}</strong>
                        </dd>
                        <dt class="col-sm-2 mb-3 text-muted">Send At</dt>
                        <dd class="col-sm-4 mb-3">
                            <strong>{{ $notification->created_at->format(DATE_TIME_FORMAT_TWELVE_HOURS) }}</strong>
                        </dd>
                    </dl>
                    <dl class="row mb-0">
                        <dt class="col-sm-2 text-muted">Short Description</dt>
                        <dd class="col-sm-10"><strong>{{ $notification->short_description }}</strong></dd>
                        <dt class="col-sm-2 text-muted">Description</dt>
                        <dd class="col-sm-10">{{ htmlString($notification->description) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endforeach
<nav aria-label="Notification Pagination" class="my-3">
    <ul class="pagination justify-content-center mb-0">
        <li class="page-item @if(!$notifications->previousPageUrl()) disabled @endif">
            <a class="page-link" href="{{ $notifications->previousPageUrl() }}">Previous</a>
        </li>
        @for($i = 1; $i <= $notifications->lastPage(); $i++)
            <li class="page-item @if($notifications->currentPage() == $i) active @endif">
                <a class="page-link" href="{{ route('profile.notifications', ['page' => $i]) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item @if(!$notifications->nextPageUrl()) disabled @endif">
            <a class="page-link" href="{{ $notifications->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
