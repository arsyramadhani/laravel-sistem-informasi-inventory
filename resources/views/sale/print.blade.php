<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{$info->nama}} - Receipt - {{ $sale->id }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <section class="invoice border-0 " style="width: 330px">
            <div class="row">
                <div class="col-12 p-1">
                    <div class="page-header text-center ">
                        <h3><b>A P O T E K &nbsp;&nbsp; A L B A</b></h3>
                        <p class="font-weight-light">{{ $info->alamat }} | {{ $info->telepon }} <br>
                            APA : {{ $info->apoteker }} <br>
                            SIPA : {{ $info->sipa }}
                        </p>
                    </div>
                    <hr>
                    <div class="text-center font-weight-bold">
                        S T R U K &NonBreakingSpace;&NonBreakingSpace; P E M B E L I A N
                    </div>
                    <hr>
                    <table class="table table-sm table-borderless">
                            <tr>
                                <th style="width:40%">ID</th>
                                <td class="text-right"> {{ $sale->id }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td class="text-right"> {{ $sale->created_at->format('d-m-y H:i') }}</td>
                            </tr>
                    </table>
                    <hr>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Nama Item</th>
                            <th class="text-center"> </th>
                            <th class="text-right">Harga</th>
                        </tr>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{$detail->product->nama_barang}}
                                        <br> ( @currency($detail->product->harga_jual) x {{$detail->qty}} )
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-right"><br> @currency($detail->qty*$detail->product->harga_jual)</td>
                                </tr>
                            @endforeach
                    </table>
                    <hr>
                    <table class="table table-sm table-borderless">
                            <tr>
                                <th style="width:40%">Total</th>
                                <td class="text-right font-weight-bold">@currency($sale->total)</td>
                            </tr>
                            <tr>
                                <th style="width:40%">Dibayar</th>
                                <td class="text-right"> @currency($sale->paid)</td>
                            </tr>
                            <tr>
                                <th style="width:40%">Kembali</th>
                                <td class="text-right"> @currency(($sale->paid)-($sale->total))</td>
                            </tr>
                    </table>
                    <hr>
                    <div class="page-header text-center">
                         <p class="font-weight-light  ">
                              <br>
                             Terimakasih atas kunjungan anda <br>
                             . : Semoga lekas sembuh : .
                        </p>
                    </div>
                </div>
            </div>
         </section>
     </div>

    <script type="text/javascript">
          window.addEventListener("load", window.print());
    </script>
</body>

</html>
