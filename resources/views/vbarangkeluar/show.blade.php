@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>TANGGAL KELUAR</td>
                                <td>{{ $rsetbrgkeluar->tgl_keluar }}</td>
                            </tr>
                            <tr>
                                <td>JUMLAH BARANG KELUAR</td>
                                <td>{{ $rsetbrgkeluar->qty_keluar }}</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>ID BARANG</td>
                                <td>{{ $rsetbrgkeluar->barang_id }} - {{ $rsetbrgkeluar->barang->merk }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12  text-center">
                
                <br>
                <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection