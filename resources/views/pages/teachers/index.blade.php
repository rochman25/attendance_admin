@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endpush
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
                        <li class="breadcrumb-item active">Guru</li>
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
                        <h5>Data Guru </h5>
                        <span>Berikut <code>list data guru </code>.
                            <code></code></span>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-12" style="margin-bottom: 10px">
                                <a href="{{ route('teachers.create') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Tambah</a>
                                @component('components.alert-success')
                                @endcomponent
                            </div>
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="display datatables" id="data-table-buttons">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">NIP</th>
                                                <th scope="col">Nama Lengkap</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
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
@push('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#data-table-buttons').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('teachers.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10%'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gender',
                        name: 'gener'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
            // Delete a record
            $('#data-table-buttons').on('click', '.delete', function(e) {
                e.preventDefault();
                swal({
                    title: '{{ __('messages.delete_confirmation') }}',
                    text: '{{ __('messages.delete_message') }}',
                    icon: 'error',
                    buttons: {
                        cancel: {
                            text: 'No',
                            value: null,
                            visible: true,
                            className: 'btn btn-default',
                            closeModal: true,
                        },
                        confirm: {
                            text: 'Yes',
                            value: true,
                            visible: true,
                            className: 'btn btn-danger',
                            closeModal: true
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: $(this).data('url'),
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                console.log(data);
                                if (data.status == "success") {
                                    swal("{{ __('messages.delete_success') }}", {
                                        icon: "success",
                                    });
                                    window.location.reload();
                                } else {
                                    swal("{{ __('messages.delete_failed') }}", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });

    </script>
@endpush
