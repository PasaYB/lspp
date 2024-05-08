<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategori = Kategori::all();        
        return view('vkategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('vkategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'deskripsi'    => 'required',
            'kategori'   => 'required|not_in:blank',
        ]);
        Kategori::create([
            'deskripsi'=>$request->deskripsi,
            'kategori'=>$request->kategori,
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        //return $rsetKategori;

        //return view
        return view('vkategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $ktgr = array('blank'=>'Pilih Kategori',
                                    'M'=>'M - Modal',
                                    'A'=>'A - Alat',
                                    'BHP'=>'BHP - Barang Habis Pakai',
                                    'BTHP'=>'BTHP - Barang Tidak Habis Pakai'
                        );

        $rsetKategori = Kategori::find($id);
        return view('vkategori.edit', compact('rsetKategori','ktgr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'deskripsi'    => 'required',
            'kategori'     => 'required'
        ]);

        $rsetKategori = Kategori::find($id);

            //update post without image
            $rsetKategori->update([
                'deskripsi'    => $request->deskripsi,
                'kategori'     => $request->kategori
            ]);
        

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
