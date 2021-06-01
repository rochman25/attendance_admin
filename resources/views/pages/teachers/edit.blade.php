@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Guru</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}"> Guru</a>
                        </li>
                        <li class="breadcrumb-item active">Ubah Guru</li>
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
                        <h5>Data Form Guru </h5>
                        <span>Untuk ubah guru dapat mengisi form <code>data guru </code> berikut.
                            <code></code></span>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-lg-12">
                                @component('components.alert-danger')
                                @endcomponent
                                <form action="{{ route('teachers.update',$teacher->id) }}" method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="PUT">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">NIP</label>
                                            <input class="form-control @error('nip') is-invalid @enderror" name="nip" type="text"
                                                value="{{ old('nip',$teacher->nip) }}" required="">
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Nama Lengkap</label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                                value="{{ old('name',$teacher->name) }}" required="">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer03">Jenis Kelamin</label>
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                <div class="radio radio-primary">
                                                    <input id="radioinline1" type="radio" name="gender" value="L" @if($teacher->gender == "L") checked @endif required>
                                                    <label class="mb-0" for="radioinline1"><span class="digits"> Laki - Laki</span></label>
                                                </div>
                                                <div class="radio radio-primary">
                                                    <input id="radioinline2" type="radio" name="gender" value="P" @if($teacher->gender == "P") checked @endif required>
                                                    <label class="mb-0" for="radioinline2"><span class="digits"> Perempuan</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer04">Tempat Lahir</label>
                                            <input class="form-control @error('pob') is-invalid @enderror" name="pob" type="text"
                                                value="{{ old('pob',$teacher->pob) }}" required="">
                                            @error('pob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer05">Tanggal Lahir</label>
                                            <input class="form-control @error('dob') is-invalid @enderror" name="dob" type="date"
                                                value="{{ old('dob',$teacher->dob) }}" required="">
                                            @error('dob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
