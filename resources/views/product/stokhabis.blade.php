@extends('layouts.app')
@section('title', 'Stok Barang Habis')

@section('content')
<div class="card  card-danger card-outline">
    <div class="card-header border-transparent">
        <h6 class="card-title font-weight-bold">Stok barang habis</h6>

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
                        <th class="text-center">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->batch->sum('stock') == 0)
                            <tr>
                                <td> {{$product->id}} </td>
                                <td> {{$product->nama_barang}} </td>
                                <td> {{$product->unit->nama_unit}} </td>
                                <td> {{$product->category->nama_kategori}} </td>
                                <td class="text-center">{{$product->batch->sum('stock')}}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card  card-warning card-outline">
    <div class="card-header border-transparent">
        <h6 class="card-title font-weight-bold">Stok barang kurang dari 3 </h6>

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
                        <th class="text-center">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->batch->sum('stock') <= 3 && $product->batch->sum('stock') > 0)
                            <tr>
                                <td> {{$product->id}} </td>
                                <td> {{$product->nama_barang}} </td>
                                <td> {{$product->unit->nama_unit}} </td>
                                <td> {{$product->category->nama_kategori}} </td>
                                <td class="text-center">{{$product->batch->sum('stock')}}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection