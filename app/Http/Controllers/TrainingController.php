<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Train;

class TrainingController extends Controller
{
    public function index()
    {
        $data = Train::paginate(50);
        return view('admin.train.index', compact('data'));
    }

    public function calculate()
    {
        // Ambil semua data penjualan dari model Sale dan urutkan berdasarkan tahun
        $sales = Sale::orderBy('tanggal')->get();

        // Inisialisasi periode X
        $periode = 1;

        // Hapus data sebelumnya dari tabel trains (opsional)
        Train::truncate();

        foreach ($sales as $sale) {
            // Ambil tanggal dalam format date
            $tanggal = date('Y-m-d', strtotime($sale->tanggal)); // format YYYY-MM-DD

            // Data penjualan (Y)
            $penjualanY = $sale->jumlah;

            // Hitung XY dan X²
            $xy = $periode * $penjualanY;
            $x2 = $periode * $periode;

            // Simpan data ke tabel trains
            Train::create([
                'tanggal' => $tanggal, // Menyimpan tanggal dalam format date
                'obat' => $sale->obat, // Simpan nama obat
                'penjualan_y' => $penjualanY,
                'periode_x' => $periode,
                'xy' => $xy,
                'x2' => $x2,
            ]);

            // Increment periode
            $periode++;
        }

        // Ambil semua data dari tabel trains untuk ditampilkan
        //$dataPersiapan = Train::all();

        // Kembalikan ke view model.admin.index
        return back();
    }

}