@extends('layouts.app')
@section('title', 'Penjualan')

@section('content')
<div class="row ">
    <div class="col-sm-8">
        <div class="card card-primary card-outline ">
            <div class="card-body">
                <div class="form-row align-items-center">
                    <div class="col-sm-8">
                         <select name="selectitem" id="selectitem" class="form-control mb-2 selectitem">
                            <option value="0">Pilih Barang / Obat</option>
                            @foreach ($products as $product)
                                @if (($product->product->harga_jual) > 1)
                                <option
                                    value="{{$product->product_id}}"
                                    data-stok="{{$product->stock}}"
                                    data-id="{{$product->product_id}}"
                                    data-nama="{{$product->product->nama_barang}}"
                                    data-batch="{{$product->id}}"
                                    data-harga="{{$product->product->harga_jual}}"
                                    data-unit="{{$product->product->unit->nama_unit}}">
                                    {{$product->product->nama_barang}} | @currency($product->product->harga_jual) | Stok: {{$product->stock}} | Exp: {{$product->expiry_date}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control " min="1" max="" id="qtyinput" >
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="btntambah" class="btn btn-primary btn-block">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('sale.store')}}" id="myform"  method="post">
            @method('post')
            @csrf

        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Data Barang</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-condensed" id="tabeldata">
                    <thead class="bg-white">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kemasan</th>
                            <th class="text-center">Stok</th>
                            <th style="width: 15%">Harga</th>
                            <th>Jumlah</th>
                            <th style="width: 15%">Subtotal</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="databarang">
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary card-outline">
            <div class="card-body p-3">
                <div class="form-row mt-n2 mb-n3">
                    <div class="form-group col-6">
                        <label class="small" for="">ID Transaksi ( Auto )</label>
                    <input type="text" name="idtransaksi" id="idtransaksi" class="form-control" value="{{$idbaru}}"  readonly>
                    </div>
                    <div class="form-group col-6">
                        <label class="small" for="">Tanggal</label>
                        <input type="text" name="tanggal" id="tanggal" class="form-control" value="{{$tanggalskrg}}"  readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-danger card-outline collapsed-card">
            <div class="card-header">
              <h6 class="card-title">Resep (Isi Jika Ada)</h6>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="form-row mt-n2 ">
                    <div class="form-group col-8">
                        <label class="small" for="">Nama Pasien</label>
                        <input type="text" name="pasien" id="pasien" value="" class="form-control" >
                    </div>
                    <div class="form-group col-4">
                        <label class="small" for="">Usia</label>
                        <input type="number" name="usia" id="usia" min="1" max="111" value="0" class="form-control" >
                    </div>
                </div>
                    <div class="form-group">
                        <label class="small" for="">Nama Dokter</label>
                        <input type="text" name="dokter" id="dokter" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label class="small" for="">Tanggal Buat Resep</label>
                        <input type="text" name="tanggalresep" id="tanggalresep" class="form-control">
                    </div>
            </div>
        </div>
        <div class="card card-success card-outline">
            <div class="card-body p-3">
                <div class="form-group">
                  <label class="small" for="">Total Tagihan</label>
                  <div class="input-group">
                    <div class="input-group-prepend ">
                            <span class="input-group-text "><b>Rp.</b></span>
                    </div>
                    <input type="text" name="total" id="total" class="form-control" min="0" value="0" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="small" for="">Total Bayar</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend ">
                            <span class="input-group-text "><b>Rp.</b></span>
                    </div>
                    <input type="text" name="bayar" id="bayar" class="form-control" min="0" value="0">
                    <div class="input-group-append ">
                            <button type="button" id="hapusbayar" class="btn btn-info"><i class="fas fa-redo    "></i></button>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="small" for="">Total Kembali</label>
                  <div class="input-group">
                    <div class="input-group-prepend ">
                            <span class="input-group-text "><b>Rp.</b></span>
                    </div>
                    <input type="text" name="kembali" id="kembali" class="form-control" min="0" value="0" readonly>
                  </div>
                </div>
                <button type="button" id="btnsimpan" class="btn btn-success btn-block">Simpan</button>
            </div>

        </div>
        </form>

    </div>
</div>
@endsection
@push('scripts')
    <script>
         $('#selectitem').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih Obat / Barang",
            allowClear: false,
            minimumInputLength: 2,
        });
        $('#tanggalresep').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '-3m',
            endDate: '0d',
            todayHighlight: true,
            forceParse: true,
        }).datepicker('setDate', '0d');

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
        function swalconfirm(msg) {
            Swal.fire({
                title: 'Buat penjualan?',
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan'
                 }).then((result) => {
                if (result.value) {
                    //  swalsuccess('yayaya');

                    $('#myform').submit();
                }
            });
        }
    </script>
@endpush
@push('scripts')
    <script>
        $('#selectitem').change(function () {
            var datastok = $(this).children("option:selected").attr('data-stok');
            $('#qtyinput').attr('max', datastok);
            $('#qtyinput').val(1);
        });
    </script>
