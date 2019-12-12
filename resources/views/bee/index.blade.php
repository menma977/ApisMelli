@extends('layouts.app')

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
        $("#table").DataTable();
        $("#table1").DataTable();
    });
</script>
@endsection

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Bee</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Bee</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
@admin
<div class="col-md-6">
    <form class="form-horizontal" action="{{ route('bee.store') }}" method="POST">
        @csrf
        <div class="card card-warning card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Buat QR Baru</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        @error('stupe')
                        <i class="fas fa-minus"></i>
                        @else
                        <i class="fas fa-plus"></i>
                        @enderror
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" @error('stupe') style="display: block;" @else style="display: none;" @enderror>
                <div class="form-group">
                    <label for="stupe">
                        @error('stupe')<i class="far fa-times-circle text-danger"></i>@enderror
                        Jumlah Stup yang di Buat
                    </label>
                    <input type="number" class="form-control @error('stupe') is-invalid @enderror" id="stupe"
                        name="stupe" value="{{ old("stupe") }}" placeholder="0000">
                    @error('stupe')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer" @error('stupe') style="display: block;" @else style="display: none;" @enderror>
                <button type="submit" class="btn btn-warning">Buat</button>
            </div>
        </div>
    </form>
</div>
@endadmin
<div class="card card-warning card-outline">
    <div class="card-header">
        <h3 class="card-title">QR Code List</h3>
    </div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Send</th>
                    <th>Code</th>
                    <th>QR</th>
                    <th>Buy From</th>
                    <th>Sell In</th>
                    <th style="width: 10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bee as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user_data ? $item->user_data->name : "Not use" }}</td>
                    <td>{{ $item->send ? $item->send->name : "Not use" }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->pin }}</td>
                    <td>{{ $item->buy }}</td>
                    <td>{{ $item->sell }}</td>
                    @if ($item->status == 0)
                    <td class="text-center">
                        <span class="badge bg-success">Order Accepted</span>
                    </td>
                    @elseif($item->status == 1)
                    <td class="text-center">
                        <span class="badge bg-info">Order Came</span>
                    </td>
                    @elseif($item->status == 2)
                    <td class="text-center">
                        <span class="badge bg-warning">Order Processed</span>
                    </td>
                    @elseif($item->status == 3)
                    <td class="text-center">
                        <span class="badge bg-danger">Order Canceled</span>
                    </td>
                    @elseif($item->status == 4)
                    <td class="text-center">
                        <span class="badge bg-warning">Order Waiting Date</span>
                    </td>
                    @elseif($item->status == 5)
                    <td class="text-center">
                        <span class="badge bg-info">QR Take By {{ $item->user_data->name }}</span>
                    </td>
                    @elseif($item->status == 6)
                    <td class="text-center">
                        <span class="badge bg-warning">Not use</span>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="badge bg-success">Order Sell</span>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
