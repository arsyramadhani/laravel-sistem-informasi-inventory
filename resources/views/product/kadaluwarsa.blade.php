@extends('layouts.app')
@section('title', 'Stok Kadaluwarsa')

@section('content')
<div class="card  card-warning card-outline">
    <div class="card-header border-transparent">
        <h6 class="card-title font-weight-bold">Barang mendekati kadaluwarsa</h6>

    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kemasan</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Nomor Pembelian</th>
                        <th class="text-center">Stok</th>
                        <th class="text-right">Tanggal Kadaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($almostexpired as $item)
                        <tr>
                            <td> {{$item->product->id}} </td>
                            <td> {{$item->product->nama_barang}} </td>
                            <td> {{$item->product->unit->nama_unit}} </td>
                            <td> {{$item->product->category->nama_kategori}} </td>
                            <td> {{$item->receive->supplier->nama_supplier}} </td>
                            <td> {{$item->receive->invoice}} </td>
                            <td class="text-center"> {{$item->batch->stock}} </td>
                            <td class="text-right"> {{$item->batch->expiry_date}} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card  card-danger card-outline">
    <div class="card-header border-transparent">
        <h6 class="card-title font-weight-bold">Stok kadaluwarsa</h6>

    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kemasan</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Nomor Pembelian</th>
                        <th class="text-center">Stok</th>
                        <th class="text-right">Tanggal Kadaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expired as $item)
                        <tr>
                            <td> {{$item->product->id}} </td>
                            <td> {{$item->product->nama_barang}} </td>
                            <td> {{$item->product->unit->nama_unit}} </td>
                            <td> {{$item->product->category->nama_kategori}} </td>
                            <td> {{$item->receive->supplier->nama_supplier}} </td>
                            <td> {{$item->receive->invoice}} </td>
                            <td class="text-center"> {{$item->batch->stock}} </td>
                            <td class="text-right"> {{$item->batch->expiry_date}} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection