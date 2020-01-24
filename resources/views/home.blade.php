@extends('layouts.app')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Home</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-user-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User Active</span>
                    <div class="info-box-number" id="onlineUserCount">0</div>
                    <div class="progress">
                        <div class="progress-bar" id="onlineUser" style="width: 0"></div>
                    </div>
                    <div class="progress-description" id="onlineDescriptionPercent">
                        0%
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-user-alt-slash"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User Offline</span>
                    <div class="info-box-number" id="offlineUserCount">0</div>
                    <div class="progress">
                        <div class="progress-bar" id="offlineUser" style="width: 0"></div>
                    </div>
                    <div class="progress-description" id="offlineDescriptionPercent">
                        0%
                    </div>
                </div>
            </div>
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
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                            <span class="description-percentage {{ $income["text"] }}">
                                <i class="{{ $income["icon"] }}"></i>
                                {{ $income["percent"] }}%
                            </span>
                                <h5 class="description-header">Rp {{ number_format($CountIncome, 0, ',', '.') }}</h5>
                                <span class="description-text">Pemasukan</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div class="description-block">
                            <span class="description-percentage {{ $outcome["text"] }}">
                                <i class="{{ $outcome["icon"] }}"></i>
                                {{ $outcome["percent"] }}%
                            </span>
                                <h5 class="description-header">Rp {{ number_format($CountOutcome, 0, ',', '.') }}</h5>
                                <span class="description-text">Pengeluaran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

        $('#copy').click(function () {
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
    <script>
        $(function () {
            fetch('{{ route('config.isOnlineStatus') }}').then((response) => {
                return response.json();
            }).then((json) => {
                $("#onlineUserCount").html(json.online);
                let percentOnline = (json.online / json.count) * 100;
                $("#onlineUser").css({"width": percentOnline + "%"});
                $("#onlineDescriptionPercent").html(percentOnline.toFixed(2) + "% Online User");

                $("#offlineUserCount").html(json.offline);
                let percentOffline = (json.offline / json.count) * 100;
                $("#offlineUser").css({"width": percentOffline + "%"});
                $("#offlineDescriptionPercent").html(percentOffline.toFixed(2) + "% Offline User");
            });

            setInterval(function () {
                fetch('{{ route('config.isOnlineStatus') }}').then((response) => {
                    return response.json();
                }).then((json) => {
                    $("#onlineUserCount").html(json.online);
                    let percentOnline = (json.online / json.count) * 100;
                    $("#onlineUser").css({"width": percentOnline + "%"});
                    $("#onlineDescriptionPercent").html(percentOnline.toFixed(2) + "% Online User");

                    $("#offlineUserCount").html(json.offline);
                    let percentOffline = (json.offline / json.count) * 100;
                    $("#offlineUser").css({"width": percentOffline + "%"});
                    $("#offlineDescriptionPercent").html(percentOffline.toFixed(2) + "% Offline User");
                });
            }, 5000);
        });
    </script>
@endsection
