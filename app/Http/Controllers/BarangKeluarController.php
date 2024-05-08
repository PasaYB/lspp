<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangkeluarController extends Controller
{
    public function index()
    {
        //
        $barangkeluar = BarangKeluar::all();        
        return view('vbarangkeluar.index',compact('barangkeluar'));
    }

    public function create()
    {
        //
        $rsetbarang = Barang::all();
        return view('vbarangkeluar.create', compact('rsetbarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangkeluar.create')
                ->withErrors($validator)
                ->withInput();
        }
        BarangKeluar::create([
            'tgl_keluar'=>$request->tgl_keluar,
            'qty_keluar'=>$request->qty_keluar,
            'barang_id'=>$request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Ditambah!']);

    }

    
    public function show(string $id)
    {
        $rsetbrgkeluar = BarangKeluar::find($id);

        return view('vbarangkeluar.show', compact('rsetbrgkeluar'));
    }

    
    public function edit(string $id)
    {

        $rsetbrgkeluar = BarangKeluar::find($id);
        $rsetbarang = Barang::all();
        return view('vbarangkeluar.edit', compact('rsetbrgkeluar', 'rsetbarang'));
    }

    
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangkeluar.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $rsetbrgkeluar = BarangKeluar::find($id);

            $rsetbrgkeluar->update([
            'tgl_keluar'=>$request->tgl_keluar,
            'qty_keluar'=>$request->qty_keluar,
            'barang_id'=>$request->barang_id,
            ]);
        

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        

        $rsetbrgkeluar = BarangKeluar::find($id);

        //delete post
        $rsetbrgkeluar->delete();

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
