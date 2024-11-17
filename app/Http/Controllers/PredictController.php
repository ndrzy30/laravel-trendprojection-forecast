<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Prediction;
use App\Models\Train;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PredictController extends Controller
{
    public function index()
    {
        $drugs = Obat::all();
        // Mengambil semua data prediksi dari database
        $prediksiData = Prediction::all();
        $obat = Prediction::value('obat');
        // Kembalikan data prediksi ke view tanpa data obat
        return view('admin.prediksi.index', [
            'prediksiData' => $prediksiData,
            'drugs' => $drugs,
            'obat' => $obat,
        ]);
    }

    public function predict(Request $request)
    {
        $request->validate([
            'obat' => 'required|string',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 100),
        ]);

        $obat = $request->obat;
        $tahunPrediksi = $request->tahun;
        $tahunSebelumnya = $tahunPrediksi - 1;
        $duaTahunSebelumnya = $tahunPrediksi - 2;

        // Mendapatkan data penjualan obat untuk dua tahun sebelumnya
        $dataDuaTahunSebelumnya = Train::where('obat', $obat)
            ->whereYear('tanggal', $duaTahunSebelumnya)
            ->orderBy('tanggal')
            ->get();

        // Mendapatkan data penjualan obat untuk tahun sebelumnya
        $dataTahunSebelumnya = Train::where('obat', $obat)
            ->whereYear('tanggal', $tahunSebelumnya)
            ->orderBy('tanggal')
            ->get();

        if ($dataTahunSebelumnya->isEmpty() || $dataDuaTahunSebelumnya->isEmpty()) {
            return redirect()->back()->with('error', 'Data penjualan untuk obat ini tidak ditemukan pada dua tahun sebelumnya.');
        }

        // Menggabungkan data dari dua tahun sebelumnya
        $dataGabungan = $dataDuaTahunSebelumnya->merge($dataTahunSebelumnya);

        // Menghitung total penjualan (Y), total periode (X), total XY, dan total X²
        $n = $dataGabungan->count();
        $totalY = $dataGabungan->sum('penjualan_y');
        $totalX = $dataGabungan->sum('periode_x');
        $totalXY = $dataGabungan->sum(function ($item) {
            return $item->periode_x * $item->penjualan_y;
        });
        $totalX2 = $dataGabungan->sum(function ($item) {
            return $item->periode_x * $item->periode_x;
        });

        // Menghitung slope dan intercept berdasarkan total yang sudah dihitung
        $slope = ($n * $totalXY - $totalX * $totalY) / ($n * $totalX2 - $totalX * $totalX);
        $intercept = ($totalY - $slope * $totalX) / $n;

        // Menghapus data prediksi yang lama sebelum menyimpan data prediksi yang baru
        Prediction::truncate();

        // Mendapatkan data untuk tahun prediksi
        $dataTahunPrediksi = Train::where('obat', $obat)
            ->whereYear('tanggal', $tahunPrediksi)
            ->orderBy('tanggal')
            ->get();

        // Loop untuk menghitung prediksi dan menyimpan hasilnya
        foreach ($dataTahunPrediksi as $data) {
            $currentPeriodeX = $data->periode_x;
            $prediksiY = $intercept + $slope * $currentPeriodeX;
            $bulanTahun = Carbon::parse($data->tanggal)->format('F Y');
            Prediction::create([
                'obat' => $obat,
                'bulan' => $bulanTahun,
                'prediksi_f' => round($prediksiY, 2),
                'periode_x' => $currentPeriodeX,
                'aktual_y' => $data->penjualan_y,
            ]);
        }

        return redirect()->route('predict.index')->with('success', 'Prediksi berhasil dihitung dan disimpan.');
    }

}
