@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">Roles</h2>
            </div>
            @can('roles.create')
                <div class="col-auto">
                    <a type="button" class="btn btn-primary text-white" href="{{ route('roles.create') }}">
                        <span class="fe fe-plus fe-16 mr-3"></span>Add Role
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
                                <th><strong>Role Name</strong></th>
                                <th><strong>Permission Count</strong></th>
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
                ajax: '{!! route('roles.datatable') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'permissions_count', name: 'permissions_count', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        className: 'text-center'
                    },
                    {
                        targets: -2,
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
