@extends('layouts.app')
@section('title', 'Detail Terima Barang - '. $receive->id)

@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/receive" role=" button">Kembali</a>
    <button type="button" id="btncetak" onclick="window.print()" class="btn btn-info float-right" style="width: 150px"><i class="fas fa-print    "></i> Cetak</button>
</div>
<div class="card p-4 col-sm-12">
    <div class="invoice p-4 mt-5 border-0">
        <div class="row ">
            <div class="col-sm-6">
                <img src="/dist/img/logo.png" alt="Logo Apotek" width="70px">
                <h2 class="mt-3"><strong> {{ strtoupper($info->nama) }}</strong> </h2>
                <p>{{ $info->alamat }}, {{ $info->kota }}<br>
                    {{$info->telepon}} <br>
                    {{ $info->sipa }}
                </p>
            </div>
            <div class="col-sm-6 text-right">
                <h1 class="font-weight-normal"><b>PURCHASE</b> RECEIVE</h1>
                <p class="font-weight-bold">{{$receive->id}}</p>
            </div>
        </div>
        <hr>
        <div class="row invoice-info mt-3">
            <div class="invoice-col col-sm-6  callout callout-success elevation-0">
                <p>Dari Supplier : <br>
                <b>{{strtoupper($receive->supplier->nama_supplier)}}</b> <br>
                    {{$receive->supplier->alamat_supplier}}, {{$receive->supplier->kota_supplier}} <br>
                    {{$receive->supplier->telepon}}
                </p>
            </div>
            <div class="invoice-col col-sm-3 callout callout-success elevation-0">
                <p>
                    No Faktur / Invoice : <br>
                    <b> {{strtoupper($receive->invoice)}}</b> <br>
                    <br>
                    Tanggal Faktur / Invoice <br>
                    <b> {{strtoupper($receive->invoice_date)}}</b> <br>
                </p>
            </div>
            <div class="invoice-col col-sm-3 callout callout-success elevation-0">
                <p>
                    No Pesanan :<br>
                    <b>{{$receive->order_id}}</b> <br>
                    <br>
                    Tanggal Diterima : <br>
                    <b>{{$receive->receive_date}}</b>
                </p>
            </div>
        </div>
        <div class="row invoice-info mt-3">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kemasan</th>
                        <th>No Batch</th>
                        <th>Kadaluwarsa</th>
                        <th class="text-center">Jml Diterima</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Diskon <i class="fas fa-percentage    "></i> </th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $item)
                    <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$item->product_id}} </td>
                        <td> {{$item->product->nama_barang}} </td>
                        <td> {{$item->product->unit->nama_unit}} </td>
                        <td> {{$item->batch->no_batch}} </td>
                        <td> {{$item->batch->expiry_date}} </td>
                        <td class="text-center"> {{$item->qty}} </td>
                        <td class="text-right"> @currency($item->buy_price) </td>
                        <td class="text-right"> {{$item->discount}}</td>
                        <td class="text-right"> @currency($item->subtotal) </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9" class="text-right font-weight-bold">Subtotal</td>
                        <td colspan="1" class="text-right"> @currency($receive->receivedetail->sum('subtotal')) </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="text-right font-weight-bold">PPN</td>
                        <td colspan="1" class="text-right">@currency($receive->tax)</td>
                    </tr>
                    <tr>
                        <td colspan="9" class="text-right font-weight-bold">Grand Total</td>
                        <td colspan="1" class="text-right">@currency($receive->total)</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <br>
        <br>
        <div class="row mt-5 ">
            <div class="col-sm-4"><p>Catatan:</p></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="text-center">
                    Apoteker <br>
                    <br>
                    <br>
                    <br>
                    <strong>{{$info->apa}}</strong><br>
                    SIPA : {{$info->sipa}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection