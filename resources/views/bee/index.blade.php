@extends('layouts.app')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>List Stup</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    Stup
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning">
                    <i class="fas fa-boxes"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Stup</span>
                    <span class="info-box-number">{{ $bees->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning">
                    <i class="fas fa-box"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Stup Terjual</span>
                    <span class="info-box-number">{{ $bees->where('user', '!=', null)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning">
                    <i class="fas fa-box-open"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Terjual</span>
                    <span class="info-box-number">{{ $bees->where('user', null)->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">List Stup</h3>
            <button type="button" class="btn btn-success btn-xs float-right">Buat Stup Baru</button>
        </div>
        <div class="card-body">
            <table id="list" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Pemilik</th>
                    <th>QR</th>
                    <th>Code</th>
                    <th>Di Kirim Tanggal</th>
                    <th>Di Ambil Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bees as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="{{ route('bee.QRCode', base64_encode($item->id)) }}" class="btn btn-block btn-outline-secondary btn-xs">
                                QR
                            </a>
                        </td>
                        <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->start }}</td>
                        <td>{{ $item->end }}</td>
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
