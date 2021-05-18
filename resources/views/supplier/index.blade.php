@extends('layouts.app')
@section('title', 'Data Supplier')

@section('content')

<a name="" id="" class="btn btn-info  " href="supplier/create" role="button">Tambah Data Supplier</a>

<div class="card mt-3">
    <div class="card-header border-bottom-0">
        <h3 class="card-title ">Total Supplier = {{ $suppliers->count() }}</h3>
    </div>
    <div class="card-body p-0">
        <div class="table">


        <table class="table table-hover table-centered mb-0   ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Supplier</th>
                    <th>ID Supplier</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{ $supplier->nama_supplier }} </td>
                        <td scope="row">{{ $supplier->id }}</td>
                        <td> {{ $supplier->telepon }}</td>
                        <td> {{ $supplier->alamat_supplier }}</td>
                        <td> {{ $supplier->kota_supplier }}</td>
                        <td class="d-flex justify-content-end">
                            <a name="" id="" class="btn btn-info btn-sm mx-1" href=" {{ route('supplier.edit', $supplier->id) }}" role="button"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form id="formdelete{{$loop->iteration}}" action="{{ route('supplier.destroy', $supplier->id) }}"method="post">
                                @csrf
                                @method('delete')
                                <button id="btndelete" onclick="hapus('{{$loop->iteration}}')" type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt    "></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data
                        </td>
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
                    title: 'Hapus pesanan pembelian?',
                    // text: "Pastikan data yang dibuat telah sesuai",
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