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
        $("#buttonCardPopUp").click(function() {
            if ($("#cardPopUp").hasClass("maximized-card")) {
                $("#bodyCardPopUp").css("display", "none");
            } else {
                setTimeout(function() {
                    $("#bodyCardPopUp").css("display", "block");
                }, 500);
            }
        });
    });
</script>
@endsection

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Package</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bee.index') }}">Bee</a></li>
            <li class="breadcrumb-item active">Package</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card card-warning card-outline">
    <div class="card-header">
        <h3 class="card-title">Package List</h3>
    </div>
    <div class="card-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Code</th>
                    <th style="width: 2%">Count</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyHistory as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user_data->name }}</td>
                    <td>
                        @if ($item->bee->count())
                        <div id="cardPopUp" class="card card-warning"
                            style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->code }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="buttonCardPopUp"
                                        data-card-widget="maximize">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div id="bodyCardPopUp" class="card-body table-responsive" style="display:none">
                                <table id="table1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>QR</th>
                                            <th>Buy From</th>
                                            <th>Sell In</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->bee as $indexBee => $itemBee)
                                        <tr>
                                            <td>{{ $indexBee + 1 }}</td>
                                            <td>{{ $itemBee->code }}</td>
                                            <td>{{ $itemBee->pin }}</td>
                                            <td>{{ $itemBee->buy }}</td>
                                            <td>{{ $itemBee->sell }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        @else
                        {{ $item->code }}
                        @endif
                    </td>
                    <td>{{ $item->count }}</td>
                    @if ($item->status == 0)
                    <td class="text-center">
                        <span class="badge bg-warning">Wait To Procuress</span>
                    </td>
                    @elseif ($item->status == 4)
                    <td class="text-center">
                        <span class="badge bg-danger">Cancel</span>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="badge bg-success">Use By {{ $item->user_data->name }}</span>
                    </td>
                    @endif
                    <td>
                        @if ($item->status == 0)
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('bee.history.update', [$item->id, 1, $item->count, $item->user_data->id, $item->code]) }}"
                                    class='btn btn-block btn-success btn-sm'>Approved</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('bee.history.update', [$item->id, 4, $item->count, $item->user_data->id, $item->code]) }}"
                                    class='btn btn-block btn-danger btn-sm'>Cancel</a>
                            </div>
                        </div>
                        @elseif($item->status == 4)
                        <span class="btn btn-block btn-danger btn-sm disabled">Cancel</span>
                        @else
                        <button type="button" class="btn btn-block btn-success btn-sm disabled">Accepted</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
