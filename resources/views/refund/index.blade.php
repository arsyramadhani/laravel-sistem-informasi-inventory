@extends('layouts.app')
@section('title', 'Retur Pembelian Barang')

@section('content')
<div class="mb-3">
    <a name="" id="" class="btn   bg-olive" href="{{route('refund.create')}}" role="button">Buat retur pembelian</a>
</div>
<div class="card">
    <div class="card-header border-transparent">
        <h6 class="card-title">Data Retur Pembelian</h6>

    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Retur</th>
                        <th>Tanggal Retur</th>
                        <th>Supplier</th>
                        <th class="text-center" >Jumlah</th>
                        <th>Keterangan</th>
                        <th class="text-right">Nilai Retur</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($refunds as $refund)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$refund->id}} </td>
                            <td> {{$refund->refund_at}} </td>
                            <td> {{$refund->receive->supplier->nama_supplier}} </td>
                            <td class="text-center"> {{$refund->refunddetail->count()}} </td>
                            <td> {{$refund->cause}} </td>
                            <td class="text-right"> @currency($refund->total)</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-primary mt-n1" href="{{route('refund.show', $refund->id)}}" role="button">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Data belum tersedia</p>
                                </td>
                            </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
     </div>
</div>
@endsection