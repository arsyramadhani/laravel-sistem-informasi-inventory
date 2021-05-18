<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Receive;
use App\ReceiveDetail;
use App\Refund;
use App\RefundDetail;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $refunds = Refund::with('supplier')->orderBy('created_at', 'desc')->has('refunddetail')->get();
        return view('refund.index', compact('refunds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $receives = Receive::with('receivedetail', 'supplier')->get();
        $idbaru = Refund::idbaru();
        $tanggalbaru = Carbon::now()->format('d-m-yy');
        return view('refund.create', compact('receives', 'idbaru', 'tanggalbaru'));
    }

    public function getinvoicebysupplier(Request $request)
    {
        $data = Receive::where('supplier_id', $request->id)->where('return_limit', '>' , 0)->get();
        return response()->json($data, 200);
    }

    public function getdetail(Request $request)
    {
        $data = Receive::find($request->id)->load('supplier');
        return response()->json($data, 200);
    }

    public function getproductdetail(Request $request)
    {
        // $data = ReceiveDetail::where('receive_id', $request->id)->with('product','unitProduct')->get();
        $data = ReceiveDetail::where('receive_id', $request->id)->with('product.unit', 'batch')->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $all = $request->all();

        $data = ([
            'id' => $request->idretur,
            'refund_at' => Carbon::parse($request->tanggalbaru)->format('Y-m-d'),
            'receive_id' => $request->dtlidterima,
            'tax' => $request->ppn,
            'total' => $request->grandtotal,
            'cause' => $request->returjenis,
        ]);
        Refund::create($data);

        if ($request->qty) {
            $jmlbarang = count($request->product);
            for ($i=0; $i < $jmlbarang; $i++) {
               if ($request->qty[$i] > 0) {
                    $detail[$i] = ([
                        'refund_id'  => $request->idretur,
                        'product_id' => $request->product[$i],
                        'qty'        => $request->qty[$i],
                        'buy_price'  => $request->harga[$i],
                        'discount'   => $request->diskon[$i],
                        'batch_id'   => $request->batchid[$i],
                    ]);
                    RefundDetail::create($detail[$i]);
                    Batch::where('id', $request->batchid[$i])->decrement('stock', $request->qty[$i]);

               }
            }
        };
        return redirect('/refund')->with('toast_success', 'Retur '.$request->idretur.' berhasil disimpan');
        // dd($all, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $refund = Refund::find($id);
        $info    = Store::find(1);
        $details = RefundDetail::where('refund_id', $id)->with('product')->get();
        return view('refund.show', compact('refund', 'info', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function edit(Refund $refund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refund $refund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refund $refund)
    {
        //
    }
}
