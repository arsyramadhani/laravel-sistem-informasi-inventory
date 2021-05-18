<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
        /**
     * Show the application dashboard.
     *
    * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            switch (Auth::user()->akses) {
                case '1':
                case '2':
                    $penjualan = Sale::count();

                    return view('dashboard.admin', compact('penjualan'));
                    break;
                case '3':
                    # code...
                    return view('dashboard.user');
                    break;
                case '4':
                    # code...
                    return view('dashboard.kasir');
                    break;
            }

    }
}
