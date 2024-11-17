<?php

namespace App\Http\Controllers;

use App\Imports\ImportObat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Obat::all();
        return view('admin.obat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'obat' => 'required',
            'jenis' => 'required',
            'satuan' => 'required',
        ]);
        $data = Obat::create($request->all());
        $data->save();
        return redirect()->route('medicine.index')->with('toast_success', 'Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Obat::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('medicine.index')->with('toast_success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Obat::findOrFail($id);
        $data->delete();
        return redirect()->route('medicine.index')->with('toast_success', 'Data Dihapus');
    }

    public function imports(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv|max:1020',
        ], [
            'file.required' => 'file belum diupload',
        ]);
        Excel::import(new ImportObat, $request->file);
        return back()->with('toast_success', 'Import Sukses');
    }
}