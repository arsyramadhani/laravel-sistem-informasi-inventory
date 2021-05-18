@extends('layouts.app')
@section('title', 'Buat retur pembelian')

@section('content')
 <div class="mb-3">
    <a name="" id="" class="btn btn-default" href="{{ route('refund.index') }}" role="button"> <i class="fas fa-angle-left    "></i>&nbsp; Kembali</a>
    <button type="button" id="btnsimpan" class="btn btn-primary float-right"> <i class="fas fa-check    "></i>&nbsp; Simpan</button>
</div>

<div class="card card-gray card-outline">
    <div class="card-body">
        <div class="form-row mb-n1">

            <div class="col-4">
                <label class="sr-only" for=""></label>
                <select class="form-control" name="pilihsupplier" id="pilihsupplier">
                    <option value=""></option>
                     @foreach($receives as $receive)
                        <option value="{{ $receive->supplier->id }}" data-id="{{ $receive->supplier->id }}">
                            {{ $receive->supplier->nama_supplier }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label class="sr-only" for=""></label>
                <select class="form-control" name="pilihreceive" id="pilihreceive">
                </select>
            </div>
            <div class="col-3">
                <label class="sr-only" for=""></label>
                <select class="form-control" name="pilihjenis" id="pilihjenis">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-2">
                <button type="button" id="tampildata" class="btn btn-primary btn-block">Tampilkan Data</button>
            </div>
        </div>
    </div>
</div>
<form id="myform" action="{{route('refund.store')}}" method="post">
    @csrf
<div class="card ">
    <div class="card-header ">
        <h3 class="card-title">
            Detail Retur
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 callout callout-info elevation-0 ">
                <dl>
                    <dt>ID Terima Barang</dt>
                    <dd><input class="form-control" type="text" readonly id="dtlidterima" name="dtlidterima" placeholder="Data belum tersedia"></dd>
                    <dt>Tanggal Terima Barang</dt>
                    <dd ><input class="form-control" type="text" readonly  id="dtltanggalterima" name="dtltanggalterima" placeholder="Data belum tersedia"></dd>
                </dl>
            </div>
            <div class="col-sm-3 callout callout-info elevation-0">
                <dl>

                    <dt>No Faktur / Invoice</dt>
                    <dd><input class="form-control" type="text" readonly  id="dtlnofaktur" name="dtlnofaktur" placeholder="Data belum tersedia"></dd>
                    <dt>Tanggal Faktur / Invoice</dt>
                    <dd ><input class="form-control" type="text" readonly  id="dtltanggalfaktur" name="dtltanggalfaktur"  placeholder="Data belum tersedia"></dd>
                </dl>
            </div>
            <div class="col-sm-3 callout callout-info elevation-0">
                <dl>
                    <dt>Dari Pemasok</dt>
                    <dd ">
                         <textarea class="form-control"   disabled name="dtlinfopemasok" id="dtlinfopemasok" rows="4" placeholder="Data belum tersedia" ></textarea>
                    </dd>
                 </dl>
            </div>
            <div class="col-sm-3 callout callout-info elevation-0">
                <dl>
                    <dt>ID Retur Pembelian</dt>
                    <dd><input class="form-control" type="text" readonly  id="idretur" name="idretur" value="{{$idbaru}}" > </dd>
                    <dt>Tanggal</dt>
                    <dd><input class="form-control" type="text" readonly  id="tanggalbaru" name="tanggalbaru" value="{{$tanggalbaru}}" ></dd>
                    <dt>Jenis Retur Pembelian</dt>
                    <dd><input class="form-control" type="text" readonly  id="returjenis" name="returjenis" placeholder="Data belum tersedia" ></dd>
                </dl>
            </div>

        </div>
    </div>
    <div class="card-header mt-n3 ">
        <h3 class="card-title">
            Detail Item
        </h3>
    </div>
    <div class="card-body p-0">
        <table class="table " id="tabeldata">
            <thead>
                <tr>
                    <th style="width: 8%">ID</th>
                    <th>Nama</th>
                    <th>Kemasan</th>
                    <th>No Batch</th>
                    <th>Kadaluwarsa</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Diskon</th>
                    <th class="text-center">Stok</th>
                    <th>Jumlah Retur</th>
                    <th class="text-right" style="width: 250px">Subtotal</th>
                </tr>
            </thead>
            <tbody id="databarang">

            </tbody>
            <tfoot>
                <tr >
                    <th colspan="8"></th>
                    <th colspan="1" class="text-left">Total</th>
                    <th colspan="1" class="text-right px-4">Rp. <input type="text" readonly class="border-0" style="width: 130px; direction:rtl" name="total" id="total" value="0"> </th>
                </tr>
                <tr >
                    <th colspan="8"></th>
                    <th colspan="1" class="text-left">PPN</th>
                    <th colspan="1" class="text-right px-4">Rp. <input type="text" readonly class="border-0" style="width: 130px; direction:rtl" name="ppn" id="ppn" value="0"> </th>
                </tr>
                <tr >
                    <th colspan="8"></th>
                    <th colspan="1" class="text-left">Grand Total</th>
                    <th colspan="1" class="text-right px-4">Rp. <input type="text" readonly class="border-0" style="width: 130px; direction:rtl" name="grandtotal" id="grandtotal" value="0"> </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</form>
@endsection
@push('scripts')
    <script id="notifswal">
        function swalerror(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan...',
                text: msg,
                timer: 2000,
                showConfirmButton: false,
            })
        }

        function swalsuccess(msg) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: msg,
                timer: 2000,
                showConfirmButton: false,
            })
        }

        function clearinfo() {
                    $('#dtlidterima').val('Data belum tersedia');
                    $('#dtltanggalterima').val('Data belum tersedia');
                    $('#dtlnofaktur').val('Data belum tersedia');
                    $('#dtltanggalfaktur').val('Data belum tersedia');
                    $('#dtlinfopemasok').val('Data belum tersedia');
                    $('#total').val('0');
                    $('#grandtotal').val('0');
                    $('#ppn').val('0');
                    $('#returjenis').val('Data belum tersedia');
        }

    </script>
