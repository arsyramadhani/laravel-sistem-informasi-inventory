<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;



class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all()->sortBy('nama_supplier');

        return view('supplier.index', compact('suppliers'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('supplier.create');
        // return View:
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $databaru = $request->validate([
            'nama_supplier'  => 'required|min:3|max:50',
            'telepon'         => 'required|alpha_dash|min:5|max:20',
            'alamat_supplier' => 'required|min:5|max:100',
            'kota_supplier'   => 'required|min:5|max:30',
        ]);

        Supplier::create($databaru);
        return redirect('/supplier')->with('toast_success', 'Data Pemasok Berhasil Ditambahkan');
     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $supplier = Supplier::findOrFail($id);
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $dataupdate = $request->validate([
            'nama_supplier' => 'required|min:4|max:50',
            'telepon' => 'required|alpha_dash|min:5|max:20',
            'alamat_supplier' => 'required|min:5|max:100',
            'kota_supplier' => 'required|min:3|max:20',
        ]);
        $supp                  = Supplier::find($id);
        $supp->nama_supplier   = $request->nama_supplier;
        $supp->alamat_supplier = $request->alamat_supplier;
        $supp->kota_supplier   = $request->kota_supplier;
        $supp->telepon         = $request->telepon;
        $supp->save();
        // $supp = $request->dataupdate->save($dataupdate);
        // $supp->save();

        // Supplier::whereId($id)->update($dataupdate);
        // Supplier::whereId($id)->update($dataupdate);

        return redirect('/supplier')->with('toast_success', 'Data Pemasok Berhasil Di Update');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sup = Supplier::findOrFail($id);
        $sup->delete();

        return redirect('/supplier')->with('toast_success', 'Data Pemasok Berhasil Dihapus!');
    }
}
