@extends('layouts.app')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="card no-print">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Filter</h3>
    </div>
    <div class="card-body row">
        <div class="col-sm-8">
            <div class="row align-items-center">
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
                        <input type="hidden" name="pawal" id="pawal">
                        <input type="hidden" name="pakhir" id="pakhir">
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
                        <button type="button" class="btn btn-info float-right" style="width: 150px" id="btncetak" ><i class="fas fa-print    "></i> Cetak</button>
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
                   <h6>Laporan Penjualan</h6>
                   <h6>Periode <span id="periodeawal"></span> - <span id="periodeakhir"></span> </h6>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="table">
                        <table class="table table-sm" id="mytable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th class="text-right">Total (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody class="datadata">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="1" class="text-right font-weight-bold">Total Rp. <b
                                            id="totaltotal">0</b></td>
                                </tr>
                            </tfoot>
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
        $(document).ready(function () {
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
                var category     = $('#pilihkategori').val();
                var tanggalawal  = $('#tanggalawal').val();
                var tanggalakhir = $('#tanggalakhir').val();

                $("#mytable tbody").empty();
                $.ajax({
                    type: "post",
                    url: "{{route('getlaporanpenjualan.post')}}",
                    data: {
                            // category: category,
                            tanggalawal: tanggalawal,
                            tanggalakhir: tanggalakhir,
                        },
                    dataType: "json",
                    success: function (data) {
                        if (data.total == '0') {
                            $("#mytable tbody").last().append('<tr><td colspan="4" class="text-center">Belum ada data</td></tr>');
                        } else {
                            // alert('blank');
                        var baris = '';
                        $.each(data.detail, function (index, value) {
                            index += 1;
                            baris += '<tr>'+
                                        '<td>'+index+'</td>'+
                                        '<td>'+value.id+'</td>'+
                                        '<td>'+value.created_at+'</td>'+
                                        '<td class="text-right">'+value.total+'</td>'+
                                     '</tr>';
                        });
                        $("#mytable tbody").last().append(baris);
                        $('#totaltotal').html(data.total);
                        $('#periodeawal').html($('#pawal').val());
                        $('#periodeakhir').html($('#pakhir').val());
                        }
                    }
                });
            });
     });
     </script>
@endpush
@push('scripts')
    <script>
        function swalerror(msg) {
            Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan...',
                    text: msg,
                    timer: 2000,
                    showConfirmButton: false,
            })
        }
        $('#btncetak').click(function (e) {
            e.preventDefault();
            if ($('#periodeawal').text() != '') {
                window.print();
            } else {
                swalerror('Silahkan lengkapi data terlebih dahulu');
            }

        });
    </script>
@endpush