@extends('layouts.app_empty')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <div>
                    <div><a class="logo" href="{{ route('home.view') }}"><img class="img-fluid for-light"
                                src="{{ asset('assets/images/logo/login.png') }}" alt="looginpage"><img
                                class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                alt="looginpage"></a></div>
                    <div class="login-main">

                        @error('error')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i data-feather="alert-circle"></i> {{ $message }}
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        @enderror

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <i data-feather="alert-circle"></i> {{ $message }}
                            </div>
                        @endif
                        <form class="theme-form" action="{{ route('auth.login.action') }}" method="POST">
                            @csrf
                            <h4>Sign in</h4>
                            <p>Silahkan masukkan username dan password untuk masuk.</p>
                            <div class="form-group">
                                <label class="col-form-label">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" type="text" name="username"
                                    placeholder="Masukkan Username Anda.">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" 
                                    placeholder="*********">
                                <div class="show-hide"><span class="show"> </span></div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Ingat Saya</label>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
