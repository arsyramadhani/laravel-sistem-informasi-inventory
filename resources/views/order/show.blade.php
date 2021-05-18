@extends('layouts.app')
@section('title', 'Pesanan pembelian #'.$order->id)

@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/order" "="" role=" button">Kembali</a>
    <button type="button" id="btncetak" onclick="window.print()" class="btn btn-info float-right" style="width: 150px"><i class="fas fa-print    "></i> Cetak</button>
</div>
<div class="card p-2 col-12">
        @if ($order->status == 1)
            <x-ribbon type="primary" text="Belum Diproses"/>
        @elseif ($order->status == 2)
            <x-ribbon type="success" text="Selesai"/>
        @endif
    <div class="invoice p-5 mt-5" style="border: 0">
        <div class="row">
            <div class="col-sm-6">
                <img src="/dist/img/logo.png" alt="Logo Apotek" width="70px">
                <h2 class="mt-3"><strong> {{ strtoupper($info->nama) }}</strong> </h2>
                <p>{{ $info->alamat }}, {{ $info->kota }}<br>
                    {{$info->telepon}} <br>
                    {{ $info->sipa }}
                </p>
            </div>
            <div class="col-sm-6 text-right">
                <h1 class="font-weight-bold">PURCHASE ORDER</h1>
            </div>
        </div>
        <hr>
        <div class="row invoice-info mt-3  ">
            <div class="col-sm-6 invoice-col">
                <p>To : <br>
                   <b>{{strtoupper($order->supplier->nama_supplier)}}</b><br>
                   {{$order->supplier->alamat_supplier}}, {{$order->supplier->kota_supplier}} <br>
                   {{$order->supplier->telepon}}
                </p>
            </div>
            <div class="col-sm-3 invoice-col">
                <p>Tanggal : <br>
                    <b> {{$tanggal}} </b>
                </p>
            </div>
            <div class="col-sm-3 invoice-col text-right">
                <p>No : <br>
                    <b> {{ $order->id }} </b>
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 invoice-col">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Nama Barang</th>
                            <th>Kemasan</th>
                            <th class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$detail->product_id}}</td>
                                <td>{{$detail->product->nama_barang}}</td>
                                <td>{{$detail->product->unit->nama_unit}}</td>
                                <td class="text-center">{{$detail->qty}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="text-center">
                    <br>
                    <br>
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
    <div class="card-footer">

    </div>
</div>

@endsection
