<?php

namespace App\Http\Controllers;

use App\Imports\ImportSales;
use App\Models\Obat;
use App\Models\Sale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sale::all();
        return view('admin.penjualan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drugs = Obat::all();
        return view('admin.penjualan.create', compact('drugs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'obat' => 'required',
            'jumlah' => 'required',
        ]);
        $data = Sale::create($request->all());
        $data->save();
        return redirect()->route('sales.index')->with('toast_success', 'Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $drugs = Obat::all();
        $data = Sale::findOrFail($id);
        return view('admin.penjualan.edit', compact('drugs', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Sale::findOrFail($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('sales.index')->with('toast_success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Sale::findOrFail($id);
        $data->delete();
        return redirect()->route('sales.index')->with('toast_success', 'Data Dihapus');
    }

    public function imports(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv|max:1020',
        ], [
            'file.required' => 'File belum diupload',
            'file.mimes' => 'Format File harus Excel/CSV',
            'file.max' => 'Ukuran File Max 1MB',
        ]);
        Excel::import(new ImportSales, $request->file);
        return redirect()->route('sales.index')->with('toast_success', 'Data Berhasil Di import');
    }

    public function reset()
    {
        Sale::truncate();
        return back()->with('toast_success', 'Data Dihapus');
    }
}