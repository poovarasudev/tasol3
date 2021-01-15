@extends('layouts.app')

@section('title', 'User\'s Role')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">User's Role</h2>
            </div>
            @can('assign_role.create')
                <div class="col-auto">
                    <a type="button" class="btn btn-primary text-white" href="{{ route('assign_role.create') }}">
                        <span class="fe fe-plus fe-16 mr-3"></span>Attach Role
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
                                <th><strong>User Name</strong></th>
                                <th><strong>Role Name</strong></th>
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
                ajax: '{!! route('assign_role.datatable') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'role_name', name: 'role_name'},
                    {data: 'action', name: 'action', searchable: false, orderable: false},
                ],
                columnDefs: [
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
    </script>
@endsection
