@extends('partials.main')
@section('title', 'Obat')
@section('main')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Data Obat</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('medicine.index') }}"><i
                                            class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('medicine.index') }}">Obat</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Edit Obat</a></li>
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
                            <a href="{{ route('medicine.index') }}" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-arrow-left me-1"></i>Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('medicine.update', $data->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Nama Obat</label>
                                <input type="text" class="form-control" name="obat" value="{{ $data->obat }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Jenis Obat</label>
                                <input type="text" class="form-control" name="jenis" value="{{ $data->jenis }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Satuan Obat</label>
                                <input type="text" class="form-control" name="satuan" value="{{ $data->satuan }}">
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
@endsection
