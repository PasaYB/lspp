@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.store') }}" method="POST" enctype="multipart/form-data"> 
                            <div clas="pull-right">
                                <a class="btn btn-primary" href="{{route('barangmasuk.index')}}"> Back </a>
                            </div>                   
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">TANNGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk') }}" placeholder="Masukkan tgl_masuk Lengkap">
                            
                                <!-- error message untuk nama -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH BARANG MASUK</label>
                                <input type="text" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk') }}" placeholder="Masukkan Jumlah Barang">
                            
                                <!-- error message untuk nama -->
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id">
                                    <option value="">Pilih Barang</option>
                                    @foreach($rsetbarang as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>{{ $barang->merk }} - Stok : {{ $barang->stok }}</option>

                                    @endforeach
                                </select>

                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>

 

            </div>
        </div>
    </div>
@endsection