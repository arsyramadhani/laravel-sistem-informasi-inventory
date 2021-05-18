<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Category;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Store;
use App\Supplier;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::with('supplier')->orderBy('created_at', 'desc')->has('orderdetail')->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tanggal   = Carbon::now();
        $suppliers = Supplier::all();
        $ids       = Order::idbaru();
        return view('order.create', compact('suppliers', 'tanggal', 'ids'));
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
            'id'            => $request->idpesanan,
            'tanggal_order' => Carbon::parse($request->tanggal_order)->format('Y-m-d'),
            'supplier_id'   => $request->pilihsupplier,
            'status'        => '1',
            ]);
        Order::create($data);

        if ($request->idbarang) {
            $jmlbarang = count($request->idbarang);
        for ($i=0; $i < $jmlbarang; $i++) {
            if ($request->qty[$i] > 0 ) {
            $detail[$i] = ([
                'order_id'   => $request->idpesanan,
                'product_id' => $request->product[$i],
                'qty'        => $request->qty[$i],
                ]);
            OrderDetail::create($detail[$i]);
            }
        };
        }
        // return dd($data, $detail);
        return redirect('/order')->with('toast_success', 'Pesanan pembelian '.$request->idpesanan.' berhasil ditambahkan');
        // return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order   = Order::find($id);
        $tanggal = Carbon::parse($order->tanggal_order)->format('d-m-Y');
        $details = OrderDetail::where('order_id', $id)->with('product')->get();
        $info    = Store::find(1);


        // dd($detail);
        return view('order.show', compact('order', 'info', 'tanggal', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Order::find($id);
        $suppliers = Supplier::all();
        $details = OrderDetail::where('order_id', $id)->get();
        $products = Product::with('unit')->get();

        return view('order.edit', compact('id', 'data', 'suppliers', 'details', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Order::where('id', $id)->update([
            'tanggal_order' => Carbon::parse($request->tanggal_order)->format('Y-m-d'),
            'supplier_id'   => $request->pilihsupplier,
            'status'        => '1',
            ]);

        OrderDetail::where('order_id', $id)->delete();
        if ($request->idbarang) {
            $jmlbarang = count($request->idbarang);
        for ($i=0; $i < $jmlbarang; $i++) {
            if ($request->qty[$i] > 0 ) {
            $detail[$i] = ([
                'order_id'   => $request->idpesanan,
                'product_id' => $request->product[$i],
                'qty'        => $request->qty[$i],
                ]);
            OrderDetail::create($detail[$i]);
            }
        };
        };

        return redirect('/order')->with('toast_success', 'Pesanan pembelian '.$id.' berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // echo 'sdsaads';
        Order::find($id)->delete();
        return redirect('/order')->with('toast_success', 'Pesanan pembelian '.$id.' berhasil dihapus!');
    }

    public function getproduct()
    {
      $product = Product::all();
      return response()->json(($product), 200);
    }

    public function productbyid(Request $request)
    {
        $data = Product::find($request->id)
        ->load(['unit:id,nama_unit', 'category:id,nama_kategori', 'batch'])
        ->makeHidden(['created_at','updated_at','min_stok','harga_jual']);
        $stok = Batch::where('product_id', $request->id)->sum('stock');
        return response()->json([$data,$stok], 200);
    }
}
