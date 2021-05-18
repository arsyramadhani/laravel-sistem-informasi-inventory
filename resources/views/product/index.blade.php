@extends('layouts.app')
@section('title', 'Data Obat / Barang')

@section('content')
<a name="" id="" class="btn btn-primary  " href="product/create" role="button"><i class="fas fa-plus    "></i> Tambah</a>

<div class="card mt-3">
    <div class="card-header border-transparent">
        <h5 class="card-title">Daftar Obat / Barang</h5>
    </div>
    <div class="card-body p-0" style="display: block;">
        <div class="table-responsive">
            <table class="table table-sm m-0">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kemasan</th>
                    <th>Kategori</th>
                    <th class="text-center">Stok</th>
                    <th class="text-right">Harga Jual</th>
                    <th style="width: 250px" class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$product->id}} </td>
                        <td> {{$product->nama_barang}} </td>
                        <td> {{$product->unit->nama_unit}} </td>
                        <td> {{$product->category->nama_kategori}} </td>
                        <td class="text-center">{{$product->batch->sum('stock')}}</td>
                        <td class="text-right"> @currency($product->harga_jual) </td>
                        <td class="text-right">
                            @if (Auth::user()->akses == '1')
                                <form id="formdelete{{$product->id}}" class="del" action="{{ route('product.destroy', $product->id) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm float-right" onclick="hapus('{{$product->id}}')" type="button"><i class="fas fa-trash-alt    "></i>
                                    Delete</button>
                            </form>
                            @endif
                            <a name="" id="" class="btn btn-info btn-sm mx-1  float-right"
                                href=" {{ route('product.edit', $product->id) }}"
                                role="button"><i class="fas fa-pencil-alt"></i> Edit</a>

                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data obat belum tersedia <br>Silahkan tambah data obat terlebih dahulu </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
        function hapus($no) {
            Swal.fire({
                    title: 'Hapus data barang '+$no+'?',
                    text: "Data yang telah terhapus tidak dapat dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus'
                    }).then((result) => {
                    if (result.value) {
                        $('#formdelete'+$no).submit();
                    }
            });
        }
</script>
@endpush