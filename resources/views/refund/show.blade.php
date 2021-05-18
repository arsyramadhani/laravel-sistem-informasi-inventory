@extends('layouts.app')
@section('title', 'Detail Retur - ' . $refund->id)
@section('content')

<div class="mb-3 no-print">
    <a name="" id="" class="btn btn-default" href="/refund" role=" button">Kembali</a>
    <button type="button" id="btncetak" onclick="window.print()" class="btn btn-info float-right" style="width: 150px"><i class="fas fa-print    "></i> Cetak</button>
</div>
<div class="card p-3 col-sm-12">
         <div class="invoice p-5 mt-5 border-0">
            <div class="row">
                <div class="col-sm-6">
                    <img src="/dist/img/logo.png" alt="Logo Apotek" width="70px">
                    <h2 class="mt-3"><strong> {{ strtoupper($info->nama) }}</strong> </h2>
                    <p>{{ $info->alamat }}, {{ $info->kota }}<br>
                        {{$info->telepon}} <br>
                        {{ $info->sipa }}
                    </p>
                </div>
                <div class="col-sm-6 text-right">
                    <h1 class="font-weight-bold">RETUR PEMBELIAN</h1>
                    <p class="font-weight-bold">{{$refund->id}}</p>
                </div>
            </div>
            <hr>
           <div class="row invoice-info p-3">
                <div class="col-sm-4 invoice-col callout callout-success elevation-0">
                    <p>Dari Supplier : <br>
                    <b>{{strtoupper($refund->receive->supplier->nama_supplier)}}</b> <br>
                    {{$refund->receive->supplier->alamat_supplier}}, {{$refund->receive->supplier->kota_supplier}} <br>
                    {{$refund->receive->supplier->telepon}}
                    </p>
                </div>
                <div class="col-sm-3 invoice-col callout  elevation-0">
                    <p>
                        No Faktur / Invoice : <br>
                        <b> {{strtoupper($refund->receive->invoice)}}</b>
                    </p>
                    <p>
                        Tanggal Faktur / Invoice <br>
                        <b> {{strtoupper($refund->receive->invoice_date)}}</b>
                    </p>
                </div>
                <div class="col-sm-3 invoice-col callout  elevation-0">
                    <p>
                        No Retur :<br>
                        <b>{{$refund->id}}</b>

                    </p>
                    <p>
                        Tanggal Retur: <br>
                        <b>{{$refund->refund_at}}</b>
                    </p>
                </div>
                <div class="col-sm-2 invoice-col callout    elevation-0">
                    <p class="text-right">
                        Jenis Retur :<br>
                        <b>{{$refund->cause}}</b> <br>
                        <br>
                    </p>
                </div>
           </div>
           <div class="row">
               <div class="col-12 table-responsive">
                   <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-center">Kemasan</th>
                                <th class="text-center">No Batch</th>
                                <th class="text-center">Jumlah Retur</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Diskon</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($details as $detail)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$detail->product_id}} </td>
                                    <td> {{$detail->product->nama_barang}} </td>
                                    <td class="text-center"> {{$detail->product->unit->nama_unit}} </td>
                                    <td class="text-center"> {{$detail->batch->no_batch}} </td>
                                    <td class="text-center"> {{$detail->qty}} </td>
                                    <td class="text-right"> @currency($detail->buy_price) </td>
                                    <td class="text-center"> {{$detail->discount}} </td>
                                    <td class="text-right"> @if ($detail->discount != 0)
                                            @currency(($detail->buy_price*$detail->qty)-(($detail->buy_price/100)*$detail->discount)*$detail->qty)
                                    @else
                                        @currency($detail->buy_price*$detail->qty)
                                    @endif </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center"> Data tidak tersedia </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" class="text-right font-weight-bold">Subtotal</td>
                                <td colspan="2" class="text-right font-weight-bold">@currency($refund->total-$refund->tax)</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" class="text-right font-weight-bold">PPN</td>
                                <td colspan="2" class="text-right font-weight-bold">@currency($refund->tax)</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" class="text-right font-weight-bold">Total</td>
                                <td colspan="2" class="text-right font-weight-bold"> @currency($refund->total) </td>
                            </tr>
                        </tfoot>
                   </table>
               </div>
           </div>
           <div class="row mt-5">
               <div class="col-sm-4">
                    <br>
                    <br>
                    Catatan : <br>
               </div>
               <div class="col-sm-4">

               </div>
               <div class="col-sm-4 text-center">
                    <br>
                    <br>
                    Apoteker <br>
                    <br>
                    <br>
                    <br>
                    <strong>{{$info->apa}}</strong><br>
                    SIPA : {{$info->sipa}}
               </div>
           </div>
        </div>
</div>

@endsection