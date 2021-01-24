@extends('layouts.app')

@section('title', 'Days')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">Days</h2>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table datatables" id="datatable-id">
                            <thead>
                            <tr>
                                <th><strong>Day</strong></th>
                                <th><strong>Breakfast</strong></th>
                                <th><strong>Lunch</strong></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('#datatable-id').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('days.datatable') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'breakfast', name: 'breakfast'},
                    {data: 'lunch', name: 'lunch'},
                ],
                columnDefs: [
                    {
                        targets: -2,
                        className: 'text-center'
                    },
                    {
                        targets: -1,
                        className: 'text-center'
                    }
                ],
                language: {
                    lengthMenu: '<span>Show:</span> _MENU_',
                    zeroRecords: "No Records Found",
                    infoEmpty: "No Records Available",
                },
            });
        });

        function updateDayDetail(url, type, text) {
            var displayType = type.charAt(0).toUpperCase() + type.slice(1);
            swal({
                title: "Are you sure to " + text + ' ' + displayType+ "?",
                text: "Please Confirm !!!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willUpdate) => {
                    if (willUpdate) {
                        $(".page-loader").show();
                        $.ajax({
                            url: url,
                            method: 'PATCH',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'key': type
                            },
                            success: function (response) {
                                $(".page-loader").hide();
                                swal({
                                    title: displayType + ' ' + text + "d Successfully!",
                                    text: " ",
                                    icon: "success",
                                    buttons: false,
                                });
                                swal.close();
                                location.reload();
                            },
                            error: function (response) {
                                $(".page-loader").hide();
                                var msg = response.responseJSON.message;
                                swal({
                                    title: "Warning!",
                                    text: msg,
                                    icon: "warning",
                                });
                            },
                        });
                    }
                });
        }
    </script>
@endsection
