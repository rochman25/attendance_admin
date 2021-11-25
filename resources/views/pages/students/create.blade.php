@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Siswa</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('students.index') }}"> Siswa</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Siswa</li>
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
                        <h5>Data Form Siswa </h5>
                        <span>Untuk menambahkan siswa baru dapat mengisi form <code>data siswa </code> berikut.
                            <code></code></span>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-lg-12">
                                @component('components.alert-danger')
                                @endcomponent
                                <form action="{{ route('students.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">NIS</label>
                                            <input class="form-control @error('nis') is-invalid @enderror" maxlength="10" onkeypress='validate(event)' name="nis" type="text"
                                                value="{{ old('nis') }}" required="">
                                            @error('nis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Nama Lengkap</label>
                                            <input class="form-control @error('name') is-invalid @enderror" onkeypress="return /^[a-zA-Z\s]*$/i.test(event.key)" name="name" type="text"
                                                value="{{ old('name') }}" required="">
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
                                                    <input id="radioinline1" type="radio" name="gender" value="L" required>
                                                    <label class="mb-0" for="radioinline1"><span class="digits"> Laki - Laki</span></label>
                                                </div>
                                                <div class="radio radio-primary">
                                                    <input id="radioinline2" type="radio" name="gender" value="P" required>
                                                    <label class="mb-0" for="radioinline2"><span class="digits"> Perempuan</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer04">Tempat Lahir</label>
                                            <input class="form-control @error('pob') is-invalid @enderror" name="pob" type="text"
                                                value="{{ old('pob') }}" required="">
                                            @error('pob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer05">Tanggal Lahir</label>
                                            <input class="form-control @error('dob') is-invalid @enderror" name="dob" type="date"
                                                value="{{ old('dob') }}" max="{{ date('Y-m-d') }}" required="">
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
@push('scripts')
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
@endpush
