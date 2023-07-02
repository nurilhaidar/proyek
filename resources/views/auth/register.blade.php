<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Register</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ $url_form }}" method="POST">
                    @csrf
                    {!! isset($data) ? method_field('PUT') : '' !!}
                    @isset($data)
                        <input type="hidden" name="username" value="{{ $data->username }}">
                        <input type="hidden" name="name" value="{{ $data->name }}">
                    @endisset
                    <div class="input-group mb-3">
                        <input name="username" type="text" class="form-control" placeholder="Username"
                            value="{{ isset($data) ? $data->username : '' }}" {{ isset($data) ? 'disabled' : '' }}>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Name"
                            value="{{ isset($data) ? $data->name : '' }}" {{ isset($data) ? 'disabled' : '' }}>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <select name="role" class="form-control"
                            {{ Auth::user()->role !== 1 ? 'disabled' : 'minj' }}>
                            <option value=""></option>
                            <option value="1" {{ isset($data) ? ($data->role == 1 ? 'selected' : '') : '' }}>
                                Super Admin
                            </option>
                            <option value="2" {{ isset($data) ? ($data->role == 2 ? 'selected' : '') : '' }}>
                                Admin
                            </option>
                        </select>
                        @error('role')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
