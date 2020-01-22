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
    <div class="row">
        <div class="col-6 text-center">
            <a class="btn btn-app btn-warning" data-toggle="modal" data-target="#modal-list">
                <i class="fas fa-barcode"></i>
                Ceta Barcode
            </a>
        </div>
        <div class="col-6 text-center">
            <a class="btn btn-app" data-toggle="modal" data-target="#modal-sm">
                <i class="fas fa-plus-square"></i>
                Stup Baru
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div id="accordion">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <button type="button" class="btn btn-block btn-warning btn-xs collapsed" data-toggle="collapse"
                                data-parent="#accordion" href="#newSutp" aria-expanded="false">
                            Permintaan Stup Baru
                        </button>
                        @if($stup->where('status', 0)->count())
                            <span
                                class="badge badge-success navbar-badge">{{ $stup->where('status', 0)->count() }}</span>
                        @endif
                    </div>
                    <div id="newSutp" class="panel-collapse in collapse" style="">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">#</th>
                                        <th style="width: 100px">Penerima</th>
                                        <th style="width: 10px">Jumlah</th>
                                        <th style="width: 10px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stup->where('status', 0) as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('bee.update', [base64_encode($item->id), base64_encode(1)]) }}"
                                                       class="btn btn-sm btn-success">
                                                        Terima
                                                    </a>
                                                    <a href="{{ route('bee.update', [base64_encode($item->id), base64_encode(2)]) }}"
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
                        </div>
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-block btn-warning btn-xs collapsed" data-toggle="collapse"
                                data-parent="#accordion" href="#stup" aria-expanded="false">
                            List Stup Sudah Di Prosess
                        </button>
                    </div>
                    <div id="stup" class="panel-collapse in collapse" style="">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list2" class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">#</th>
                                        <th style="width: 100px">Penerima</th>
                                        <th style="width: 10px">Jumlah</th>
                                        <th style="width: 10px">Tanggal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stup->where('status', '!=', 0) as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">List Stup</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 100px">Penerima</th>
                                <th style="width: 10px">QR</th>
                                <th>Code</th>
                                <th>Kirim</th>
                                <th>Ambil</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bees as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                                    <td>
                                        <a href="{{ route('bee.QRCode', base64_encode($item->id)) }}"
                                           class="btn btn-block btn-outline-secondary btn-xs">
                                            QR
                                        </a>
                                    </td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->start }}</td>
                                    <td>{{ $item->end }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Stup</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bee.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="count">Jumlah Stup</label>
                            <input type="text" class="form-control" id="count" placeholder="Jumlah Stup" name="count">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-list">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Ceta QR</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bee.QRCodeList') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="count">Jumlah QR</label>
                            <input type="text" class="form-control" id="count" placeholder="Jumlah Stup" name="count">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('endCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('endJS')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $("#list").DataTable();
            $("#list2").DataTable();
            $('.select2').select2({
                theme: "classic"
            });
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            @error('user')
            Toast.fire({
                type: 'error',
                title: '{{ $message }}'
            });
            @enderror
            @error('count')
            Toast.fire({
                type: 'error',
                title: '{{ str_replace('count', 'jumlah', $message) }}'
            });
            @enderror
        });
    </script>
@endsection
