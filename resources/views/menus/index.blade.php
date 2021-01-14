@extends('layouts.app')

@section('title', 'Menus')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">Menus</h2>
            </div>
            @can('menus.create')
                <div class="col-auto">
                    <a type="button" class="btn btn-primary text-white" href="{{ route('menus.create') }}">
                        <span class="fe fe-plus fe-16 mr-3"></span>Add Menu
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
                                <th><strong>Menu Name</strong></th>
                                <th><strong>Menu For</strong></th>
                                <th><strong>Order Type</strong></th>
                                <th><strong>Bill Type</strong></th>
                                <th><strong>Price (per unit)</strong></th>
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
                ajax: '{!! route('menus.datatable') !!}',
                columns: [
                    {data: 'name'},
                    {data: 'for'},
                    {data: 'order_type'},
                    {data: 'bill_type'},
                    {data: 'price'},
                    {data: 'action', 'orderable': false, 'searchable':false},
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
