@extends('layouts.app')

@section('endCSS')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('endJS')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('#copy').click(function(){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('#massage').text()).select();
        document.execCommand("copy");
        $temp.remove();
        Toast.fire({
        type: 'success',
        title: $('#massage').text()
        })
    });
</script>
@if($chart)
{!! $chart->script() !!}
@endif
@endsection

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Home</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            {{-- <li class="breadcrumb-item active">Blank Page</li> --}}
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div id="copy" class="btn btn-block callout callout-success swalDefaultSuccess">
            <h5>Refreal</h5>
            <p id="massage">{{ route('ref', Auth::user()->username) }}</p>
            <p><small>Tekan untuk Mengcopi refreal</small></p>
        </div>
    </div>
    <div class="col-md-6">
        <form class="form-horizontal" action="{{ route('bee.history.store') }}" method="POST">
            @csrf
            <div class="card card-warning card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Pesan Stup</h3>
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
                            Jumlah Stup yang di pesan
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
                    <button type="submit" class="btn btn-warning">Pesan Stup</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">Data Pertahun</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    {!! $chart->container() !!}
                </div>
                <!-- /.chart-responsive -->
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-4 col-4">
                        <div class="description-block border-right">
                            <span class="description-percentage {{ $countBee["text"] }}">
                                <i class="{{ $countBee["icon"] }}"></i>
                                {{ $countBee["percent"] }}%
                            </span>
                            <h5 class="description-header">$35,210.43</h5>
                            <span class="description-text">Jumlah Kandang Terjual</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-4">
                        <div class="description-block border-right">
                            <span class="description-percentage {{ $income["text"] }}">
                                <i class="{{ $income["icon"] }}"></i>
                                {{ $income["percent"] }}%
                            </span>
                            <h5 class="description-header">$10,390.90</h5>
                            <span class="description-text">Pemasukan</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-4">
                        <div class="description-block">
                            <span class="description-percentage {{ $outcome["text"] }}">
                                <i class="{{ $outcome["icon"] }}"></i>
                                {{ $outcome["percent"] }}%
                            </span>
                            <h5 class="description-header">1200</h5>
                            <span class="description-text">Pengeluaran</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
