<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Order;
use App\OrderDetail;
use App\Receive;
use App\ReceiveDetail;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::with('supplier')->where('status', '1')->orderBy('created_at', 'desc')->has('orderdetail')->get();
        $receives = Receive::with('receivedetail')->orderBy('created_at', 'desc')->get();
        // $orderberhasil = Order::with('supplier')->where('status', '2')->orderBy('created_at', 'desc')->has('orderdetail')->get();
        return view('receive.index', compact('orders', 'receives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $idbaru  = Receive::idbaru();
        $order   = Order::find($id);
        $tanggal = Carbon::parse($order->tanggal_order)->format('d-m-Y');
        $details = OrderDetail::where('order_id', $id)->with('product')->get();
        return view('receive.create', compact('order', 'details', 'tanggal', 'idbaru'));
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
            'id'            => $request->receiveid,
            'order_id'      => $request->orderid,
            'receive_date'  => Carbon::parse($request->receivedate)->format('Y-m-d'),
            'invoice'       => $request->fakturno,
            'invoice_date'  => Carbon::parse($request->fakturdate)->format('Y-m-d'),
            'supplier_id'   => $request->supplierid,
            'tax'           => $request->totalppn,
            'total'         => $request->grandtotal,
            'return_before' => Carbon::parse($request->fakturdate)->addMonth($request->ketentuan)->format('Y-m-d'),
            'return_limit'  => 1,
        ]);
        Receive::create($data);

        $row = count($request->idbarang);
        for ($i=0; $i < $row; $i++) {
            if ($request->qtydatang[$i] > 0) {
                $batch[$i] = ([
                    'no_batch'  => $request->nobatch[$i],
                    'expiry_date' => Carbon::parse($request->expiredate[$i])->format('Y-m-d'),
                    'product_id' => $request->idbarang[$i],
                    'stock'     => $request->qtydatang[$i],
                ]);
                $bid = Batch::create($batch[$i]);
                $LastInsertId = $bid->id;
                $detail[$i] = ([
                    'receive_id' => $request->receiveid,
                    'product_id' => $request->idbarang[$i],
                    'qty'        => $request->qtydatang[$i],
                    'buy_price'   => $request->harga[$i],
                    'discount'   => $request->diskon[$i],
                    'subtotal'   => $request->subtotal[$i],
                    'batch_id'   => $LastInsertId,
                ]);
                ReceiveDetail::create($detail[$i]);
            };
        };
        $updatestatus = Order::find($request->orderid);
            $updatestatus->status = '2';
            $updatestatus->save();

        return redirect('/receive')->with('toast_success', 'Barang '.$request->receiveid.' berhasil diterima');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receive = Receive::find($id);
        $info    = Store::find(1);
        $details = ReceiveDetail::where('receive_id', $id)->with('product','batch')->get();
        return view('receive.show', compact('receive', 'info', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(Receive $receive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receive $receive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receive $receive)
    {
        //
    }
}
