@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Role</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Role</li>
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
                    <h5>Data Role </h5>
                    <span>Berikut <code>list data role pengguna</code> aplikasi ini.
                        <code></code></span>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $index => $item)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.edit',$item->id) }}" class="btn btn-success btn-xs"><i data-feather="edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs"><i data-feather="trash-2"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th scope="row" style="text-align: center" colspan="5">-- Belum ada data --</th>
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
@endsection