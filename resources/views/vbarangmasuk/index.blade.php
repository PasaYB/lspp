@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG MASUK</a>
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
                            <th>TANGGAL MASUK</th>
                            <th>JUMLAH BARANG MASUK</th>
                            <th>ID BARANG</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangmasuk as $rowbrgmsk)
                            <tr>
                                <td>{{ $rowbrgmsk->id  }}</td>
                                <td>{{ $rowbrgmsk->tgl_masuk  }}</td>
                                <td>{{ $rowbrgmsk->qty_masuk  }}</td>
                                <td>{{ $rowbrgmsk->barang_id  }} - {{ $rowbrgmsk->barang->merk }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $rowbrgmsk->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $rowbrgmsk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $rowbrgmsk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data Barang Masuk belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                    
                </table>
                {{-- {{ $barangmasuk->links() }} --}}

            </div>
        </div>
    </div>
@endsection