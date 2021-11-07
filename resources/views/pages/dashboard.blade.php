@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.view') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
                <div class="card earning-card">
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-xl-3 earning-content p-0">
                                <div class="row m-0 chart-left">
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>Dashboard</h5>
                                        <p class="font-roboto">Rangkuman data</p>
                                    </div>
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>{{ $total_teacher }}</h5>
                                        <p class="font-roboto">Jumlah Guru</p>
                                    </div>
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>{{ $total_student }}</h5>
                                        <p class="font-roboto">Jumlah Siswa</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 p-0">
                                <div class="chart-right">
                                    <div class="row m-0 p-tb">
                                        <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                            <div class="inner-top-left">
                                                <ul class="d-flex list-unstyled">
                                                    <li class="active">Presensi Hari Ini</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body p-0">
                                                <div class="current-sale-container">
                                                    <div id="chart-currently"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top m-0">
                                    @forelse ($attendances as $index => $item)
                                        <div class="col-xl-4 pl-0 col-md-6 col-sm-6">
                                            <div class="media p-0">
                                                <div class="media-left"><i class="icofont icofont-crown"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>{{ $item->name }}</h6>
                                                    <table>
                                                        @php($no = 1)
                                                        @foreach ($item->attendance_student as $item_a)
                                                            <tr>
                                                                <td>{{ $no++ . '. ' }}</td>
                                                                <td>{{ $item_a->student->name }}</td>
                                                                <td>{{ $item_a->status }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <p style="text-align: center"> {{ 'Belum ada presensi hari ini.' }} </p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-50 chart_data_right second d-none">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body right-chart-content">
                                <h4>$95,000<span class="new-box">New</span></h4><span>Product Order
                                    Value</span>
                            </div>
                            <div class="knob-block text-center">
                                <input class="knob1" data-width="50" data-height="70" data-thickness=".3"
                                    data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
