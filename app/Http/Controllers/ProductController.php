<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Category;
use App\Product;
use App\ReceiveDetail;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Flash;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('batch')->orderBy('nama_barang', 'asc')->get();
         return view('product.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $units = Unit::all();
        $categories = Category::all();
        return view('product.create', compact('units', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_barang' => 'required|min:3',
            'category_id' => 'required|not_in:0',
            'unit_id'     => 'required|not_in:0',
        ]);
        Product::create($validated);
        return redirect('/product')->with('toast_success', $request->nama_barang.' Berhasil ditambahkan!');

;
        // return redirect('/product')->withSuccessToast($request->nama_barang.' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $units = Unit::all();
        $categories = Category::all();
        $harga = ReceiveDetail::where('product_id', $id)->with('receive')->orderBy('created_at', 'desc')->get();
        // dd($harga);
        return view('product.edit', compact('product', 'units','categories', 'harga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $databaru = $request->validate([
        //     'nama_barang' => 'required|min:3',
        //     'category_id' => 'required|not_in:0',
        //     'unit_id'     => 'required|not_in:0',
        // ]);
        $product              = Product::find($id);
        $product->nama_barang = $request->nama_barang;
        $product->category_id = $request->category_id;
        $product->unit_id     = $request->unit_id;
        $product->harga_jual  = $request->newprice;
        $product->save();

        return redirect('/product')->with('toast_success', 'Data '.$product->id.' berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/product')->with('toast_success', 'Data '.$product->nama_barang.' berhasil Dihapus!');
    }

    public function stokhabis()
    {
        $products = Product::with('batch')->orderBy('nama_barang', 'asc')->get();

        return view('product.stokhabis', compact('products'));
    }

    public function kadaluwarsa()
    {
        $expired = ReceiveDetail::with([
                        'receive.supplier',
                        'product',
                        'product.unit',
                        'product.category',
                        'batch' => function ($query) {
                            $query->where('expiry_date', '<', Carbon::now());
                        }])
                    ->get()
                    ->whereNotNull('batch')
                    ->values();

        $almostexpired = ReceiveDetail::with([
                        'receive.supplier',
                        'product',
                        'product.unit',
                        'product.category',
                        'batch' => function ($query) {
                            $query->whereBetween('expiry_date', [Carbon::now(), Carbon::now()->addDays(90)]);
                        }])
                    ->get()
                    ->whereNotNull('batch')
                    ->values();

        // return response()->json($data, 200);
        return view('product.kadaluwarsa', compact('expired', 'almostexpired'));
    }
}
