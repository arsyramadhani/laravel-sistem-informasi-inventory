<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Category;
use App\Product;
use App\Receive;
use App\ReceiveDetail;
use App\Sale;
use App\SaleDetail;
use App\Store;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function penjualan()
    {
        # code...
        $info = Store::find(1);
        $tanggal = Carbon::now();
         return view('laporan.penjualan', compact('info', 'tanggal'));
    }

    public function getlaporanpenjualan(Request $request)
    {
        # code...
        $data = ([
            'total' => Sale::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])->sum('total'),
            'detail' => Sale::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])->get(),
        ]);

         return response()->json(($data), 200);
    }

    public function obatkeluar()
    {
        # code...
        $info = Store::find(1);
        $categories = Category::all();
        $tanggal = Carbon::now();
        return view('laporan.obatkeluar', compact('categories', 'info', 'tanggal'));
    }

    public function getlaporanobatkeluar(Request $request)
    {

        if ($request->category === '0') {
            $sd = SaleDetail::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])
                            ->with(['product.unit','product.category',])
                            ->get()
                            ->whereNotNull('product');
        } else {
            $cat = $request->category;
            $sd = SaleDetail::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])
            ->with([
                'product.unit',
                'product.category',
                'product' => function ($query ) use($cat) {
                    $query->where('category_id', '=', $cat);
                }])
            ->get()
            ->whereNotNull('product');
        };

        $data = ([
            'total' => $sd->sum('qty'),
            'detail' => $sd,

        ]);
        return response()->json(($data), 200);
    }

    public function obatmasuk()
    {
        # code...
        $info = Store::find(1);
        $categories = Category::all();
        $tanggal = Carbon::now();
        return view('laporan.obatmasuk', compact('categories', 'info', 'tanggal'));
    }
    public function getlaporanobatmasuk(Request $request)
    {
        if ($request->category === '0') {
            $sd = ReceiveDetail::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])
                            ->with(['batch','receive.supplier','product.unit','product.category',])
                            ->get()
                            ->whereNotNull('product');
        } else {
            $cat = $request->category;
            $sd = ReceiveDetail::whereBetween('created_at', [$request->tanggalawal, $request->tanggalakhir])
            ->with([
                'batch',
                'receive.supplier',
                'product.unit',
                'product.category',
                'product' => function ($query ) use($cat) {
                    $query->where('category_id', '=', $cat);
                }])
            ->get()
            ->whereNotNull('product');
        };

        $data = ([
            'total' => $sd->sum('qty'),
            'detail' => $sd,

        ]);
        return response()->json(($data), 200);
    }

    public function stok(Request $request)
    {
        $info = Store::find(1);
        $categories = Category::all();
        // $tanggal = Carbon::parse(now())->format('d-m-Y');
        $tanggal = Carbon::now();

        if (!$request->pilihkategori) {
            $details = Product::with('batch', 'unit', 'category')->orderBy('nama_barang', 'asc')->get();
            $kategori = '0';

        } else {
            $details = Product::where('category_id', $request->pilihkategori)->with('batch', 'unit', 'category')->orderBy('nama_barang', 'asc')->get();
            $kategori = Category::find($request->pilihkategori);

        }
        return view('laporan.stok', compact('categories', 'info', 'details', 'tanggal', 'kategori'));
    }

    public function obatkeras(Request $request)
    {
        if ($request->tanggalawal) {
            $tanggalawal = $request->tanggalawal;
            $tanggalakhir = $request->tanggalakhir;
        } else {
            $tanggalawal = Carbon::now()->firstOfMonth();
            $tanggalakhir = Carbon::now()->lastOfMonth();
        }



        $info = Store::find(1);
        $categories = Category::all();
        if (!$request->pilihkategori) {
            $data = Product::with([
                    'category',
                    'unit',
                    'receivedetail' => function ($query) use($tanggalawal,$tanggalakhir) {
                            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
                        },
                    'saledetail' => function ($query) use($tanggalawal,$tanggalakhir) {
                            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
                        },
                    ])->orderBy('nama_barang', 'asc')->get();
            $kategori = '0';
        } else {
            $data = Product::where('category_id', $request->pilihkategori)->with([
                    'category',
                    'unit',
                    'receivedetail' => function ($query) use($tanggalawal,$tanggalakhir) {
                            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
                        },
                    'saledetail' => function ($query) use($tanggalawal,$tanggalakhir) {
                            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
                        },
                    ])->orderBy('nama_barang', 'asc')->get();
            $kategori = Category::find($request->pilihkategori)->makeVisible('nama_kategori');
        }



        return view('laporan.obatkeras', compact('info', 'data','categories', 'tanggalawal','tanggalakhir','kategori'));
    }


}
