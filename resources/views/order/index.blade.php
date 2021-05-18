@extends('layouts.app')
@section('title', 'Pesanan Pembelian')

@section('content')
<a name="" id="" class="btn btn-primary  " href="order/create" role="button">Buat Pesanan Pembelian</a>
<div class="card mt-3">
    <div class="card-header border-bottom-0 mt-2">
         <h3 class="card-title">Pesanan Pembelian Baru</h3>
     </div>
     <div class="card-body p-0">
         <table class="table table-hover table-centered mb-0  ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Id Order</th>
                    <th>Tanggal Pesan</th>
                    <th style="width: 20%">Nama Pemasok</th>
                    <th>Jenis Item</th>
                    <th style="width: 10%">Status</th>
                    <th class="text-right" style="width: 20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                    <td> {{$loop->iteration}}   </td>
                    <td> <a href="{{ route('order.show', $order->id) }}">{{$order->id}}</a></td>
                    <td> {{$order->tanggal_order}} </td>
                    <td> {{$order->supplier->nama_supplier}} </td>
                    <td> {{$order->orderdetail->count()}}  </td>
                    {{-- <td> {{$order->orderdetail->count()}}  </td> --}}
                    <td>
                        @switch($order->status)
                            @case(1)
                                <h6><span class="badge badge-pill badge-primary">Belum diproses</span></h6>
                                @break
                            @case(2)
                                <h6><span class="badge badge-pill badge-success">Selesai</span></h6>
                                @break
                            @default
                        @endswitch
                    </td>
                    <td class="text-right">
                        @if ($order->status == '1')
                            @if (Auth::user()->akses == '1')
                            <form action="{{route('order.destroy',$order->id)}}" method="post" id="formdelete{{$loop->iteration}}">
                                @csrf
                                @method('DELETE')
                                <a name="" id="" class="btn btn-primary btn-sm mt-n1" href="{{route('order.edit', $order->id) }}" role="button"><i class="fas fa-pen-alt    "></i></a>
                                <button id="btndelete" onclick="hapus('{{$loop->iteration}}')" type="button" class="btn btn-danger btn-sm mt-n1"><i class="fas fa-trash-alt    "></i></button>
                                <a name="" id="" class="btn btn-info btn-sm mt-n1" href="{{ route('order.show', $order->id) }}" role="button"><i class="fas fa-eye"></i>&nbsp; Lihat Detail</a>
                            </form>
                            @else
                            <a name="" id="" class="btn btn-info btn-sm mt-n1" href="{{ route('order.show', $order->id) }}" role="button"><i class="fas fa-eye"></i>&nbsp; Lihat Detail</a>

                            @endif
                        @else
                            <a name="" id="" class="btn btn-info btn-sm mt-n1" href="{{ route('order.show', $order->id) }}" role="button"><i class="fas fa-eye"></i>&nbsp; Lihat Detail</a>

                        @endif

                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <p>Data belum tersedia</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <div class="card-footer clearfix bg-white">
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