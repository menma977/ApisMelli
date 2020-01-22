@extends('layouts.app')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Withdraw</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    Withdraw
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Withdraw</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item">
                    <a class="nav-link active" href="#tab_1" data-toggle="tab">
                        List Request
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab_2" data-toggle="tab">
                        List
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <table id="list" class="table table-bordered table-striped">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 10px">#</th>
                            <th style="width: 150px">User</th>
                            <th style="width: 300px">Total Withdraw</th>
                            <th style="width: 20px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requestWithdraw as $item)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('withdraw.update', [base64_encode($item->id), base64_encode(1)]) }}"
                                           class="btn btn-sm btn-success">
                                            Termia
                                        </a>
                                        <a href="{{ route('withdraw.update', [base64_encode($item->id), base64_encode(2)]) }}"
                                           class="btn btn-sm btn-danger">
                                            Batalkan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_2">
                    <table id="list2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 150px">User</th>
                            <th style="width: 300px">Total Withdraw</th>
                            <th style="width: 20px">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraw as $item)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-danger">Withdraw</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('endCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('endJS')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $("#list").DataTable();
            $("#list2").DataTable();
        });
    </script>
@endsection
