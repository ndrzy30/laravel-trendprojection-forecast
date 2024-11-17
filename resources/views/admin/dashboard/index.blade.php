@extends('partials.main')
@section('title', 'Dashboard')
@push('chart')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
@section('main')
    <div class="pc-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-primary order-card">
                    <div class="card-body">
                        <h6 class="text-white">Jumlah Obat</h6>
                        <h2 class="text-end text-white"><i
                                class="fa-solid fa-pills float-start"></i><span>{{ $drugs }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-success order-card">
                    <div class="card-body">
                        <h6 class="text-white">Periode Penjualan</h6>
                        <h2 class="text-end text-white"><i
                                class="fa-solid fa-cart-shopping float-start"></i><span>{{ $sale }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-warning order-card">
                    <div class="card-body">
                        <h6 class="text-white">Jenis Obat</h6>
                        <h2 class="text-end text-white"><i
                                class="fa-solid fa-list float-start"></i><span>{{ $type }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Monthly Sales Line Chart with Data Labels -->
            <div id="monthlySalesChart" class="my-5"></div>
            <!-- Recent Orders end -->
            <div id="chart" class="my-5"></div>
            <div id="chart-predict" class="my-5"></div>
            <script>
                // Data dari controller, diambil langsung dalam bentuk PHP array dan disiapkan untuk JavaScript
                var jenisObat = @json($obats->pluck('jenis'));
                var totalJumlah = @json($obats->pluck('total_jumlah'));

                // Menampilkan data dengan ApexCharts
                var options = {
                    chart: {
                        type: 'bar'
                    },
                    series: [{
                        name: 'Jumlah Obat',
                        data: totalJumlah
                    }],
                    xaxis: {
                        categories: jenisObat,
                        title: {
                            text: 'Jenis Obat'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Jumlah'
                        }
                    },
                    title: {
                        text: 'Jumlah Obat per Jenis Obat',
                        align: 'center'
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>



            <script>
                // Monthly Sales Line Chart with Data Labels
                var monthlySalesData = @json($monthlySales);

                // Process the data
                var processedData = monthlySalesData.reduce((acc, item) => {
                    if (!acc[item.year]) {
                        acc[item.year] = Array(12).fill(null);
                    }
                    acc[item.year][item.month - 1] = item.total_quantity;
                    return acc;
                }, {});

                var years = Object.keys(processedData);
                var series = years.map(year => ({
                    name: year,
                    data: processedData[year]
                }));

                var monthlySalesOptions = {
                    chart: {
                        type: 'line',
                        height: 350,
                        zoom: {
                            enabled: false
                        }
                    },
                    series: series,
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val !== null ? val.toFixed(0) : '';
                        },
                        offsetY: -5
                    },
                    stroke: {
                        width: [2, 2, 2, 2],
                        curve: 'straight'
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        title: {
                            text: 'Bulan'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Penjualan'
                        }
                    },
                    title: {
                        text: 'Penjualan Bulanan per Tahun',
                        align: 'center'
                    },
                    legend: {
                        position: 'top'
                    },
                    markers: {
                        size: 5,
                        hover: {
                            size: 7
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val !== null ? val.toFixed(0) : 'No data';
                            }
                        }
                    }
                };

                var monthlySalesChart = new ApexCharts(document.querySelector("#monthlySalesChart"), monthlySalesOptions);
                monthlySalesChart.render();
            </script>
        </div>
        <!-- [ Main Content ] end -->
        <script>
            // Ambil data prediksi dalam format JSON
            var prediksiData = @json($prediksiData);

            // Proses data untuk chart
            var aktualData = prediksiData.map(item => item.aktual_y ?? null); // Handle null values
            var prediksiDataPoints = prediksiData.map(item => item.prediksi_f);

            var options = {
                series: [{
                        name: 'Penjualan Aktual {{ $predict }}',
                        data: aktualData
                    },
                    {
                        name: 'Prediksi Penjualan {{ $predict }}',
                        data: prediksiDataPoints
                    }
                ],
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
                    text: 'Hasil Prediksi Penjualan Obat {{ $predict }}',
                    align: 'left'
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Penjualan {{ $predict }}'
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

            var chart = new ApexCharts(document.querySelector("#chart-predict"), options);
            chart.render();
        </script>

    </div>
@endsection
