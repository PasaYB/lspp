<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        //
        $barangmasuk = BarangMasuk::all();        
        return view('vbarangmasuk.index',compact('barangmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rsetbarang = Barang::all();
        return view('vbarangmasuk.create', compact('rsetbarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangmasuk.create')
                ->withErrors($validator)
                ->withInput();
        }
        BarangMasuk::create([
            'tgl_masuk'=>$request->tgl_masuk,
            'qty_masuk'=>$request->qty_masuk,
            'barang_id'=>$request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Ditambah!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetbrgmasuk = BarangMasuk::find($id);

        //return $rsetKategori;

        //return view
        return view('vbarangmasuk.show', compact('rsetbrgmasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $rsetbrgmasuk = BarangMasuk::find($id);
        $rsetbarang = Barang::all();
        return view('vbarangmasuk.edit', compact('rsetbrgmasuk', 'rsetbarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangmasuk.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $rsetbrgmasuk = BarangMasuk::find($id);

            //update post without image
            $rsetbrgmasuk->update([
            'tgl_masuk'=>$request->tgl_masuk,
            'qty_masuk'=>$request->qty_masuk,
            'barang_id'=>$request->barang_id,
            ]);
        

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetbrgmasuk = BarangMasuk::find($id);

        //delete post
        $rsetbrgmasuk->delete();

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
