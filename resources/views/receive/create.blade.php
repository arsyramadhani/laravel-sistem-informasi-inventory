@extends('layouts.app')
@section('title', 'Terima Barang')

@section('content')
<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/receive" "="" role=" button">Kembali</a>
    <button type="button" id="btnsimpan" class="btn btn-success float-right btnsimpan" style="width: 150px"><i class="fas fa-check    "></i> Simpan</button>
</div>
<div class="row">
    <div class="col-sm-12">
        {{-- <form id="myform" action="" method="post"> --}}
        <form id="myform" action="{{route('receive.store')}}" method="post">
            @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Detail Penerimaaan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <dt class="col-sm-2">ID Order</dt>
                    <dd class="col-sm-10">{{ $order->id }}</dd>
                    <dt class="col-sm-2">Tanggal Order</dt>
                    <dd class="col-sm-10">{{ $tanggal }}</dd>
                    <dt class="col-sm-2">Nama Supplier</dt>
                    <dd class="col-sm-10">{{ $order->supplier->nama_supplier }}</dd>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">ID Terima Barang (Auto)</label>
                            <input type="text" readonly class="form-control" id="" name="" placeholder="{{ $idbaru }}">
                            <input type="hidden" readonly class="form-control" id="receiveid" name="receiveid" value="{{ $idbaru }}">
                            <input type="hidden" readonly class="form-control" id="orderid" name="orderid" value="{{ $order->id }}">
                            <input type="hidden" readonly class="form-control" id="supplierid" name="supplierid" value="{{ $order->supplier_id }}">
                        </div>
                        <div class=" form-group">
                            <label for="">Tanggal Penerimaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt    "></i></span>
                                </div>
                                <input type="text" class="form-control infodate" id="receivedate" name="receivedate">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Nomor Faktur / Invoice</label>
                            <input type="text" class="form-control" id="fakturno" name="fakturno"
                                placeholder="Isikan nomor faktur">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Faktur / Invoice</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt    "></i></span>
                                </div>
                                <input type="text" class="form-control infodate" id="fakturdate" name="fakturdate">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Ketentuan Retur Barang</label>
                            <select class="form-control" name="ketentuan" id="ketentuan">
                                <option value="-1">Pilih Ketentuan Retur</option>
                                <option value="0">Retur Tidak Tersedia</option>
                                <option value="1">1 Bulan setelah barang diterima</option>
                                <option value="2">2 Bulan setelah barang diterima</option>
                                <option value="3">3 Bulan setelah barang diterima</option>
                                <option value="4">4 Bulan setelah barang diterima</option>
                                <option value="5">5 Bulan setelah barang diterima</option>
                                <option value="6">6 Bulan setelah barang diterima</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Item</h3>
            </div>
            <div class="card-body p-0">
                <table id="mytable" class="table table-condensed table-sm table-borderless table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th style="width: 17%">Nama Barang</th>
                            <th>Kemasan</th>
                            <th class="text-center" style="width: 7%">Jml Pesan</th>
                            <th class="text-center" style="width: 7%">Jml Datang</th>
                            <th style="width: 10%">No Batch</th>
                            <th style="width: 10%">Exp</th>
                            <th style="width: 12%">Harga Satuan</th>
                            <th style="width: 8%"  >Diskon</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="databarang">
                        @foreach($details as $item)
                            <tr id="row{{ $loop->iteration }}">
                                <td>{{ $loop->iteration }}</td>
                            <td> <b>{{ $item->product->nama_barang }}</b><input type="hidden" name="idbarang[]" class="form-control form-control-sm" value="{{$item->product_id}}" id="idbarang{{ $loop->iteration }}"></td>
                                <td>{{ $item->product->unit->nama_unit }}</td>
                                <td><input type="number" class="form-control form-control-sm qtypesan" id="qtypesan{{ $loop->iteration }}" name="qtypesan" readonly value="{{ $item->qty }}"></td>
                                <td><input type="number" class="form-control form-control-sm qtydatang" id="qtydatang{{ $loop->iteration }}" name="qtydatang[]" max="{{ $item->qty }}" min="0" value="{{ $item->qty }}"></td>
                                <td><input type="text" name="nobatch[]" class="form-control form-control-sm nobatch" id="nobatch{{ $loop->iteration }}"></td>
                                <td><input type="text" name="expiredate[]" class="form-control form-control-sm expiredate" id="expiredate{{ $loop->iteration }}"></td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text "><b>Rp.</b></span>
                                        </div>
                                        <input type="number" name="harga[]" min="0" value="0" step="100" class="form-control form-control-sm harga" id="harga{{ $loop->iteration }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="diskon[]" min="0" value="0"
                                            class="form-control form-control-sm diskon" id="diskon{{ $loop->iteration }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-percentage    "></i></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text "><b>Rp.</b></span>
                                        </div>
                                        <input type="number" name="subtotal[]" min="0" value="0" class="form-control form-control-sm subtotal" id="subtotal{{ $loop->iteration }}">
                                </td>
            </div>
            </tr>
            @endforeach

            </tbody>
            <tbody id="gt">
                <tr>
                    <td colspan="9" class="text-right"><b>Subtotal</b></td>
                    <td colspan="1">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend ">
                                <span class="input-group-text "><b>Rp.</b></span>
                            </div>
                            <input type="text" min="0" value="0" name="total" class="form-control form-control-sm" id="total">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="text-right"></td>
                    <td colspan="1">
                        <div class="form-group">
                            <select class="form-control form-control-sm" name="ppn" id="ppn">
                                <option value="0">0 PPN</option>
                                <option value="10">10% PPN</option>
                            </select>
                        </div>
                    </td>
                    <td colspan="1">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend ">
                                <span class="input-group-text "><b>Rp.</b></span>
                            </div>
                            <input type="text" name="totalppn" min="0" value="0" class="form-control form-control-sm" id="totalppn">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" class="text-right"><b>Grand Total</b></td>
                    <td colspan="1">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend ">
                                <span class="input-group-text "><b>Rp.</b></span>
                            </div>
                            <input type="text" name="grandtotal" class="form-control form-control-sm" id="grandtotal" min="0" value="0">
                        </div>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
    </form>