@endpush
@push('scripts')
    <script>
        $('#btntambah').click(function () {
             if ( $('#selectitem').val() == '0' ) {
                swalerror('Silahkan pilih item terlebih dahulu');
            } else if($('#qtyinput').val() < 1) {
                swalerror('Silahkan masukkan jumlah pembelian dengan benar');
                $('#qtyinput').val(1);
            } else if ( $('#qtyinput').val() > $('#selectitem').children("option:selected").attr('data-stok')) {
                swalerror('Jumlah pembelian tidak boleh melebihi jumlah stok');
                $('#qtyinput').val($('#qtyinput').attr('max'));
            } else {
                tambahrow();
            }
        });

        function tambahrow() {
            var tbody = $('#tabeldata').children('tbody');
            var row = $("#tabeldata tbody tr").length + 1;
            var namabarang = $('#selectitem').children("option:selected").attr('data-nama');
            var stokbarang = $('#selectitem').children("option:selected").attr('data-stok');
            var idbarang = $('#selectitem').children("option:selected").attr('data-id');
            var unitbarang = $('#selectitem').children("option:selected").attr('data-unit');
            var batchbarang = $('#selectitem').children("option:selected").attr('data-batch');
            var qtybarang = $('#qtyinput').val();
            var hargabarang = $('#selectitem').children("option:selected").attr('data-harga');

            var baris = '<tr id="row' + row + '">'+
                            '<td>'+namabarang+'<input type="hidden" id="idbarang'+row+'" name="idbarang[]" value="'+idbarang+'"><input type="hidden" id="batchbarang'+row+'" name="batchbarang[]" value="'+batchbarang+'"><input type="hidden" id="stokbarang'+row+'" name="stokbarang[]" value="'+stokbarang+'"></td>'+
                            '<td>'+unitbarang+'</td>'+
                            '<td class="text-center">'+stokbarang+'</td>'+
                            '<td class="text-center"><input type="number" value="'+hargabarang+'" readonly class="form-control form-control-sm mt-n1 bg-white border-0 hargabarang"></td>'+
                            '<td><input type="number" class="form-control form-control-sm mt-n1 qtybarang" value="'+qtybarang+'" min="1" max="'+stokbarang+'" id="qty'+row+'" name="qty[]"></td>'+
                            '<td><input type="number" readonly class="form-control form-control-sm mt-n1 subtotal bg-white border-0" id="subtotal'+row+'" ></td>'+
                            '<td class="text-right"> <button type="button" class="btn btn-default btn-block btn-sm mt-n1"><i class="fas fa-trash    " onclick="removerow('+row+')"></i></button></td>'+
                        '</tr>';
                        $("#tabeldata tbody").last().append(baris);
                        $('#selectitem').val(0).trigger('change.select2');

            updateSubtotal();
        }
        $('#bayar').change(function() {
            updateKembali();

        });
        function updateSubtotal() {
            $('.qtybarang').each(function () {
                var row = $(this).closest('tr');
                var harga = parseInt(row.find('.hargabarang').val());
                var qty  = parseInt(row.find('.qtybarang').val());
                row.find('.subtotal').val(harga*qty);
                updateTotal();
                updateKembali();
            });
        }
        function updateTotal() {
            var total = 0;
                $('.subtotal').each(function() {
                    total += parseInt($(this).val());
                });
            $('#total').val(total);
        }
        function updateKembali() {
            var total = parseInt($('#total').val());
            var bayar = parseInt($('#bayar').val());
            var kembali = bayar - total;

            $('#kembali').val(kembali);
        }
        function removerow(row) {
            $('#databarang tr#row'+row).remove();
            if ($("#tabeldata tbody tr").length > 0) {
                     updateSubtotal();
                     updateKembali();
            } else {
                    $('#total').val(0);
                    $('#kembali').val(0);
                    $('#bayar').val(0);
            }
        }
        $('#databarang').change(function () {
            updateSubtotal();
        });
        $('#hapusbayar').click(function() {
            $('#bayar').val(0);
            updateKembali();
        });
    </script>
@endpush
@push('scripts')
    <script>
         $('#btnsimpan').click(function () {
            if ($("#tabeldata tbody tr").length <= 0) {
                swalerror('Masukkan minimal 1 item sebelum melanjutkan');
            } else if ($('#bayar').val() < 1) {
                swalerror('Total bayar tidak boleh kosong');
            } else if ( $('#kembali').val() < 0 ) {
                swalerror('Masukkan total pembayaran dengan benar');
            }  else {
                if ($.trim($('#pasien').val()) != '') {
                    if ($('#usia').val() == 0) {
                        swalerror('Silahkan isi usia pasien');
                    } else if ($.trim($('#dokter').val()) == '') {
                        swalerror('Silahkan isi nama dokter');
                    } else {

                    swalconfirm('Total penjualan adalah Rp. '+$('[name=total]').val());
                    }
                } else {
                    swalconfirm('Total penjualan adalah Rp. '+$('[name=total]').val());
                 }
            }
        });

    </script>
@endpush