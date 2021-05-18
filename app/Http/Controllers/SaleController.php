<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Product;
use App\Recipe;
use App\Sale;
use App\SaleDetail;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $sales = Sale::with('saledetail')->orderBy('created_at', 'desc')->get();
        return view('sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Batch::where('stock', '>', 0)->orderBy('expiry_date', 'asc')->get();
        // $idbaru = Sale;
        $idbaru       = Sale::idbaru();
        $tanggalskrg    =   Carbon::now()->format('d-m-Y H:m');
        return view('sale.create', compact('products','idbaru', 'tanggalskrg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ([
            'id' => $request->idtransaksi,
            'total' => $request->total,
            'paid' => $request->bayar,
        ]);
        Sale::create($data);

        if ($request->idbarang) {
            for ($i=0; $i < count($request->idbarang); $i++) {
                if ($request->qty[$i] > 0) {
                    $detail[$i] = ([
                        'sale_id'    => $request->idtransaksi,
                        'product_id' => $request->idbarang[$i],
                        'qty'        => $request->qty[$i],
                        'batch_id'   => $request->batchbarang[$i],
                        ]);
                    SaleDetail::create($detail[$i]);
                    Batch::where('id', $request->batchbarang[$i])->decrement('stock', $request->qty[$i]);
                 };
            };
        };

        if ($request->dokter) {
            $dataresep = ([
                'id' => Recipe::idbaru(),
                'sale_id' => $request->idtransaksi,
                'nama_pasien' => $request->pasien,
                'usia' => $request->usia,
                'nama_dokter' => $request->dokter,
                'recipe_date' => Carbon::parse($request->tanggalresep)->format('Y-m-d'),
            ]);
            Recipe::create($dataresep);
        }

        return redirect('/sale/'.$request->idtransaksi )->with('success', 'Transaksi '.$request->idtransaksi.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $data = 1;
        $sale = Sale::find($id);
        $details = SaleDetail::where('sale_id', $id)->with('product')->get();
        return view('sale.show', compact('sale', 'details'));
    }
    public function print($id)
    {
        $sale = Sale::find($id);
        $details = SaleDetail::where('sale_id', $id)->with('product')->get();
        $info    = Store::find(1);
        return view('sale.print', compact('sale', 'details', 'info'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }


}
