@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('img/logo_tib.png') }}" style="width: 50%; height: auto;">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <input id="username" type="text"
                                class="form-control {{ $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('username') }}" required autofocus placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <input id="password" type="password"
                                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span id="togglePassword" class="fas fa-eye"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection

@push('levelPluginsJs')
    <script>
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                var passwordField = $("#password");
                var passwordFieldType = passwordField.attr("type");

                if (passwordFieldType === "password") {
                    passwordField.attr("type", "text");
                    $("#togglePassword").removeClass("fa-eye");
                    $("#togglePassword").addClass("fa-eye-slash");
                } else {
                    passwordField.attr("type", "password");
                    $("#togglePassword").removeClass("fa-eye-slash");
                    $("#togglePassword").addClass("fa-eye");
                }
            });
        });
    </script>
@endpush
