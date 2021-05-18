@extends('layouts.app')
@section('title', 'Tambah Supplier')

@section('content')

<div class="card mt-3 ">
    <div class="card-header">

                <h3 class="card-title">Data Supplier Baru</h3>
    </div>
    <form action="{{ route('supplier.store') }}" method="post">
        <div class="card-body">
            <div class="form-group">
                @csrf
                <label for="nama_supplier">Nama Supplier:</label>
                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                    name="nama_supplier" value="{{ old('nama_supplier') }}" />
                @error('nama_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat_supplier">Alamat:</label>
                <input type="text" class="form-control @error('alamat_supplier') is-invalid @enderror"
                    name="alamat_supplier" value="{{ old('alamat_supplier') }}" />
                @error('alamat_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kota_supplier">Kota:</label>
                <input type="text" class="form-control @error('kota_supplier') is-invalid @enderror"
                    name="kota_supplier" value="{{ old('kota_supplier') }}" />
                @error('alamat_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                    value="{{ old('telepon') }}" />
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <a name="" id="" class="btn btn-secondary" href="/supplier" role="button">Kembali</a>
            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-check    "></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
