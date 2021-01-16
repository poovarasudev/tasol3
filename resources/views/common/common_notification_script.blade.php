<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" onclick="location.href='{{ route("profile.notifications") }}'">All Notifications</button>
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
            </div>
        </div>
    </div>
</div>

<script>
    let response;
    function showNotifications() {
        $(".page-loader").show();
        $.ajax({
            url: '{{ route('get.notifications') }}',
            method: 'GET',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function (test) {
                $(".list-group-flush").empty();
                $('.modal-notif').modal('show');
                response = test;
                if (response.data.length > 0) {
                    $.each(response.data, function(index, notification) {
                        $('.list-group-flush').append('<div class="list-group-item bg-transparent"><div class="row align-items-center">' +
                            '<div class="col-auto"><span class="fe ' + notification.icon + ' fe-24"></span></div><div class="col"><small>' +
                            '<strong>' + notification.title + '</strong></small><div class="my-0 text-muted small">' + notification.short_description + '</div>' +
                            '<small class="badge badge-pill badge-light text-muted">' + notification.human_readable_time + '</small></div> </div></div>');
                    });
                } else {
                    $('.list-group-flush').append('<div class="list-group-item bg-transparent"><b>No New Notifications Available</b></div>');
                }
                $(".page-loader").hide();
            },
            error: function (response) {
                $(".page-loader").hide();
                $('.modal-notif').modal('hide');
                var msg = response.responseJSON.message;
                swal({
                    title: "Warning!",
                    text: msg,
                    icon: "warning",
                });
            },
        });
    }
</script>
