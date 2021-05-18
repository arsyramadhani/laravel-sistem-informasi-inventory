<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'web'], function () {
      ///your routes goes here
       Route::group(['middleware' => ['auth']], function() {
            Route::get('/', function () {
               return redirect('/dashboard');
            });

            Route::resource('supplier', 'SupplierController');
            Route::resource('product', 'ProductController');
            Route::get('/stokhabis', 'ProductController@stokhabis')->name('product.stokhabis');
            Route::get('/kadaluwarsa', 'ProductController@kadaluwarsa')->name('product.kadaluwarsa');

            Route::resource('order', 'OrderController');
            Route::post('order/getproduct', 'OrderController@getproduct');
            Route::post('order/productbyid', 'OrderController@productbyid')->name('productbyid.post');

            Route::resource('receive', 'ReceiveController');
            Route::get('receive/create/{id}', 'ReceiveController@create')->name('receive.create');
            Route::post('receive/create/{id}', 'ReceiveController@create')->name('receive.create');

            Route::resource('sale', 'SaleController');
            Route::get('/penjualan', 'SaleController@create')->name('penjualan');


            Route::get('sale/{id}/print', 'SaleController@print')->name('sale.print');

            Route::resource('unit', 'UnitController');

            Route::resource('refund', 'RefundController');
            Route::post('refund/getinvoicebysupplier', 'RefundController@getinvoicebysupplier')->name('getinvoicebysupplier.post');
            Route::post('refund/getdetail', 'RefundController@getdetail')->name('getdetail.post');
            Route::post('refund/getproductdetail', 'RefundController@getproductdetail')->name('getproductdetail.post');

            Route::get('/home', 'HomeController@index')->name('home');
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

            Route::get('laporan/penjualan', 'LaporanController@penjualan')->name('laporan.penjualan');
            Route::post('laporan/penjualan', 'LaporanController@penjualan')->name('laporan.penjualan');
            Route::post('laporan/getlaporanpenjualan', 'LaporanController@getlaporanpenjualan')->name('getlaporanpenjualan.post');

            Route::get('laporan/obatkeluar', 'LaporanController@obatkeluar')->name('laporan.obatkeluar');
            Route::post('laporan/obatkeluar', 'LaporanController@obatkeluar')->name('laporan.obatkeluar');
            Route::post('laporan/getlaporanobatkeluar', 'LaporanController@getlaporanobatkeluar')->name('getlaporanobatkeluar.post');

            Route::get('laporan/obatmasuk', 'LaporanController@obatmasuk')->name('laporan.obatmasuk');
            Route::post('laporan/obatmasuk', 'LaporanController@obatmasuk')->name('laporan.obatmasuk');
            Route::post('laporan/getlaporanobatmasuk', 'LaporanController@getlaporanobatmasuk')->name('getlaporanobatmasuk.post');

            Route::get('laporan/stok', 'LaporanController@stok')->name('laporan.stok');
            Route::post('laporan/stok', 'LaporanController@stok')->name('laporan.stok');
            Route::post('laporan/getlaporanstok', 'LaporanController@getlaporanstok')->name('getlaporanstok.post');

            Route::get('laporan/obatkeras', 'LaporanController@obatkeras')->name('laporan.obatkeras');
            Route::post('laporan/obatkeras', 'LaporanController@obatkeras')->name('laporan.obatkeras');

            Route::resource('test', 'TestController');




       });

            Route::group(['middleware' => ['guest']], function() {
           /*All my non-authenticated routes here ..*/
            });
});

            Auth::routes(['register' => false]);