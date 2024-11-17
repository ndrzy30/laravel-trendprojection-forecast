@extends('partials.main')
@section('title', 'Model')
@section('main')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Trend Projection Model</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('train.index') }}"><i
                                            class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('train.store') }}" class="btn btn-primary btn-sm"><i
                                class="fa-solid fa-rotate-right me-2"></i>Reload
                            Data</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Obat</th>
                                    <th>Penjualan (Y)</th>
                                    <th>Periode (X)</th>
                                    <th>XY</th>
                                    <th>X <sup>2</sup></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->obat }}</td>
                                        <td>{{ $item->penjualan_y }}</td>
                                        <td>{{ $item->periode_x }}</td>
                                        <td>{{ $item->xy }}</td>
                                        <td>{{ $item->x2 }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-primary text-center" role="alert">
                                        <i class="fa-solid fa-circle-info me-2"></i>Data Empty
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Kontrol Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
