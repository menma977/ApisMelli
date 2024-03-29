@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Profile</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="@admin {{ route('user.index') }} @else # @endadmin">
            @lang('menu.user.index')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.user.show')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="card card-warning card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{ $user->image ? asset($user->image) : asset('dist/img/user.png') }}"
                 alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">
            {{ $user->name }}
          </h3>
          <p class="text-muted text-center">
            {{ $user->username }}
          </p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>
                @lang('menu.user.email')
              </b>
              <a class="float-right">
                {{ $user->email }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                @lang('menu.user.phone')
              </b>
              <a class="float-right">
                {{ $user->phone }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                @lang('menu.user.id card number')
              </b>
              <a class="float-right">
                {{ $user->id_identity_card }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                @lang('menu.user.province')
              </b>
              <a class="float-right">
                {{ $user->province ? $user->province : 'Belum di isi' }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                @lang('menu.user.district')
              </b>
              <a class="float-right">
                {{ $user->district ? $user->district : 'Belum di isi' }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                @lang('menu.user.sub_district')
              </b>
              <a class="float-right">
                {{ $user->sub_district ? $user->sub_district : 'Belum di isi' }}
              </a>
            </li>
            <li class="list-group-item">
              <b>
                Sponsor
              </b>
              <a class="float-right">
                {{ $sponsor->name }}
              </a>
            </li>
          </ul>
{{--          <a href="#" class="btn btn-warning btn-block">--}}
{{--            <b>@lang('menu.edit') @lang('menu.user.index')</b>--}}
{{--          </a>--}}
        </div>
      </div>

      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">@lang('menu.user.address Details')</h3>
        </div>
        <div class="card-body">
          <strong>
            <i class="fas fa-map-marker-alt mr-1"></i>
            @lang('menu.user.address')
          </strong>
          <p class="text-muted">
            {{ $user->village }}
          </p>
          <p class="text-muted">
            {{ $user->number_address }}
          </p>
          <hr>
          <strong>
            <i class="fas fa-map mr-1"></i>
            Deskripsi Alamat
          </strong>
          <p class="text-muted">
            {!! $user->description_address !!}
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="timeline timeline-inverse">
        @foreach($bee as $id => $item)
          <div class="time-label">
            <button type="button" class="btn btn-warning btn-sm">
              <strong>
                {{ \Carbon\Carbon::parse($id)->format('m-Y') }}
              </strong>
            </button>
          </div>
          <div>
            <i class="fas fa-arrow-right bg-warning"></i>
            <div class="timeline-item">

              <h3 class="timeline-header">
                Stup
              </h3>
              <div class="timeline-body table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>@lang('menu.transaction Code')</th>
                    <th>@lang('menu.sent Date')</th>
                    <th>@lang('menu.taken Date')</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($item as $id => $stopList)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $stopList->code }}</td>
                      <td>{{ \Carbon\Carbon::parse($stopList->start)->format('d-m-Y') }}</td>
                      <td>{{ \Carbon\Carbon::parse($stopList->end)->format('d-m-Y') }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endforeach
        @if($bee->count())
          <div>
            <i class="far fa-clock bg-gray"></i>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection