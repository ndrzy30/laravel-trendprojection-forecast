@extends('partials.main')
@section('title', 'Prediction')
@push('chart')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
@section('main')

    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Prediksi Penjualan Obat {{ $obat }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('predict.index') }}"><i
                                            class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('predict.index') }}" class="btn btn-success btn-sm"><i
                                class="fa-solid fa-arrows-rotate me-2"></i>Refresh</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="mb-1">Hasil Perhitungan Prediksi Penjualan Obat
                                </label>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>(X) Periode</th>
                                            <th>Prediksi Penjualan (Y)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prediksiData as $prediksi)
                                            <tr>
                                                <td>{{ $prediksi['bulan'] }}</td>
                                                <td>{{ $prediksi['periode_x'] ?? '-' }}</td>
                                                <td>{{ $prediksi['prediksi_f'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('predict.store') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="">Obat</label>
                                        <select name="obat" id="select_box" class="form-select">
                                            <option value="">Pilih Obat</option>
                                            @foreach ($drugs as $item)
                                                <option value="{{ $item->obat }}">{{ $item->obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Pilih Tahun Prediksi</label>
                                        <input type="number" class="form-control" name="tahun">
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100" type="submit">Predict</button>
                                </form>
                            </div>
                        </div>
                        <div id="chart" class="my-5"></div>
                        <h6>Perhitungan APE {{ $obat }}</h6>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Aktual <i>Y<sub>t</sub></i></th>
                                    <th>Prediksi <i>F<sub>t</sub></i></th>
                                    <th>Aktual - Prediksi <br><i>(Y<sub>t</sub> - F<sub>t</sub>)</i></th>
                                    <th>APE (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalApe = 0;
                                    $count = count($prediksiData);
                                @endphp
                                @foreach ($prediksiData as $row)
                                    @php
                                        $aktual = $row['aktual_y'];
                                        $prediksi = $row['prediksi_f'];
                                        $selisih = $aktual - $prediksi;
                                        $ape = $aktual != 0 ? (abs($selisih) / $aktual) * 100 : 0;
                                        $totalApe += $ape;
                                    @endphp
                                    <tr>
                                        <td>{{ $row['bulan'] }}</td>
                                        <td>{{ $aktual }}</td>
                                        <td>{{ $prediksi }}</td>
                                        <td>{{ $selisih }}</td>
                                        <td>{{ number_format($ape, 2) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                            $mape = $count > 0 ? $totalApe / $count : 0;
                        @endphp
                        <h6>Mean Absolute Percentage Error (MAPE) {{ $obat }}: {{ number_format($mape, 2) }}%</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var select_box_element = document.querySelector('#select_box');
        dselect(select_box_element, {
            search: true
        });

        var options = {
            series: [{
                name: 'Penjualan Aktual {{ $obat }}',
                data: [
                    @foreach ($prediksiData as $row)
                        {{ isset($row['aktual_y']) ? $row['aktual_y'] : 'null' }},
                    @endforeach
                ]
            }, {
                name: 'Prediksi Penjualan {{ $obat }}',
                data: [
                    @foreach ($prediksiData as $row)
                        {{ $row['prediksi_f'] }},
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Hasil Prediksi Penjualan Obat {{ $obat }}',
                align: 'left'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
            },
            yaxis: {
                title: {
                    text: 'Jumlah Penjualan {{ $obat }}'
                }
            },
            tooltip: {
                enabled: true,
                y: {
                    formatter: function(val) {
                        return val + " unit";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
