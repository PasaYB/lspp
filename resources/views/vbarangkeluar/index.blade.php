@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG KELUAR</a>
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
                            <th>TANGGAL KELUAR</th>
                            <th>JUMLAH BARANG KELUAR</th>
                            <th>ID BARANG</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangkeluar as $rowbrgklr)
                            <tr>
                                <td>{{ $rowbrgklr->id  }}</td>
                                <td>{{ $rowbrgklr->tgl_keluar  }}</td>
                                <td>{{ $rowbrgklr->qty_keluar  }}</td>
                                <td>{{ $rowbrgklr->barang_id  }} - {{ $rowbrgklr->barang->merk }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangkeluar.destroy', $rowbrgklr->id) }}" method="POST">
                                        <a href="{{ route('barangkeluar.show', $rowbrgklr->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangkeluar.edit', $rowbrgklr->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                            @empty
                            <div class="alert">
                                Data  Barang Keluar belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                    
                </table>
                {{-- {{ $barangkeluar->links() }} --}}

            </div>
        </div>
    </div>
@endsection