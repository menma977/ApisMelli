@extends('layouts.login')

@section('endCSS')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('endJS')
  <!-- bs-custom-file-input -->
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
      $(function () {
          $('#province').select2();
          $('#district').select2();
          $('#subDistrict').select2();
          bsCustomFileInput.init();
      });
  </script>
@endsection

@section('content')
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register a new membership</p>
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                 name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
                 placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('username')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                 value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-envelope"></div>
            </div>
          </div>
          @error('email')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                 name="password" value="{{ old('password') }}" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-lock"></div>
            </div>
          </div>
          @error('password')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password-confirm" type="password"
                 class="form-control @error('password_confirmation') is-invalid @enderror"
                 name="password_confirmation" value="{{ old('password_confirmation') }}" required
                 placeholder="Password Confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-lock"></div>
            </div>
          </div>
          @error('password_confirmation')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mp-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="ktp" name="ktp">
            <label class="custom-file-label" for="ktp">Upload KTP</label>
          </div>
        </div>

        <div class="input-group mb-3">
          <label>Province</label>
          <select id="province" name="province" class="form-control select2" style="width: 100%;" required>
            @foreach (App\model\Province::all() as $item)
              <option value="{{ $item->code }}">{{ $item->name }}</option>
            @endforeach
          </select>
          @error('province')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <label>District</label>
          <select id="district" name="district" class="form-control select2" style="width: 100%;" required>
            @foreach (App\model\District::all() as $item)
              <option value="{{ $item->code }}">{{ $item->name }}</option>
            @endforeach
          </select>
          @error('district')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <label>Sub District</label>
          <select id="subDistrict" name="subDistrict" class="form-control select2" style="width: 100%;" required>
            @foreach (App\model\SubDistrict::all() as $item)
              <option value="{{ $item->code }}">{{ $item->name }}</option>
            @endforeach
          </select>
          @error('district')
          <div class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>

        <hr>
        <button type="submit" class="btn btn-warning">Register</button>
        <a href="{{ route('login') }}" class="btn btn-default float-right">Back</a>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
