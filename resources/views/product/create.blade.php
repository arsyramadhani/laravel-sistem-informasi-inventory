@extends('layouts.app')
@section('title', 'Tambah Barang')

@section('content')
<div class="card mt-3 ">
    <div class="card-header">
        <h3 class="card-title">Data Obat</h3>
    </div>
    <form action="{{route('product.store')}}" method="post">
        <div class="card-body">
            <div class="form-group">
                @csrf
                <label for="nama_barang">Nama Barang / Obat:</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                    name="nama_barang" value="{{ old('nama_barang') }}" />
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="unit_id">Kemasan:</label>
                <select class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" >
                    <option value="0">Pilih Kemasan / Satuan</option>
                    @foreach ($units as $unit)
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
                    <option value='0'>Pilih Kategori</option>
                    @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                    @endforeach
                  </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="card-footer">
            <a name="" id="" class="btn btn-secondary" href="/product" role="button">Kembali</a>
            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-check    "></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
