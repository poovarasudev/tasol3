@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">Users</h2>
            </div>
            @can('roles.create')
                <div class="col-auto">
                    <a type="button" class="btn btn-primary text-white" href="{{ route('users.create') }}">
                        <span class="fe fe-plus fe-16 mr-3"></span>Add User
                    </a>
                </div>
            @endcan
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table datatables" id="datatable-id">
                            <thead>
                            <tr>
                                <th><strong>Id</strong></th>
                                <th><strong>Name</strong></th>
                                <th><strong>Team</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Phone</strong></th>
                                <th><strong>Breakfast</strong></th>
                                <th><strong>Lunch</strong></th>
                                <th><strong>Action</strong></th>
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
    @include('common.common_index_page_script')
    <script>
        $(function () {
            $('#datatable-id').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('users.datatable') !!}',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'team.name'},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'breakfast', 'orderable': false, 'searchable':false},
                    {data: 'lunch', 'orderable': false, 'searchable':false},
                    {data: 'action', 'orderable': false, 'searchable':false},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        className: 'text-center'
                    },
                    {
                        targets: -2,
                        className: 'text-center'
                    },
                    {
                        targets: -3,
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
    </script>
@endsection
