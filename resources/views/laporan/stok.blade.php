@extends('layouts.app')
@section('title', 'Laporan Stok Obat')

@section('content')
<div class="card no-print">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Filter</h3>
    </div>
    <div class="card-body row">
        <div class="col-sm-8">
            <form method="GET" action="/laporan/stok">
            <div class="row align-items-center">
                    <div class="col-auto">
                       <strong>Kategori</strong>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="pilihkategori" id="pilihkategori">
                            <option value="0">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                                @endforeach
                          </select>
                    </div>
                    <div class="col-auto">
                        <div>

                            <button type="submit" class="btn btn-primary">Cari Data</button>
                        </div>

                       {{-- <a name="caridata" id="caridata" class="btn btn-primary" href="#" role="button"><i class="fas fa-search    "></i>&nbsp; Cari Data</a> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <div class="row ">
                    <div class="col-12">
                        <button type="button" id="btncetak" class="btn btn-info float-right" style="width: 150px" ><i class="fas fa-print    "></i> Cetak</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="invoice border-0 py-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                   <h4 class="font-weight-bold">{{strtoupper($info->nama)}}</h4>
                   <h6>Laporan Stok</h6>
                   <h6>Kategori : <span id="kategori">
                       @if ($kategori == '0')
                            Semua Kategori
                       @else
                            {{$kategori->nama_kategori}}
                       @endif
                       </span></h6>
                   <h6>Per<span id="periodeawal"></span> {{date('d-m-Y', strtotime($tanggal))}} <span id="periodeakhir"></span> </h6>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="table">
                        <table class="table table-sm" id="mytable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>ID Barang</th>
                                    <th>Kemasan</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Jumlah Stok</th>
                                </tr>
                            </thead>
                            <tbody class="datadata">
                                @foreach ($details as $item)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$item->nama_barang}} </td>
                                        <td> {{$item->id}} </td>
                                        <td> {{$item->unit->nama_unit}} </td>
                                        <td> {{$item->category->nama_kategori}} </td>
                                        <td class="text-center"> {{$item->batch->sum('stock')}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-5 print-only">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="text-center">
                        <br>
                        <br>
                        {{$info->kota}}, {{date('d-m-Y', strtotime($tanggal))}} <br>
                        Mengetahui <br>
                        <br>
                        <br>
                        <br>
                        <strong> {{$info->apoteker}} </strong><br>
                        Apoteker
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
    <style>
    .print-only{
        display: none;
    }

    @media print {

        .print-only{
            display: flex;
        }
}
</style>
@endpush
@push('scripts')
    <script>
        $('#btncetak').click(function (e) {
            e.preventDefault();
            window.print();
        });
    </script>
@endpush