@endpush
@push('scripts')
    <script>
        $('#pilihsupplier').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: 'Pilih Supplier'
        });
        $('#pilihreceive').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: 'Pilih ID Terima Barang / No Faktur'
        });
        $('#pilihjenis').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: Infinity,
             placeholder: 'Pilih Jenis Retur'
        });

        $('#pilihsupplier').on('select2:select', function (e) {
            var id = $('#pilihsupplier').find(':selected').data('id');
             $('#pilihreceive')
                .empty()
                .append('<option></option>');

            $.ajax({
                type: "post",
                url: "{{route('getinvoicebysupplier.post')}}",
                data: {
                        id: id
                    },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (index, item) {
                            $('#pilihreceive').append($('<option>', {
                                'value'     : item.id,
                                'text'      : item.id+ ' | ' +item.invoice,
                                'data-id'   : item.id,
                                'data-before': item.return_before,
                                'data-limit' : item.return_limit,
                            }));
                        });
                }
            });
        });

        $('#pilihsupplier').on('select2:clear', function (e) {
             $('#pilihreceive').val(null).trigger('change');
             $('#pilihreceive').empty();
             $('#pilihjenis').val(null).trigger('change');
             $('#pilihjenis').empty();
             $('#databarang').empty();
             clearinfo();
         });

        $('#pilihreceive').on('select2:clear', function (e) {
             $('#pilihjenis').val(null).trigger('change');
             $('#pilihjenis').empty();
             $('#databarang').empty();
            clearinfo();
         });

        $('#pilihreceive').on('select2:select', function (e) {
            $('#pilihjenis').empty();
            $('#pilihjenis').append('<option value=""></option>');
            $('#pilihjenis').append('<option value="1" data-id="1">Barang Rusak</option>');
            $('#pilihjenis').append('<option value="2" data-id="2">Barang Kadaluwarsa</option>');
        });

        $('#pilihjenis').on('select2:select', function (e) {
            var jenisid = $('#pilihjenis').find(':selected').data('id');
            var limit   = $('#pilihreceive').find(':selected').data('limit');
            var before  = moment($('#pilihreceive').find(':selected').data('before'), 'YYYY-MM-DD');
            var now     = moment();
            var fin = before.diff(now, 'days');

            switch (jenisid) {
                case 1:
                    if (fin <= 3) {
                            swalerror('Batas waktu retur barang sudah habis');
                            $('#pilihjenis').empty();
                            $('#pilihjenis').append('<option value=""></option>');
                            $('#pilihjenis').append('<option value="1" data-id="1">Barang Rusak</option>');
                            $('#pilihjenis').append('<option value="2" data-id="2">Barang Kadaluwarsa</option>');
                     } else {
                     }
                    break;
                case 2:
                     break;
            }
        });
        $('#tampildata').click(function (e) {
        var id = $('#pilihreceive').find(':selected').data('id');
        var jenisid = $('#pilihjenis').find(':selected').data('id');

        $('#returjenis').val($('#pilihjenis').find(':selected').text());

        switch (jenisid) {
            default:
            swalerror('Silahkan pilih data dengan lengkap');
                break;
            case 1:
            case 2:

            $.ajax({
                type: "post",
                url: "{{route('getdetail.post')}}",
                data: {
                        id: id
                    },
                dataType: "json",
                success: function (data) {
                    $('#dtlidterima').val(data.id);
                    $('#dtltanggalterima').val(data.receive_date);
                    $('#dtlnofaktur').val(data.invoice);
                    $('#dtltanggalfaktur').val(data.invoice_date);
                    $('#dtlinfopemasok').text(data.supplier.nama_supplier +"\n"+ data.supplier.telepon +"\n"+ data.supplier.alamat_supplier +"\n"+ data.supplier.kota_supplier);
                }
            });
            $('#databarang').empty();
            var tbody = $('#tabeldata').children('tbody');
            var row = $("#tabeldata tbody tr").length + 1;
            $.ajax({
                type: "post",
                url: "{{route('getproductdetail.post')}}",
                data: {
                        id: id
                    },
                dataType: "json",
                success: function (data) {
                    var baris = '';
                    $.each(data, function (index, value) {
                         baris +=   '<tr id="row' + index + '">'+
                                    '<td><input readonly type="text" name="product[]" id="product'+row+'" class="border-0" style="width: 92px" value="'+value.product_id+'"></td>'+
                                    '<td>'+value.product.nama_barang+'</td>'+
                                    '<td>'+value.product.unit.nama_unit+'</td>'+
                                    '<td><input type="hidden" name="batchid[]" id="batchid'+row+'" value="'+value.batch.id+'"><input readonly style="width: 80px" class="border-0" type="text" name="batch[]" id="batch'+row+'" value="'+value.batch.no_batch+'"></td>'+
                                    '<td>'+value.batch.expiry_date+'</td>'+
                                    '<td class="text-right">Rp. <input readonly type="text" style="width: 90px; direction:rtl" class="harga border-0" name="harga[]" id="harga'+row+'" value="'+value.buy_price+'"></td>'+
                                    '<td class="text-center"><input readonly type="text" class="diskon border-0" style="width: 40px" name="diskon[]" id="diskon'+row+'" value="'+value.discount+'"></td>'+
                                    '<td class="text-center"><input readonly type="text class="stock" style="width: 40px;border:0" name="stock[]" id="stock'+row+'" value="'+value.batch.stock+'"></td>'+
                                    '<td><input type="number" class=" qtydatang" style="width: 75px;border:0" id="qty' + row + '" name="qty[]" max="'+value.batch.stock+'" min="0" value="0"></td>'+
                                    '<td class="text-right">Rp. <input readonly class="subtotal border-0" style="width:130px;direction:rtl" type="text" name="subtotal[]" id="subtotal'+row+'"></td>'+
                                    '</tr>';
                    });
                    $("#tabeldata tbody").last().append(baris);
                }
            });
                break;
        }
        });
    </script>
