@extends('layouts.app')

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Home</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-warning card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ $user->image ? asset('dist/img/'.$user->image) : asset('dist/img/user2-160x160.jpg') }}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->rule == 0 ? "Admin" : "Member" }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Jumlah Stup</b> <a class="float-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Saldo</b> <a class="float-right">543</a>
                    </li>
                </ul>
                <a href="#" class="btn btn-warning btn-block"><b>Edit</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Data Diri</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="far fa-user-circle mr-1"></i> Username</strong>
                <p class="text-muted">
                    {{ $user->username }}
                </p>
                <hr>
                <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted">
                    {{ $user->email }}
                </p>
                <hr>
                <strong><i class="fas fa-phone mr-1"></i> Nomor Telfon</strong>
                <p class="text-muted">
                    {{ $user->phone }}
                </p>
                <hr>
                <strong><i class="fa fa-globe mr-1"></i> Provinsi</strong>
                <p class="text-muted">
                    {{ $user->province }}
                </p>
                <hr>
                <strong><i class="fas fa-building mr-1"></i> Kabupaten</strong>
                <p class="text-muted">
                    {{ $user->district }}
                </p>
                <hr>
                <strong><i class="fas fa-map-signs mr-1"></i> Kecamatan</strong>
                <p class="text-muted">
                    {{ $user->sub_district }}
                </p>
                <hr>
                <strong><i class="fas fa-map-marker mr-1"></i> Desa</strong>
                <p class="text-muted">
                    {{ $user->village }}
                </p>
                <hr>
                <strong><i class="fas fa-map-marker mr-1"></i> No Rumah</strong>
                <p class="text-muted">
                    {{ $user->number_address }}
                </p>
                <hr>
                <strong><i class="fas fa-map-map mr-1"></i> No Rumah</strong>
                <p class="text-muted">
                    {{ $user->description_address }}
                </p>
                <hr>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-9">
        <div class="timeline">
            @foreach ($object as $item)
            <div class="time-label">
                <span class="bg-warning">{{ $item["date"] }}</span>
            </div>
            {{-- buy ledger --}}
            @if ($item["ledger"])
            <div>
                <i class="fas fa-play bg-warning"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $item["time"] }}</span>
                    @if ($item["ledger"]->type == 0)
                    <h3 class="timeline-header text-success">Ledger Income</h3>
                    <div class="timeline-body">
                        <div class="input-group col-sm-12 col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <div class="form-control text-center">{{ $item["ledger"]->debit }}</div>
                            <div class="input-group-append">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <hr>
                        <p>{!! $item["ledger"]->description !!}</p>
                    </div>
                    @endif
                    @if ($item["ledger"]->type == 1)
                    <h3 class="timeline-header text-info">Ledger Outcome</h3>
                    <div class="timeline-body">
                        <div class="input-group col-sm-12 col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <div class="form-control text-center">{{ $item["ledger"]->credit }}</div>
                            <div class="input-group-append">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <hr>
                        <p>{!! $item["ledger"]->description !!}</p>
                    </div>
                    @endif
                    @if ($item["ledger"]->type == 2)
                    <h3 class="timeline-header text-primary">Ledger Bonus</h3>
                    <div class="timeline-body">
                        <div class="input-group col-sm-12 col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <div class="form-control text-center">{{ $item["ledger"]->debit }}</div>
                            <div class="input-group-append">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <hr>
                        <p>{!! $item["ledger"]->description !!}</p>
                    </div>
                    @endif
                    @if ($item["ledger"]->type == 3)
                    <h3 class="timeline-header text-warning">Ledger Withdraw</h3>
                    <div class="timeline-body">
                        <div class="input-group col-sm-12 col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <div class="form-control text-center">{{ $item["ledger"]->credit }}</div>
                            <div class="input-group-append">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <hr>
                        <p>{!! $item["ledger"]->description !!}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            {{-- buy ledger --}}
            {{-- buy history --}}
            @if ($item["buyHistory"])
            <div>
                <i class="fas fa-play bg-warning"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $item["time"] }}</span>
                    <h3 class="timeline-header">Bee</h3>
                    <div class="timeline-body table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 15%" class="text-center">
                                        code
                                    </th>
                                    <th style="width: 30%" class="text-center">
                                        Tanggal Pembelian
                                    </th>
                                    <th style="width: 30%" class="text-center">
                                        Tanggal Pengambilan
                                    </th>
                                    <th style="width: 50%" class="text-center">
                                        Process
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item["buyHistory"]->bee as $subItem)
                                <tr>
                                    <td class="text-center">
                                        {{ $subItem->code }}
                                    </td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($subItem->buy)->format("d/m/Y") }}
                                    </td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($subItem->sell)->format("d/m/Y") }}
                                    </td>
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-green" role="progressbar"
                                                aria-volumenow="{{ $subItem->percent }}" aria-volumemin="0"
                                                aria-volumemax="100" style="width: {{ $subItem->percent }}%">
                                            </div>
                                        </div>
                                        <small>
                                            {{ $subItem->percent }}% Complete
                                        </small>
                                    </td>
                                    <td class="project-state">
                                        @if ($subItem->status == 0)
                                        <span class="badge badge-success">Orders Accepted</span>
                                        @elseif($subItem->status == 1)
                                        <span class="badge badge-info">Order Came</span>
                                        @elseif($subItem->status == 2)
                                        <span class="badge badge-warning">Order Processed</span>
                                        @elseif($subItem->status == 3)
                                        <span class="badge badge-danger">Order Canceled</span>
                                        @elseif($subItem->status == 4)
                                        <span class="badge badge-warning">Order Waiting Date</span>
                                        @elseif($subItem->status == 5)
                                        <span class="badge badge-primary">Order Take</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            {{-- buy history --}}
            @endforeach
        </div>
    </div>
</div>
@endsection
