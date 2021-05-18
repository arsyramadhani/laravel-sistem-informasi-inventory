@extends('layouts.app')
@section('title', 'Daftar Penjualan')

@section('content')
<div class="card mt-3">
    <div class="card-header border-transparent">
        <h5 class="card-title">Daftar penjualan</h5>
    </div>
    <div class="card-body p-0" style="display: block;">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal - Waktu Transaksi</th>
                        <th class="text-center">Jenis Item</th>
                        <th class="text-right">Nilai Transaksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->created_at->format('d-m-yy / H:m')}}</td>
                            <td class="text-center">{{$sale->saledetail->count()}}</td>
                            <td class="text-right">@currency($sale->total)</td>
                            <td class="text-right"  > <a href="{{route('sale.show', $sale->id)}}"> <i class="fas fa-eye    "></i>&nbsp; Detail</a> </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                        <td>Call of Duty IV</td>
                        <td><span class="badge badge-success">Shipped</span></td>
                        <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>
@endsection
