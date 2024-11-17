@extends('partials.main')
@section('title', 'Penjualan')
@section('main')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Data Penjualan Obat</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('sales.index') }}"><i
                                            class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Penjualan</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Tambah Penjualan</a></li>
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
                        <div class="text-end">
                            <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-arrow-left me-1"></i>Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sales.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>
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
                                <label for="">Jumlah Obat</label>
                                <input type="text" class="form-control" name="jumlah">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <script>
        var select_box_element = document.querySelector('#select_box');

        dselect(select_box_element, {
            search: true
        });
    </script>
@endsection
