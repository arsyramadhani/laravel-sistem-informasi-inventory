@extends('layouts.app')
@section('title', 'Edit Data Barang')
@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/product" role=" button">Kembali</a>
    <button id="btnsimpan" class="btn btn-primary float-right"><i class="fas fa-check    "></i>&nbsp; Simpan</button>
</div>
<form id="myform" action="{{route('product.update', $product->id)}}" method="post">
<div class="row">
    <div class="col-sm-6">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Data Obat</h3>
            </div>

                <div class="card-body">
                    <div class="form-group">
                    <label for="">ID Barang</label>
                    <input type="text" name="" disabled id="" class="form-control" placeholder="" value="{{$product->id}}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="nama_barang">Nama Barang / Obat:</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                        name="nama_barang" value="{{$product->nama_barang}}" />
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_id">Kemasan:</label>
                        <select class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" >
                            {{-- <option value="0" selected>Pilih Kemasan</option> --}}
                            <option selected value="{{$product->unit_id}}">{{$product->unit->nama_unit}}</option>
                            @foreach ($units->except($product->unit_id) as $unit)
                            <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" >
                            <option selected value="{{$product->category_id}}">{{$product->category->nama_kategori}}</option>
                            @foreach ($categories->except($product->category_id) as $category)
                            <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Harga Jual</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                  <label for="">Harga Lama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" id="oldprice" name="oldprice" value="{{$product->harga_jual}}" readonly>
                    </div>
                 </div>
                <div class="form-group">
                  <label for="">Harga Baru</label>
                  <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" min="0" id="newprice" name="newprice" max="9999999" value="{{$product->harga_jual}}">
                    </div>
                 </div>
                <hr>
                <br>
                <h3 class="card-title ">Riwayat Harga Pembelian</h3>
            </div>
            <div class="card-body p-0 mt-n2 ">
                <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>No Faktur / Invoice</th>
                                <th>No Batch</th>
                                <th class="text-right">Harga Beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($harga as $harga)
                                <tr>
                                    <td> {{$harga->receive->receive_date}} </td>
                                    <td> {{$harga->receive->supplier->nama_supplier}} </td>
                                    <td> {{$harga->receive->invoice}} </td>
                                    <td> {{$harga->batch->no_batch}} </td>
                                    <td class="text-right"> @currency($harga->buy_price) </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Data riwayat pembelian tidak tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
            <div class="card-footer bg-white">

            </div>
        </div>
    </div>
</div>
</form>

@endsection
@push('scripts')
    <script>
        $('#btnsimpan').click(function () {
            if ($.trim($('[name="nama_barang"]').val()) === '') {
                swalerror('Nama Barang Tidak Boleh Kosong');
            } else {
                $('#myform').submit();
            }
        });


        function swalerror(msg) {
            Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan...',
                    text: msg,
                    timer: 2500,
                    showConfirmButton: false,
            })
        }
    </script>
@endpush