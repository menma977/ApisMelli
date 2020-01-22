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
    @if($withdraw)
        <div class="alert alert-info alert-dismissible">
            <h5>
                <i class="icon fas fa-info"></i>
                Info
            </h5>
            Withdraw Anda sedang di proses oleh admin
        </div>
    @else
        <div class="card card-warning">
            <form class="form-horizontal" action="{{ route('withdraw.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nominal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" placeholder="Nominal">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        @error('nominal')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Proses</button>
                </div>
            </form>
        </div>
    @endif
@endsection
