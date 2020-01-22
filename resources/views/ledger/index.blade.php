@extends('layouts.app')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Ledger</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    Ledger
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Ledger</h3>
        </div>
        <div class="card-body">
            <table id="list" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>User</th>
                    <th>Code</th>
                    <th style="width: 500px">Deskripsi</th>
                    <th style="width: 200px">Debit</th>
                    <th style="width: 200px">Credit</th>
                    <th style="width: 10px">Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ledger as $item)
                    <tr class="text-center">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->description }}</td>
                        <td>Rp {{ number_format($item->debit, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->credit, 0, ',', '.') }}</td>
                        @if($item->ledger_type == 0)
                            <td>
                                <span class="badge bg-success">In Come</span>
                            </td>
                        @elseif($item->ledger_type == 1)
                            <td>
                                <span class="badge bg-warning">Out Come</span>
                            </td>
                        @elseif($item->ledger_type == 2)
                            <td>
                                <span class="badge bg-info">Bonus</span>
                            </td>
                        @else
                            <td>
                                <span class="badge bg-danger">Withdraw</span>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
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
        });
    </script>
@endsection
