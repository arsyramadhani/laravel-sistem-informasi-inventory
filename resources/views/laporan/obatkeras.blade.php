@extends('layouts.app')
@section('title', 'Laporan Keluar Masuk Obat')

@section('content')
<div class="card no-print">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Filter</h3>
    </div>
    <form action="{{route('laporan.obatkeras')}}" method="get" id="myform">
    <div class="card-body row">
            @csrf
        <div class="col-sm-8">
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
                       <strong>Pilih Periode</strong>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text  bg-white"><i class="fas fa-calendar-alt    "></i></div>
                            </div>
                            <input type="text" class="form-control" name="periode" id="periode">
                        </div>
                        <input type="hidden" name="tanggalawal" id="tanggalawal">
                        <input type="hidden" name="tanggalakhir" id="tanggalakhir">
                    </div>
                    <div class="col-auto">
                       <a name="caridata" id="caridata" class="btn btn-primary" href="#" role="button"><i class="fas fa-search    "></i>&nbsp; Cari Data</a>
                    </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row ">
                    <div class="col-12">
                        <button type="button" id="btncetak" class="btn btn-info float-right" style="width: 150px" ><i class="fas fa-print    "></i> Cetak</button>
                    </div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="card">
    <div class="card-body">
        <div class="invoice border-0 py-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                   <h4 class="font-weight-bold">{{strtoupper($info->nama)}}</h4>
                   <h6>Laporan Keluar Masuk Obat</h6>
                   <h6>Kategori :
                       @if ($kategori == '0')
                            Semua Kategori
                       @else
                            {{$kategori->nama_kategori}}
                       @endif
                    </h6>
                   <h6>Periode <span id="periodeawal">{{date('d-m-Y', strtotime($tanggalawal))}}</span> - <span id="periodeakhir">{{date('d-m-Y', strtotime($tanggalakhir))}}</span> </h6>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="table">
                        <table class="table table-sm" id="mytable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Obat</th>
                                    <th>Kode Obat</th>
                                    <th>Kemasan</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Jumlah Masuk</th>
                                    <th class="text-center">Jumlah Keluar</th>
                                </tr>
                            </thead>
                            <tbody class="datadata">
                                @foreach ($data as $item)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$item->nama_barang}} </td>
                                        <td> {{$item->id}} </td>
                                        <td> {{$item->unit->nama_unit}} </td>
                                        <td> {{$item->category->nama_kategori}} </td>
                                        <td class="text-center"> {{$item->receivedetail->sum('qty')}} </td>
                                        <td class="text-center"> {{$item->saledetail->sum('qty')}} </td>
                                     </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="8"></td>
                                    <td colspan="1" class="font-weight-bold">Total</td>
                                    <td colspan="1" class="text-right font-weight-bold"><b id="totaltotal">0</b></td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
                        <div class="row mt-3 print-only">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="text-center">
                        <br>
                        <br>
                        {{$info->kota}}, {{ \Carbon\Carbon::parse(now())->format('j F, Y') }} <br>
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
  // Tanggal
            var start = moment().startOf('month');
            var end = moment().endOf('month');

            function cb(start, end) {
                $('#periode').val(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
                $('#tanggalawal').val(start.format('YYYY-MM-DD 00:00:00'));
                $('#tanggalakhir').val(end.format('YYYY-MM-DD 23:59:59'));
                $('#pawal').val(start.format('DD-MM-YYYY'));
                $('#pakhir').val(end.format('DD-MM-YYYY'));

            }

            $('#periode').daterangepicker({
                autoApply: true,
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        // Tanggal End
        $('#caridata').click(function () {
            $('#myform').submit();

        });
    </script>
@endpush
@push('scripts')
    <script>
        $('#btncetak').click(function (e) {
            e.preventDefault();
            window.print();
        });
    </script>
@endpush