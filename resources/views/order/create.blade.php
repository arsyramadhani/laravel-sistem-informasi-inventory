@extends('layouts.app')
@section('title', 'Pesanan Pembelian Baru')

@section('content')
<form action="{{route('order.store')}}" id="myform"  method="post">
    @method('post')
    @csrf
<div class="mb-3">
    <a name="" id="" class="btn btn-default" href="/order"" role=" button">Kembali</a>
    <button type="button" id="btnsave" class="btn btn-primary float-right"><i class="fas fa-print    "></i>&nbsp; Simpan</button>
</div>
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Detail</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>ID Pesanan (Auto)</label>
                    <input type="text" class="form-control" readonly value="{{ $ids }}" name="idpesanan">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-alt    "></i></span>
                        </div>
                        <input type="text" class="form-control" name="tanggal_order" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Supplier</label>
                    <select id="pilihsupplier" name="pilihsupplier" class="custom-select">
                        <option value="0">Pilih Supplier</option>
                        @foreach($suppliers as $sup)
                            <option value="{{ $sup->id }}">{{ $sup->nama_supplier }} | {{ $sup->kota_supplier }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Item</h3>
    </div>
    <div class="card-body p-0">
        <table class="table mb-3" id="tabeldata">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 30%">Nama Item</th>
                    <th>Kemasan</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Jumlah</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                    <tr>
                        <th colspan="7"><button id="tambahitem" type="button" class="btn btn-success"><i class="fas fa-plus-circle "></i> Tambah Item</button></th>
                    </tr>
            </tfoot>
        </table>
    </div>

</form>

@endsection
@push('scripts')
    <script type="text/javascript">
         $('#pilihsupplier').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih Supplier",
            allowClear: false,
            minimumInputLength: 3,
        });

        $('input[name="tanggal_order"]').daterangepicker({
            locale: {
                "format": "DD-MM-YYYY",
            },
            singleDatePicker: true,
            showDropdowns: true,
            minDate: moment().subtract(2, 'd'),
            maxDate: moment().add(7, 'd'),
        });

            $('#tambahitem').click( function (e) {
                e.preventDefault();
                var tbody = $('#tabeldata').children('tbody');
                var row = $("#tabeldata tbody tr").length + 1;

                $.ajax({
                    type: "post",
                    url: "/order/getproduct",
                    success: function (data) {
                        var baris = '<tr id="row' + row + '">' +
                            '<td>' + row + '</td>' +
                            '<td><input type="hidden" class="form-control idbarang" id="idbarang' + row + '" name="idbarang[]">'+
                            '<select onChange="getdetail(' + row + ')" id="prod' + row + '" name="product[]" class="form-control selectproduct">'+
                            '<option value="0">Pilih Item</option>';
                        $.each(data, function (index, value) {
                            baris += '<option value="' + value.id + '">' + value.nama_barang + '</option>';
                        });
                        baris += '</select></td>' +
                            '<td><input type="text" class="form-control" id="unit' + row + '" name="unit" disabled></td>' +
                            '<td><input type="text" class="form-control" id="category' + row + '" name="category" disabled></td>' +
                            '<td><input type="text" class="form-control" id="stok' + row + '" name="stok" disabled></td>' +
                            '<td><input type="number" class="form-control" id="qty' + row + '" name="qty[]" min="0" value="0"></td>' +
                            '<td><button onclick="removerow('+row+')" class="btn btn-default "><i class="fas fa-trash-alt "></i></button></td>' +
                            '</tr>';

                        $("#tabeldata tbody").last().append(baris);
                    }
                });
            });


        function getdetail(row) {
            var id = $("#prod" + row).val();

            if (id=="0") {
                    $('#idbarang' + row + '').val('');
                    $('#unit' + row + '').val('');
                    $('#category' + row + '').val('');
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('productbyid.post') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        $('#idbarang' + row + '').val(data[0].id);
                        $('#unit' + row + '').val(data[0].unit.nama_unit);
                        $('#category' + row + '').val(data[0].category.nama_kategori);
                        $('#stok' + row + '').val(data[1]);
                    }
                });
            }
        };
        function removerow(row) {
            $('#tabeldata tbody tr#row'+row).remove();
        }
    </script>
@endpush
@push('scripts')
    <script id="validasi">
        $('#btnsave').click(function ( ) {
            if ($('[name="pilihsupplier"]').val() == '0') {
                swalerror('Silahkan isi data supplier dengan benar');
            } else if ($('#tabeldata tbody tr').length == '0') {
                swalerror('Silahkan tambah item terlebih dahulu');
            } else if ($('.selectproduct').val() === '0') {
                swalerror('Silahkan pilih item terlebih dahulu');
            } else if ($('[id^=qty]').val() == '0') {
                swalerror('Jumlah barang tidak boleh kosong');
            } else {
                Swal.fire({
                    title: 'Buat pesanan pembelian?',
                    text: "Pastikan data yang dibuat telah sesuai",
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

        function swalerror(msg) {
            Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan...',
                    text: msg,
                    timer: 2500,
                    showConfirmButton: false,
            })
        }
    </script>
@endpush
