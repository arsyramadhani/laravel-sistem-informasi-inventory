@extends('layouts.app')
@section('title', 'Detail Transaksi Penjualan')

@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/sale" role=" button">Kembali</a>
    <button onclick="window.open('{{route('sale.print', $sale->id)}}','_blank')" type="button" class="btn btn-primary float-right"><i class="fas fa-receipt    "></i>&nbsp; Cetak Struk</button>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card card-cyan card-outline">
            <div class="card-header">
                <h5 class="card-title">Detail Transaksi</h5>
            </div>
            <div class="card-body ">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>ID Transaksi</b> <a class="float-right"> {{ $sale->id }} </a>
                    </li>
                    <li class="list-group-item">
                        <b>Tanggal</b> <a class="float-right">
                            {{ $sale->created_at->format('d-m-yy') }} </a>
                    </li>
                    <li class="list-group-item">
                        <b>Jam</b> <a
                            class="float-right">{{ $sale->created_at->format('H:i') }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Barang</b> <a class="float-right"> {{ $sale->saledetail->count() }} </a>
                    </li>
                    <li class="list-group-item">
                        <b>Total Barang</b> <a class="float-right">
                            {{ $sale->saledetail->sum('qty') }} </a>
                    </li>
                    <li class="list-group-item">
                        <b>Total Tagihan</b> <a class="float-right"> @currency($sale->total) </a>
                    </li>
                    <li class="list-group-item">
                        <b>Total Bayar</b> <a class="float-right"> @currency($sale->paid) </a>
                    </li>
                    <li class="list-group-item">
                        <b>Kembali</b> <a class="float-right"> @currency(($sale->paid)-($sale->total)) </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card card-cyan card-outline">
            <div class="card-header">
                <h5 class="card-title">Detail Item</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>No Batch</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-center">Jumlah Beli</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail->product_id}}</td>
                                    <td>{{$detail->product->nama_barang}}</td>
                                    <td>{{$detail->batch->no_batch}}</td>
                                    <td class="text-right"> @currency($detail->product->harga_jual) </td>
                                    <td class="text-center">{{$detail->qty}}</td>
                                    <td class="text-right">@currency($detail->qty*$detail->product->harga_jual)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
