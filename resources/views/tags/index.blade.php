@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="col-12">
        <div class="row align-items-center my-3">
            <div class="col">
                <h2 class="page-title">Tags</h2>
            </div>
            <div class="col-auto">
                <a type="button" class="btn btn-primary text-white" href="{{ '/tags/create' }}">
                    <span class="fe fe-plus fe-16 mr-3"></span>Add Tag
                </a>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table datatables" id="dataTable-1">
                            <thead>
                            <tr>
                                <th><strong>Tag</strong></th>
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
    <script>
        $(function () {
            $('#dataTable-1').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                sScrollX: '100%',
                ajax: '{!! route('get.tags') !!}',
                columnDefs: [
                    {targets: [0], width: "800px"},
                    {targets: [1], width: "200px", searchable: false, orderable: false},
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script>
@endsection
