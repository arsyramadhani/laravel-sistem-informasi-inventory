<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function stokhabis()
    {
        //
        $products = Product::with('batch')->orderBy('nama_barang', 'asc')->get();
         return view('product.index', compact('products'));
    }
}
