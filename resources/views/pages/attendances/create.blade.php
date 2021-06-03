@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Presensi</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('attendances.index') }}"> Presensi</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Presensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Form Presensi </h5>
                        <span>Untuk menambahkan presensi baru dapat mengisi form <code>data presensi </code> berikut.
                            <code></code></span>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-lg-12">
                                @component('components.alert-danger')
                                @endcomponent
                                <form action="{{ route('attendances.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Nama Presensi</label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" value="{{ old('name') }}" required="">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Hari</label>
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                                @foreach ($days as $index => $item)
                                                    <div class="checkbox checkbox-dark">
                                                        <input id="inline-{{ $index }}" type="checkbox" name="days[]" value="{{ $item }}">
                                                        <label for="inline-{{ $index }}"><span class="digits"> {{ $item }}</span></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer03">Status</label>
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                <div class="radio radio-primary">
                                                    <input id="radioinline1" type="radio" name="status" value="1"
                                                        required>
                                                    <label class="mb-0" for="radioinline1"><span class="digits">
                                                            Aktif</span></label>
                                                </div>
                                                <div class="radio radio-primary">
                                                    <input id="radioinline2" type="radio" name="status" value="0"
                                                        required>
                                                    <label class="mb-0" for="radioinline2"><span class="digits"> Tidak
                                                            Aktif</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer04">Waktu Masuk</label>
                                            <input class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                                                type="time" value="{{ old('check_in') }}" required="">
                                            @error('check_in')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-md-3 mb-3">
                                            <label for="validationServer05">Waktu Keluar</label>
                                            <input class="form-control @error('check_out') is-invalid @enderror" name="check_out"
                                                type="time" value="{{ old('check_out') }}" required="">
                                            @error('check_out')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
