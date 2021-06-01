@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pengguna</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Pengguna</li>
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
                        <h5>Data Pengguna </h5>
                        <span>Berikut <code>list data akun / pengguna</code> yang dapat mengakses aplikasi ini.
                            <code></code></span>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Nama Lengkap</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ ++$index }}</th>
                                                    <td>{{ $item->username }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>@mdo</td>
                                                    <td>
                                                        <a href="{{ route('users.edit', $item->id) }}"
                                                            class="btn btn-success btn-xs"><i data-feather="edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-xs"><i
                                                                data-feather="trash-2"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <th scope="row" style="text-align: center" colspan="5">-- Belum ada data
                                                        --</th>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
