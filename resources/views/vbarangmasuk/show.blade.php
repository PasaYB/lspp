@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>TANGGAL MASUK</td>
                                <td>{{ $rsetbrgmasuk->tgl_masuk }}</td>
                            </tr>
                            <tr>
                                <td>JUMLAH BARANG MASUK</td>
                                <td>{{ $rsetbrgmasuk->qty_masuk }}</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>ID BARANG</td>
                                <td>{{ $rsetbrgmasuk->barang_id }} - {{ $rsetbrgmasuk->barang->merk }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12  text-center">
                
                <br>
                <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection