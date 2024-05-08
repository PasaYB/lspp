@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>
                    </div>
                </div>
                @if(session('success'))
                 <div class="alert alert-success">
                     {{ session('success') }}
                  </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                     {{ session('error') }}
                     </div>
                @endif
            

            @if(session('Gagal'))
                <div class="alert alert-danger">
                 {{ session('Gagal') }}
                </div>
            @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MERK</th>
                            <th>SERI</th>
                            <th>SPESIFIKASI</th>
                            <th>STOK</th>
                            <th>KATEGORI ID</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $rowbrg)
                            <tr>
                                <td>{{ $rowbrg->id  }}</td>
                                <td>{{ $rowbrg->merk  }}</td>
                                <td>{{ $rowbrg->seri  }}</td>
                                <td>{{ $rowbrg->spesifikasi  }}</td>
                                <td>{{ $rowbrg->stok  }}</td>
                                <td>{{ $rowbrg->kategori_id  }} - {{ $rowbrg->kategori->deskripsi }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowbrg->id) }}" method="POST">
                                        <a href="{{ route('barang.show', $rowbrg->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barang.edit', $rowbrg->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                                
                            @empty
                            <div class="alert">
                                Data Barang belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                    
                </table>
                {{-- {{ $barang->links() }} --}}

            </div>
        </div>
    </div>
@endsection