@extends('layouts.app')
@section('title', 'Terima Barang Pesanan')

@section('content')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pesanan Pembelian</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Order</th>
                            <th>Tanggal Pesan</th>
                            <th>Nama Pemasok</th>
                            <th class="text-center">Total Jenis Item</th>
                            <th style="width: 200px" class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->tanggal_order}}</td>
                            <td>{{$order->id}}</td>
                            <td>{{$order->supplier->nama_supplier}}</td>
                            <td class="text-center">{{$order->orderdetail->count()}}</td>
                            <td class="text-right"> <a name="" id="" class="btn btn-primary btn-sm" href="{{route('receive.create', $order->id)}}" role="button"> <i class="fas fa-check    "></i>&nbsp; Terima Barang</a> </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p>Tidak ada data pesanan pembelian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Terima Barang Terakhir</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-inverse">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID Terima</th>
                            <th>Tanggal Terima</th>
                            <th>ID Pesan</th>
                            <th>No Faktur</th>
                            <th>Tanggal Faktur</th>
                            <th>Supplier</th>
                            <th class="text-center">Total Jenis Item</th>
                            <th class="text-right">Total</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($receives as $item)
                                <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->id}} </td>
                                <td> {{$item->receive_date}} </td>
                                <td> {{$item->order_id}} </td>
                                <td> {{strtoupper($item->invoice)}}</td>
                                <td> {{$item->invoice_date}} </td>
                                <td> {{$item->supplier->nama_supplier}} </td>
                                <td class="text-center"> {{$item->receivedetail->count()}} </td>
                                <td class="text-right">@currency($item->total)</td>
                                <td class="text-right"><a name="" id="" class="btn btn-primary btn-sm " href="{{route('receive.show', $item->id)}}" role="button">Lihat Detail</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    <p>Data belum tersedia</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
@endsection