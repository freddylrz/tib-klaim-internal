@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('img/tib_logo_outline.png') }}" style="width: 50%; height: auto;">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="username" type="text"
                                        class="form-control {{ $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username" value="{{ old('username') }}" required autofocus
                                        placeholder="Username">
                                    <div class="input-group-append bg-gray text-white">
                                        <div class="input-group-text">
                                            <span class="fas fa-user text-light" style="width: 14px"></span>
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required placeholder="Password">
                                    <div class="input-group-append bg-gray text-white">
                                        <div class="input-group-text">
                                            <span id="togglePassword" class="fas fa-eye text-light"
                                                style="width: 14px;cursor: pointer"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