</div>
</div>
@endsection

@push('scripts')
    <script id="tanggalpicker" type="text/javascript">
        $('.infodate').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '-7d',
            endDate: '0d',
            todayHighlight: true,
            forceParse: true,
        }).datepicker('setDate', '0d');

        $('.expiredate').datepicker({
            format: 'MM yyyy',
            startView: 2,
            viewMode: "months",
            minViewMode: "months",
            endDate: '+10y',
            startDate: '+6m',
        });

    </script>
@endpush
@push('scripts')
    <script id="hitung" type="text/javascript">
        $(document).ready(function () {


        $('#mytable').change(function () {
            updateSubtotal();
        });
        function updateSubtotal() {
            $('.qtydatang').each(function () {
                var row     = $(this).closest('tr');
                var harga   = parseInt(row.find('.harga').val());
                var qty     = parseInt(row.find('.qtydatang').val());
                var order   = parseInt(row.find('.qtpesan').val());
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
            var ppn        = parseInt($('#ppn').children("option:selected").val());
            var totalppn   = (ppn / 100).toFixed(2);
            var grandtotal = (harga * totalppn);
            $('#totalppn').val(grandtotal);
            $('#grandtotal').val(grandtotal + harga);
        }

        });
    </script>
@endpush

@push('scripts')
    <script type="text/javascript">
        $('.btnsimpan').click(function () {
            if ($('#fakturno').val() === '') {
                swalerror('Silahkan isi nomor faktur / invoice');
            } else if ($('#ketentuan').val() < 0) {
                swalerror('Silahkan pilih ketentuan retur barang');
            } else if ($('.nobatch').val() === '' ){
                swalerror('Nomor Batch Tidak Boleh Kosong ');
            } else {
                Swal.fire({
                title: 'Anda yakin?',
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
    </script>
@endpush