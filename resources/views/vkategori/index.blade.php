@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
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
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $rowkt)
                            <tr>
                                <td>{{ $rowkt->id  }}</td>
                                <td>{{ $rowkt->deskripsi  }}</td>
                                <td>{{ $rowkt->kategori  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowkt->id) }}" method="POST">
                                        <a href="{{ route('kategori.show', $rowkt->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('kategori.edit', $rowkt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data Kategori belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                    
                </table>
                {{-- {{ $kategori->links() }} --}}

            </div>
        </div>
    </div>
@endsection