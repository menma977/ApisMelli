@extends('layouts.app')

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Password</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.show') }}">Profile</a></li>
            <li class="breadcrumb-item active">Password</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card card-warning card-outline">
    <!-- form start -->
    <form class="form-horizontal" action="{{ route('user.password.update') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label" for="password">
                    @error('password')<i class="far fa-times-circle text-danger"></i>@enderror
                    Password lama
                </label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password lama">
                @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="col-form-label" for="passwordNew">
                    @error('passwordNew')<i class="far fa-times-circle text-danger"></i>@enderror
                    Password Baru
                </label>
                <input type="password" class="form-control @error('passwordNew') is-invalid @enderror" id="passwordNew"
                    name="passwordNew" placeholder="Password Baru">
                @error('passwordNew')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="col-form-label" for="passwordNewConfirmation">
                    @error('passwordNewConfirmation')<i class="far fa-times-circle text-danger"></i>@enderror
                    Konfirmasi Password Baru
                </label>
                <input type="password" class="form-control @error('passwordNewConfirmation') is-invalid @enderror"
                    id="passwordNewConfirmation" name="passwordNewConfirmation" placeholder="Konfirmasi Password Baru">
                @error('passwordNewConfirmation')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Update Password</button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
@endsection
