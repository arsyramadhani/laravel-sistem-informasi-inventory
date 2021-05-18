@extends('layouts.app')
@section('title', 'Edit Supplier')

@section('content')
<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
             <div class="form-group">
              <label for="">ID Supplier</label>
             <input type="text" name="" disabled id="" class="form-control" placeholder="" value="{{$supplier->id}}" aria-describedby="helpId">
             </div>
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="nama_supplier">Nama Supplier:</label>
                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                    name="nama_supplier" value="{{ $supplier->nama_supplier }}" />
                @error('nama_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat_supplier">Alamat:</label>
                <input type="text" class="form-control @error('alamat_supplier') is-invalid @enderror"
                    name="alamat_supplier" value="{{ $supplier->alamat_supplier }}" />
                @error('alamat_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kota_supplier">Kota:</label>
                <input type="text" class="form-control @error('kota_supplier') is-invalid @enderror"
                    name="kota_supplier" value="{{ $supplier->kota_supplier }}" />
                @error('alamat_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                    value="{{ $supplier->telepon }}" />
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="float-right">
                <a name="" id="" class="btn btn-secondary" href="/supplier" role="button">Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check    "></i> Simpan</button>
            </div>
        </form>
    </div>
</div>


@endsection
