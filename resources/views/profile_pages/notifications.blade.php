@if($notification)
    @include('profile_pages.common_notification_card')
@else
    @foreach($notifications as $notification)
        @include('profile_pages.common_notification_card')
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
@endif