@endpush
@push('scripts')
    <script>
        $('#databarang').change(function () {
            updateSubtotal();
        });
        function updateSubtotal() {
            $('.qtydatang').each(function () {
                var row     = $(this).closest('tr');
                var harga   = parseInt(row.find('.harga').val());
                var qty     = parseInt(row.find('.qtydatang').val());
                var disc    = parseInt(row.find('.diskon').val());
                var percent = (disc / 100).toFixed(2);
                var subzero = row.find('.subtotal').val(0);

                var totaldisc = parseInt(((row.find('.harga').val()) * percent) * qty);
                var sub       = parseInt(((row.find('.harga').val()) * qty) - totaldisc);
                row.find('.subtotal').val(sub);
                updateTotal()
            });
        }
        function updateTotal() {
            var total = 0;
                $('.subtotal').each(function() {
                    total += parseInt($(this).val());
                });
            $('#total').val(total);
            updateGrandtotal();
        }
        function updateGrandtotal() {
            var harga      = parseInt($('#total').val());
            // var ppn        = parseInt($('#ppn').children("option:selected").val());
            var ppn        = parseInt('10');
            var totalppn   = (ppn / 100).toFixed(2);
            var grandtotal = (harga * totalppn);
            $('#ppn').val(grandtotal);
            $('#grandtotal').val(grandtotal + harga);
        }
    </script>
@endpush
@push('scripts')
    <script>
        $('#btnsimpan').click(function () {
             if ($('#grandtotal').val() == '0') {
                swalerror('Silahkan masukkan data dengan benar');
            } else {
                        Swal.fire({
                        title: 'Buat retur pembelian?',
                        text: 'Pastikan data telah sesuai',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Lanjutkan'
                    }).then((result) => {
                        if (result.value) {

                            $('#myform').submit();
                        }
                    });
            }
        });
    </script>
@endpush