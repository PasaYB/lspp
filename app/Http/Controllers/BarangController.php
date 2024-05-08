<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Kategori; // Pastikan untuk mengimpor model Kategori
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barang = Barang::all();        
        return view('vbarang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rsetKategori = Kategori::all();
        return view('vbarang.create', compact('rsetKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|max:50',
            'seri' => 'nullable|string|max:50',
            'spesifikasi' => 'nullable|string',
            'stok' => 'nullable|integer',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput();
        }
        Barang::create([
            'merk'=>$request->merk,
            'seri'=>$request->seri,
            'spesifikasi'=>$request->spesifikasi,
            'stok'=>$request->stok,
            'kategori_id'=>$request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Ditambah!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetbarang = Barang::find($id);

        //return $rsetbarang;

        //return view
        return view('vbarang.show', compact('rsetbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $rsetbarang = Barang::find($id);
        $rsetKategori = Kategori::all(); 
        return view('vbarang.edit', compact('rsetbarang', 'rsetKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string|max:50',
            'seri' => 'nullable|string|max:50',
            'spesifikasi' => 'nullable|string',
            'stok' => 'nullable|integer',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $rsetbarang = barang::find($id);

            //update post without image
            $rsetbarang->update([
                'merk'=>$request->merk,
                'seri'=>$request->seri,
                'spesifikasi'=>$request->spesifikasi,
                'stok'=>$request->stok,
                'kategori_id'=>$request->kategori_id,
            ]);
        

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
        
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() || DB::table('barangkeluar')->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Barang::find($id);
            $rsetKategori->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
        $rsetbarang = Barang::find($id);

        //delete post
        $rsetbarang->delete();

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
